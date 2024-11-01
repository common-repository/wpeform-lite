<?php
/**
 * Copyright (C) 2018 Swashata Ghosh <swashata@wpquark.com>
 *
 * This file is part of eForm - WordPress Builder.
 *
 * eForm - WordPress Builder is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * eForm - WordPress Builder is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with eForm - WordPress Builder.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package EForm
 * @subpackage Util
 */

namespace WPEForm\Util;

use DOMDocument;
use LogicException;

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/**
 * A Class for handling SlateJS JSON model for v0.50+.
 *
 * The Main class represents the `Editor` object we get from Slate's `createEditor`
 * function. So it has a `children` property which would be an array of all
 * children.
 *
 * @link https://docs.slatejs.org/concepts/02-nodes#editor
 *
 * But this is not what we need to pass to our client side SlateJS. We need to
 * call `getEditorChildrenJSON` and pass that value.
 *
 * NOTE: Make things camelCase in this class. We may want to publish in
 * composer packagist in future.
 */
class SlateJS {
	/**
	 * Validate Array of Nodes, like root Editor.
	 *
	 * @param array $element Array of nodes.
	 * @return bool True if all nodes are valid, false otherwise.
	 */
	public static function validateElement( ?array $element ) : bool {
		// If we have provided a null element, then it's okay
		if ( $element === null ) {
			return true;
		}

		// If there's no children in the root Element, then it's invalid
		if (
			! isset( $element['children'] )
			|| ! \is_array( $element['children'] )
		) {
			return false;
		}

		// Get the nodes
		$nodes = $element['children'];

		// Nodes could be empty, in which is case, it is valid.
		if ( ! \count( $nodes ) ) {
			return true;
		}

		// Now check every node individually
		foreach ( $nodes as $node ) {
			// Node has to be an array
			if ( ! \is_array( $node ) ) {
				return false;
			}
			// Check for validity of the node
			if ( ! self::isValidNode( $node ) ) {
				return false;
			}
		}
		return true;
	}

	/**
	 * Get type of a Node. Could be `node` or `text` or `invalid`.
	 *
	 * Per SlateJS documentation, There are three type of Node Objects:
	 *
	 * 1. A root-level `Editor` which has no meaning in our PHP Context.
	 * 2. Container `Element` nodes which basically has `children`.
	 * 3. Leaf-Level `Text` nodes which contain the document's text.
	 *
	 * This function would determine the type of a Node.
	 *
	 * @link https://docs.slatejs.org/concepts/02-nodes
	 *
	 * @param array $node The child of which the type to determine.
	 * @return string Type of child, `element`, `text` or `invalid`.
	 */
	public static function getNodeType( array $node ): string {
		if ( isset( $node['children'] ) && \is_array( $node['children'] ) ) {
			return 'element';
		}
		if ( isset( $node['text'] ) && \is_string( $node['text'] ) ) {
			return 'text';
		}

		return 'invalid';
	}

	/**
	 * Check whether a Node is valid or not. It doesn't take into account
	 * any custom Element type, just checks the basic data structure.
	 *
	 * @param array $node The Node item.
	 * @return bool True if it is valid, false otherwise.
	 */
	public static function isValidNode( array $node ) : bool {
		// If node has children, then it's an Element
		// This could also be custom or void element, but we aren't checking that.
		$nodeType = self::getNodeType( $node );

		// If Node is an Element
		if ( $nodeType === 'element' ) {
			// validate every child Node
			foreach ( $node['children'] as $child ) {
				// A child has to be an array, cannot be anything else
				if ( ! \is_array( $child ) ) {
					return false;
				}
				if ( ! self::isValidNode( $child ) ) {
					return false;
				}
			}

			// everything checks out
			// So this Element is valid
			return true;
		}

		// Else we may have text
		if ( $nodeType === 'text' ) {
			// getNodeType already checks for the value of $node['text']
			return true;
		}

		// Here, so the node is not at all valid.
		return false;
	}

