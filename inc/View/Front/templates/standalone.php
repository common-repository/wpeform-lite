<?php
/**
 * Template file for standalone Output.
 *
 * @package EForm
 * @subpackage View\Form
 */

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/** @var string $before_body_html */
/** @var string $after_body_html */
/** @var string $head_html */
/** @var string $page_title */
/** @var string $assets_output */
/** @var string $body */

// disable output escaping, because this is a template file
// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
?>
<!DOCTYPE html>

<html>
<head>
	<meta charset=utf-8 />
	<meta name="viewport" content="user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, minimal-ui">
	<title><?php echo \esc_html( $page_title ); ?></title>
	<?php require __DIR__ . DIRECTORY_SEPARATOR . 'standalone-style.php'; ?>
	<?php echo $assets_output; ?>
	<?php echo $head_html; ?>
</head>
<body>
	<?php echo $after_body_html; ?>
	<?php echo $body; ?>
	<?php echo $before_body_html; ?>
</body>
</html>