	/**
	 * Create a root level Editor Element in an associative array.
	 *
	 * @param array $children Children of the Editor.
	 * @return array Full Editor Element.
	 * @throws LogicException If children are invalid.
	 */
	public static function createEditor( array $children ) : array {
		$editor = [
			'children' => $children,
		];
		if ( ! self::validateElement( $editor ) ) {
			throw new LogicException( 'Invalid children passed to the Editor element.' );
		}
		return $editor;
	}

	/**
	 * Create an associative array representing an Element Node.
	 *
	 * @param string $type Type of the element.
	 * @param array  $children Element's children. Could be other elements or text.
	 * @param array  $marks Additional marks inserted to the element.
	 * @return array New Element.
	 * @throws LogicException If the children are invalid.
	 */
	public static function createElement( string $type, array $children, array $marks = [] ): array {
		$elementNode = \array_merge(
			$marks,
			[
				'type' => $type,
				'children' => $children,
			]
		);
		if ( ! self::isValidNode( $elementNode ) ) {
			throw new LogicException( 'Invalid children passed to the element.' );
		}

		return $elementNode;
	}

	/**
	 * Create an associative array representing a Text Node or Leaf Node.
	 *
	 * @param string $text Text of the node.
	 * @param array  $marks Additional marks as present on the node.
	 * @return array The Text Node.
	 * @throws LogicException If text is invalid.
	 */
	public static function createText( string $text, array $marks = [] ): array {
		$textNode = \array_merge(
			$marks,
			[
				'text' => $text,
			]
		);
		if ( ! self::isValidNode( $textNode ) ) {
			throw new LogicException( 'Invalid text passed to the node.' );
		}
		return $textNode;
	}

	/**
	 * Deserialize HTML with some restricted features.
	 *
	 * @param \DOMElement|\DOMText $node HTML Node.
	 * @return array Deserialized value per SlateJS Model.
	 */
	protected static function deserializeHTML( \DomNode $node ) {
		// If it's a text node, then return the text content
		if ( $node->nodeType === 3 ) {
			return self::createText( $node->textContent );
		} elseif ( $node->nodeType !== 1 ) {
			return self::createText( '' );
		}

		// It has child nodes, so process
		$children = [];
		foreach ( $node->childNodes as $childNode ) {
			$children[] = self::deserializeHTML( $childNode );
		}
		// Now normalize the children, basically add one text before and after
		// if it doesn't start or end with text
		if (
			isset( $children[0] )
			&& self::getNodeType( $children[0] ) !== 'text'
		) {
			\array_unshift( $children, self::createText( '' ) );
		}
		$total_children = \count( $children );
		if (
			$total_children > 1
			&& self::getNodeType( $children[ $total_children - 1 ] ) !== 'text'
		) {
			\array_push( $children, self::createText( '' ) );
		}

		switch ( $node->nodeName ) {
			default:
				return self::createText(
					$node->textContent
				);
			case 'a':
				return self::createElement(
					'link', $children, [
						'url' => $node->getAttribute( 'href' ),
						'title' => $node->getAttribute( 'title' ),
						'target' => $node->getAttribute( 'target' ),
						'rel' => $node->getAttribute( 'rel' ),
					]
				);
			case 'p':
				return self::createElement( 'paragraph', $children );
			case 'h1':
				return self::createElement( 'heading-one', $children );
			case 'h2':
				return self::createElement( 'heading-two', $children );
			case 'h3':
				return self::createElement( 'heading-three', $children );
			case 'h4':
				return self::createElement( 'heading-four', $children );
			case 'h5':
				return self::createElement( 'heading-five', $children );
			case 'h6':
				return self::createElement( 'heading-six', $children );
			case 'blockquote':
				return self::createElement( 'blockquote', $children );
			case 'mentions':
				return self::createElement(
					'mentions', [ self::createText( '' ) ], [
						'character' => $node->getAttribute( 'character' ),
					]
				);
			case 'strong':
				return self::createText(
					$node->textContent,
					[
						'bold' => true,
					]
				);
			case 'em':
				return self::createText(
					$node->textContent,
					[
						'italic' => true,
					]
				);
			case 'u':
				return self::createText(
					$node->textContent,
					[
						'underline' => true,
					]
				);
			case 's':
				return self::createText(
					$node->textContent,
					[
						'strikethrough' => true,
					]
				);
			case 'code':
				return self::createText(
					$node->textContent,
					[
						'code' => true,
					]
				);
			case 'sup':
				return self::createText(
					$node->textContent,
					[
						'sup' => true,
					]
				);
			case 'sub':
				return self::createText(
					$node->textContent,
					[
						'sub' => true,
					]
				);
		}
	}

	/**
	 * Parse an HTML Type String into proper Editor document. This will also
	 * create an instance and will return the instance.
	 *
	 * @param string $source Source HTML.
	 * @return SlateJS Resulting SlateJS object.
	 */
	public static function parseHTML( string $source ) : SlateJS {
		$html = new DOMDocument();
		$html->loadHTML(
			'<html><body>' . $source . '</body></html>',
			\LIBXML_NOERROR
		);
		$editor = self::createEditor( [] );
		$body = $html->getElementsByTagName( 'body' );
		foreach ( $body as $bodyNode ) {
			foreach ( $bodyNode->childNodes as $childNode ) {
				if ( $childNode ) {
					$newChild = self::deserializeHTML( $childNode );
					$editor['children'][] = $newChild;
				}
			}
		}
		return new SlateJS( $editor );
	}

	/**
	 * Parse a JSON-ified value of SlateJS model and set internal data.
	 *
	 * @param string $json The JSONified string of Element.
	 * @return SlateJS A Editor object.
	 * @throws LogicException If is invalid JSON or invalid Element.
	 */
	public static function parseEditorJSON( string $json ) {
		$editor = \json_decode( $json, true );
		// check if it could be parsed
		if ( $editor === null || ! \is_array( $editor ) ) {
			throw new LogicException( 'Invalid string passed. It is not a JSON.' );
		}
		// Now validate the data
		if ( ! self::validateElement( $editor ) ) {
			throw new LogicException( 'Passed JSON is not a valid Editor Element.' );
		}

		return new SlateJS( $editor );
	}

	/**
	 * Parse JSON-ified value of SlateJS editor's children model and return a new
	 * SlateJS instance. It also takes into consideration JSON errors, and if
	 * it has any error, then like JavaScript, it will simply treat it as a
	 * paragraph. If it is a valid JSON and yet not a valid editor children
	 * then it will return an empty slateJS editor. It should never throw an
	 * exception under any circumstances.
	 *
	 * @param string $json The JSONified string of Editor's Children.
	 *
	 * @return SlateJS A Editor object.
	 */
	public static function parseEditorChildrenJSON( string $json ) {
		$children = \json_decode( $json, true );
		if (
			! is_array( $children )
			|| ! self::isValidNode( [ 'children' => $children ] )
		) {
			$children = [
				self::createElement(
					'paragraph',
					[
						[
							'text' => $json,
						],
					]
				),
			];
		}

		$editor = self::createEditor( $children );

		return new SlateJS( $editor );
	}

	/**
	 * Root level Editor node for this SlateJS instance.
	 *
	 * @var array|null
	 */
	private $editor = null;

	/**
	 * Callback to render mentions.
	 *
	 * @var callable|null
	 */
	private $mentionsCallback = null;

	/**
	 * Map of dynamic anchor tags.
	 *
	 * @var array
	 */
	private $dynamicAnchorTags = [];

	/**
	 * Set mentions render callback.
	 *
	 * @param callable|null $callback The callback function to set mentions.
	 * @return SlateJS Current instance.
	 */
	public function setRenderMentions( ?callable $callback ) : SlateJS {
		$this->mentionsCallback = $callback;
		return $this;
	}

	/**
	 * Set dynamic anchor tags for rendering.
	 *
	 * @param array $tags Dynamic anchor tags.
	 * @return SlateJS Current instance.
	 */
	public function setDynamicAnchorTags( array $tags ) : SlateJS {
		$this->dynamicAnchorTags = $tags;
		return $this;
	}

	/**
	 * Create an instance.
	 *
	 * @throws LogicException If value of editor is invalid.
	 *
	 * @param null|array $editor The full Editor Array.
	 */
	public function __construct( ?array $editor = null ) {
		if ( self::validateElement( $editor ) ) {
			$this->editor = $editor;
		} else {
			throw new LogicException( 'Invalid root Editor Element passed to SlateJS.' );
		}
	}

	/**
	 * Get Element of the SlateJS Object.
	 *
	 * @throws LogicException If internal Element is still set to null.
	 * @return array Element.
	 */
	public function getEditor(): array {
		if ( $this->editor === null ) {
			throw new LogicException( 'Internal Editor Element is null.' );
		}
		return $this->editor;
	}

	/**
	 * Get JSON string for the SlateJS Editor object.
	 *
	 * @return string The JSON string.
	 * @throws LogicException If internal Element value is null.
	 */
	public function getEditorJSON() {
		if ( $this->editor === null ) {
			throw new LogicException( 'Internal Editor Element is null.' );
		}
		return \json_encode( $this->editor );
	}

	/**
	 * Get JSON of children of main Editor object. The value of this is what we
	 * pass on to the client side SlateJS.
	 *
	 * @return string JSON of editor children.
	 * @throws LogicException If internal editor is empty or has no children.
	 */
	public function getEditorChildrenJSON() {
		if (
			$this->editor === null
			|| empty( $this->editor['children'] )
		) {
			throw new LogicException( 'Internal Editor Element is null or has no children.' );
		}
		return \json_encode( $this->editor['children'] );
	}

	/**
	 * Check if the given nodes are empty, recursively.
	 *
	 * @param array $nodes Nodes (editor's children).
	 *
	 * @return bool
	 */
	protected function isNodesEmpty( array $nodes ) {
		// Let's assume it is empty, then prove otherwise, it would be faster
		$isEmpty = true;

		foreach ( $nodes as $child ) {
			// If not empty, then no need to evaluate
			if ( ! $isEmpty ) {
				continue;
			}

			// If child has a type and it is in pre-defeined blocks
			if (
				isset( $child['type'] ) &&
				\in_array(
					$child['type'],
					[ 'mentions', 'latex', 'media' ]
				)
			) {
				$isEmpty = false;
			} elseif ( isset( $child['children'] ) ) {
				$isEmpty = $this->isNodesEmpty( $child['children'] );
			} elseif ( isset( $child['text'] ) && $child['text'] !== '' ) {
				$isEmpty = false;
			}
		}

		return $isEmpty;
	}

	/**
	 * Checks if The Nodes of the editor is empty.
	 *
	 * @return bool
	 */
	public function isEditorEmpty() {
		// If editor is empty itself, then no point of checking further
		if ( empty( $this->editor ) || empty( $this->editor['children'] ) ) {
			return true;
		}

		// Recursively check
		return $this->isNodesEmpty( $this->editor['children'] );
	}

	/**
	 * Check whether a node is Text node or not.
	 *
	 * @param array $node The node.
	 * @return bool TRUE if it is text node, FALSE otherwise.
	 */
	public function isTextNode( array $node ) : bool {
		return self::getNodeType( $node ) === 'text';
	}

	/**
	 * Check if a node has a mark.
	 *
	 * @param array  $node The node.
	 * @param string $mark The mark.
	 * @return bool True if it has, false otherwise.
	 */
	protected function hasMark( array $node, string $mark ) : bool {
		return isset( $node[ $mark ] )
			&& (
				\is_bool( $node[ $mark ] )
				|| \is_string( $node[ $mark ] )
				|| \is_numeric( $node[ $mark ] )
			);
	}

	/**
	 * Escape attribute value to be used within render.
	 *
	 * For now it delegates to WordPress built-ins.
	 *
	 * @param mixed $attr The attribute value.
	 * @return string Escaped value.
	 */
	protected function escapeAttr( $attr ) : string {
		return \esc_attr( (string) $attr );
	}

	/**
	 * Escape HTML value to be used within render.
	 *
	 * For now it delegates to WordPress built-ins.
	 *
	 * @param mixed $html The HTML to escape.
	 * @return string Escaped value.
	 */
	protected function escapeHtml( $html ) : string {
		return \esc_html( (string) $html );
	}

	/**
	 * Render a leaf node. This doesn't check whether the node is actually a leaf
	 * and assumes it has been validated before. So always call this if
	 * `isTextNode` returns true.
	 *
	 * @param array $node The node.
	 * @param bool  $renderText Whether or not to render just text.
	 *
	 * @return string HTML render of the leaf.
	 */
	protected function renderLeafNode( array $node, bool $renderText = false ) : string {
		$childrenToRender = $this->escapeHtml( $node['text'] );

		// Ignore all marks, if we are to render text
		if ( $renderText ) {
			return $childrenToRender;
		}

		if ( $this->hasMark( $node, 'bold' ) ) {
			$childrenToRender = '<strong>' . $childrenToRender . '</strong>';
		}

		if ( $this->hasMark( $node, 'italic' ) ) {
			$childrenToRender = '<em>' . $childrenToRender . '</em>';
		}

		if ( $this->hasMark( $node, 'underline' ) ) {
			$childrenToRender = '<u>' . $childrenToRender . '</u>';
		}

		if ( $this->hasMark( $node, 'strikethrough' ) ) {
			$childrenToRender = '<s>' . $childrenToRender . '</s>';
		}

		if ( $this->hasMark( $node, 'code' ) ) {
			$childrenToRender = '<code>' . $childrenToRender . '</code>';
		}

		if ( $this->hasMark( $node, 'sup' ) ) {
			$childrenToRender = '<sup>' . $childrenToRender . '</sup>';
		}

		if ( $this->hasMark( $node, 'sub' ) ) {
			$childrenToRender = '<sub>' . $childrenToRender . '</sub>';
		}

		if ( $this->hasMark( $node, 'color' ) ) {
			$childrenToRender = '<span style="color: ' . $this->escapeAttr( $node['color'] ) . ';">'
				. $childrenToRender
				. '</span>';
		}

		if ( $this->hasMark( $node, 'fz' ) ) {
			$childrenToRender = '<span style="font-size: ' . $this->escapeAttr( $node['fz'] ) . '%;">'
				. $childrenToRender
				. '</span>';
		}

		return $childrenToRender;
	}

	/**
	 * Get style attribute for a node. Deals with align.
	 *
	 * @param array  $node The node.
	 * @param string $clear Whether or not to include a `clear: $clear` in the style.
	 *
	 * @return string HTML `style` attribute. Properly escaped.
	 */
	protected function getNodeStyle( array $node, string $clear = 'both' ) : string {
		$style = 'style="white-space: pre-wrap; overflow-wrap: break-word;';
		$style .= 'clear: ' . $this->escapeAttr( $clear ) . ';';
		if ( isset( $node['align'] ) ) {
			$style .= 'text-align: ' . $this->escapeAttr( (string) $node['align'] ) . ';';
		}

		$style .= '"';
		return $style;
	}

	/**
	 * Render link (anchor) node. It takes into consideration the dynamicAnchors.
	 *
	 * @param array  $node The Link node.
	 * @param string $children Children.
	 * @return string Rendered HTML.
	 */
	protected function renderLink( array $node, string $children ) : string {
		$href = $node['url'] ?? '#';
		$title = $node['title'] ?? '';
		$target = $node['target'] ?? '_self';
		$rel = $node['rel'] ?? '';

		// Now check the href against dynamic anchor tags
		if ( isset( $this->dynamicAnchorTags[ $href ] ) ) {
			$href = $this->dynamicAnchorTags[ $href ];
		}

		return '<a'
			. ' href="' . $this->escapeAttr( $href ) . '"'
			. ' title="' . $this->escapeAttr( $title ) . '"'
			. ' target="' . $this->escapeAttr( $target ) . '"'
			. ' rel="' . $this->escapeAttr( $rel ) . '"'
			. '>' . $children . '</a>';
	}

	/**
	 * Render a media node.
	 *
	 * @param array $node The media node.
	 * @return string Rendered HTML.
	 */
	protected function renderMedia( array $node ) : string {
		$src = $node['src'] ?? '';
		$alt = $node['alt'] ?? '';
		$align = $node['align'] ?? 'center';
		$height = $node['height'] ?? 'auto';
		$width = $node['width'] ?? 'auto';
		$mediaType = $node['mediaType'] ?? 'image';
		$caption = $node['caption'] ?? '';

		$mainPreview = '';

		if (
			\in_array( $mediaType, [ 'youtube', 'vimeo', 'dailymotion', 'wistia' ] )
		) {
			$mainPreview = '<iframe'
				. ' title="' . $this->escapeAttr( $alt ) . '"'
				. ' src="' . $this->escapeAttr( $src ) . '"'
				. ' frameborder="0"'
				. ' allowfullscreen'
				. ' allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"'
				. ' height="' . $this->escapeAttr( $height ) . '"'
				. ' width="' . $this->escapeAttr( $width ) . '"'
				. '></iframe>';
		} elseif ( $mediaType === 'audio' ) {
			$mainPreview = '<audio'
				. ' src="' . $this->escapeAttr( $src ) . '"'
				. ' controls'
				. ' title="' . $this->escapeAttr( $alt ) . '"'
				. ' height="' . $this->escapeAttr( $height ) . '"'
				. '>'
					. '<p>'
						. \sprintf(
							/* translators: %1$s is replaced by audio link */
							\__( 'Click <a href="%1$s">here</a> to play audio.', 'wp-eform' ),
							$this->escapeAttr( $src )
						)
					. '</p>'
				. '</audio>';
		} elseif ( $mediaType === 'video' ) {
			$mainPreview = '<video'
				. ' src="' . $this->escapeAttr( $src ) . '"'
				. ' controls'
				. ' title="' . $this->escapeAttr( $alt ) . '"'
				. ' height="' . $this->escapeAttr( $height ) . '"'
				. ' width="' . $this->escapeAttr( $width ) . '"'
				. '>'
					. '<p>'
						. \sprintf(
							/* translators: %1$s is replaced by video link */
							\__( 'Click <a href="%1$s">here</a> to play video.', 'wp-eform' ),
							$this->escapeAttr( $src )
						)
					. '</p>'
				. '</video>';
		} else {
			$mainPreview = '<img'
				. ' src="' . $this->escapeAttr( $src ) . '"'
				. ' alt="' . $this->escapeAttr( $alt ) . '"'
				. ' height="' . $this->escapeAttr( $height ) . '"'
				. ' width="' . $this->escapeAttr( $width ) . '"'
				. ' />';
		}

		$mr = $align === 'left'
			? '10px'
			: (
				$align === 'center'
					? 'auto'
					: '0'
			);
		$ml = $align === 'left'
			? '0'
			: (
				$align === 'center'
					? 'auto'
					: '10px'
			);
		$float = $align === 'left'
			? 'left'
			: (
				$align === 'right'
					? 'right'
					: 'none'
			);
		$clear = $align === 'left'
			? 'right'
			: (
				$align === 'right'
					? 'left'
					: 'both'
			);
		$sanitized_width = $this->escapeAttr( $width );

		$style = "padding: 5px; margin-top: 10px; margin-bottom: 10px; margin-right: {$mr}; margin-left: {$ml}; float: {$float}; clear: {$clear}; max-width: 100%; min-width: 150px;";

		return '<div'
			. ' style="' . $style . '"'
			. '>'
			. $mainPreview
			. (
					$caption !== ''
						? '<p style="margin: 5px 0 0 0; text-align: center; font-style: italic;">'
							. $this->escapeHtml( $caption )
							. '</p>'
						: ''
				)
			. '</div>';
	}

	/**
	 * Render a mentions node.
	 *
	 * @param array      $node The node.
	 * @param null|array $excludeMentionsCharacters Mentions to exclude.
	 * @param bool       $renderMentions Whether or not to render mentions.
	 * @param bool       $renderText Whether or not to render just text.
	 * @return string The rendered HTML of the node.
	 */
	protected function renderMentions( array $node, ?array $excludeMentionsCharacters = null, bool $renderMentions = true, bool $renderText = false ) : string {
		$empty = $renderText
			? $this->escapeHtml( '…' )
			: '<span style="font-style: italic;">' . $this->escapeHtml( '…' ) . '</span>';

		$output = '';
		$character = $node['character'] ?? '';

		if ( ! $renderMentions ) {
			$output = $empty;
		} elseif (
			\is_array( $excludeMentionsCharacters )
			&& \in_array( $character, $excludeMentionsCharacters )
		) {
			$output = $empty;
		} else {
			$output = \is_callable( $this->mentionsCallback ) && ! \is_null( $this->mentionsCallback )
				? \call_user_func( $this->mentionsCallback, $character )
				: $empty;
		}

		if ( ! $output || empty( $output ) ) {
			$output = $empty;
		}

		return $output;
	}

	/**
	 * Render an element from the given node.
	 *
	 * @param array      $node The node.
	 * @param string     $mode Mode of render.
	 * @param null|array $excludeMentionsCharacters Mentions to exclude.
	 * @param bool       $renderMentions Whether or not to render mentions.
	 * @param bool       $renderText Whether or not to render just the text.
	 *
	 * @return string The rendered HTML/Text of the element.
	 */
	protected function renderElement( array $node, string $mode, ?array $excludeMentionsCharacters = null, bool $renderMentions = true, bool $renderText = false ) : string {
		$children = isset( $node['children'] )
			? $this->recursiveSlateRenderer( $node['children'], $mode, $excludeMentionsCharacters, $renderMentions, $renderText )
			: '';

		$type = isset( $node['type'] ) ? $node['type'] : 'paragraph';

		// do stuff early, if we are to render text
		if ( $renderText ) {
			// for text, we just render the mentions
			if ( $type === 'mentions' ) {
				return $this->renderMentions( $node, $excludeMentionsCharacters, $renderMentions, true );
			}

			// else just return the children as-is, with just the text node
			return $children;
		}

		switch ( $type ) {
			case 'blockquote':
				return '<blockquote '
					. $this->getNodeStyle( $node )
					. '>'
					. $children
					. '</blockquote>';

			case 'bulleted-list':
				return '<ul '
					. $this->getNodeStyle( $node )
					. '>'
					. $children
					. '</ul>';

			case 'heading-one':
				return '<h1 '
					. $this->getNodeStyle( $node )
					. '>'
					. $children
					. '</h1>';

			case 'heading-two':
				return '<h2 '
					. $this->getNodeStyle( $node )
					. '>'
					. $children
					. '</h2>';

			case 'heading-three':
				return '<h3 '
					. $this->getNodeStyle( $node )
					. '>'
					. $children
					. '</h3>';

			case 'heading-four':
				return '<h4 '
					. $this->getNodeStyle( $node )
					. '>'
					. $children
					. '</h4>';

			case 'heading-five':
				return '<h5 '
					. $this->getNodeStyle( $node )
					. '>'
					. $children
					. '</h5>';

			case 'heading-six':
				return '<h6 '
					. $this->getNodeStyle( $node )
					. '>'
					. $children
					. '</h6>';

			case 'preformatted':
				return '<pre>'
					. $children
					. '</pre>';

			case 'list-item':
				return '<li>'
					. $children
					. '</li>';

			case 'numbered-list':
				return '<ol '
					. $this->getNodeStyle( $node )
					. '>'
					. $children
					. '</ol>';

			case 'link':
				return $this->renderLink( $node, $children );

			case 'latex':
				// for now, just render as is
				return '<span class="wpeform-slateview__latex">'
					. $this->escapeHtml( $node['latex'] ?? '' )
					. '</span>';

			case 'media':
				return $this->renderMedia( $node );

			case 'mentions':
				return $this->renderMentions( $node, $excludeMentionsCharacters, $renderMentions );

			default:
			case 'paragraph':
				$tag = $mode === 'multiline' ? 'div' : 'span';
				return '<' . $tag . ' class="para" '
					. $this->getNodeStyle( $node, 'none' )
					. '>'
					. $children
					. '</' . $tag . '>';
		}
	}

	/**
	 * Recursively render all children of a Slate Element Children.
	 *
	 * @param array      $nodes Children of the element we want to render.
	 * @param string     $mode Render mode, singleline or multiline.
	 * @param null|array $excludeMentionsCharacters Mentions to exclude from rendering.
	 * @param bool       $renderMentions Whether or not to render mentions.
	 * @param bool       $renderText Whether or not to render just text.
	 *
	 * @return string HTML output of the slate children.
	 */
	protected function recursiveSlateRenderer( array $nodes, string $mode, ?array $excludeMentionsCharacters = null, bool $renderMentions = true, bool $renderText = false ) : string {
		// bail early if nodes are empty
		if ( empty( $nodes ) ) {
			return '';
		}

		$output = '';
		foreach ( $nodes as $node ) {
			// bail early if not an array
			if ( ! \is_array( $node ) ) {
				continue;
			}
			if ( $this->isTextNode( $node ) ) {
				$output .= $this->renderLeafNode( $node, $renderText );
			} else {
				$output .= $this->renderElement( $node, $mode, $excludeMentionsCharacters, $renderMentions, $renderText );
			}
		}
		return $output;
	}

	/**
	 * Create HTML from the editor object and get it.
	 *
	 * @param string     $mode Render mode, singleline or multiline.
	 * @param null|array $excludeMentionsCharacters Mentions to exclude from rendering.
	 * @param bool       $renderMentions Whether or not to render mentions.
	 * @return string The HTML output.
	 */
	public function getHTML( string $mode = 'multiline', ?array $excludeMentionsCharacters = null, bool $renderMentions = true ) : string {
		// If the editor is empty, then just give back an empty string
		if ( $this->isEditorEmpty() ) {
			return '';
		}

		// extract the nodes from editor first
		$nodes = $this->editor['children'];

		// Now get the inner output depending on the mode
		$output = $this->recursiveSlateRenderer(
			// if render mode is not multiline, then we simply take the first children
			// of nodes.
			$mode === 'multiline' ? $nodes : [ $nodes[0] ],
			$mode,
			$excludeMentionsCharacters,
			$renderMentions
		);

		$output =
			$mode === 'singleline'
				? '<span class="wpeform-slateview wpeform-slateview--singleline" style="white-space: pre-wrap; overflow-wrap: break-word;">' .
					$output .
					'</span>'
				: '<div class="wpeform-slateview wpeform-slateview--multiline">' .
					$output .
					'</div>';

		return $output;
	}

	/**
	 * Get Text from the Editor. This discards all HTML markup and only keeps the
	 * text. Useful for oneliners.
	 *
	 * @param string     $mode Render mode. Defaults to 'singleline'.
	 * @param null|array $excludeMentionsCharacters Mentions characters to exclude.
	 * @param bool       $renderMentions Whether or not to render mentions.
	 * @return string Text output.
	 */
	public function getText( string $mode = 'singleline', ?array $excludeMentionsCharacters = null, bool $renderMentions = true ) : string {
		// If the editor is empty, then just give back an empty string
		if ( $this->isEditorEmpty() ) {
			return '';
		}

		// extract the nodes from editor first
		$nodes = $this->editor['children'];

		// Now get the inner output depending on the mode
		$output = $this->recursiveSlateRenderer(
			// if render mode is not multiline, then we simply take the first children
			// of nodes.
			$mode === 'multiline' ? $nodes : [ $nodes[0] ],
			$mode,
			$excludeMentionsCharacters,
			$renderMentions,
			true
		);

		return $output;
	}
}
