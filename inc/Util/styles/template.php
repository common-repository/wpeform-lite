<?php
/**
 * Postmark style file.
 *
 * @package EForm
 */

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

/** @var \WPEForm\Util\Style $style */
?>
	/* Base ------------------------------ */


	body {
		width: 100% !important;
		height: 100%;
		margin: 0;
		-webkit-text-size-adjust: none;
	}

	a {
		color: <?php echo \esc_html( $style->primaryColor() ); ?>;
	}
	a.url {
		word-break: break-all;
	}

	a img {
		border: none;
	}

	img {
		max-width: 500px;
		height: auto;
	}

	td {
		word-break: break-word;
	}


	/* Type ------------------------------ */
	h1 {
		margin: 0 0 1em 0;
		color:  <?php echo \esc_html( $style->headingColor() ); ?>;
		font-size: 36px;
		font-weight: bold;
		text-align: left;
		line-height: 1.2;
	}

	h2 {
		margin: 0 0 1em 0;
		color:  <?php echo \esc_html( $style->headingColor() ); ?>;
		font-size: 20px;
		font-weight: bold;
		text-align: left;
		line-height: 1.2;
	}

	h3 {
		margin: 0 0 1em 0;
		color:  <?php echo \esc_html( $style->headingColor() ); ?>;
		font-size: 20px;
		font-weight: bold;
		text-align: left;
		line-height: 1.2;
	}

	h4 {
		margin: 0 0 1em 0;
		color:  <?php echo \esc_html( $style->headingColor() ); ?>;
		font-size: 18px;
		font-weight: bold;
		text-align: left;
		line-height: 1.2;
	}

	h5 {
		margin: 0 0 1em 0;
		font-size: 14px;
		color:  <?php echo \esc_html( $style->headingColor() ); ?>;
		font-weight: bold;
		text-align: left;
		line-height: 1.2;
	}

	h6 {
		margin: 0 0 1em 0;
		font-size: 12px;
		color:  <?php echo \esc_html( $style->textColorSecondary() ); ?>;
		font-weight: normal;
		font-style: italic;
		text-align: left;
		line-height: 1.2;
	}

	td,
	th {
		font-size: 16px;
	}

	p,
	ul,
	ol,
	blockquote,
	div.para,
	hr {
		margin: 0;
		padding: 5px 0 5px;
		font-size: 16px;
		line-height: 1.5;
	}

	div.para:last-child,
	p:last-child,
	ul:last-child,
	ol:last-child {
		padding-bottom: 0;
	}
	div.para:first-child,
	p:first-child,
	ul:first-child,
	ol:first-child {
		padding-top: 0;
	}

	ul, ol {
		padding-left: 16px;
	}

	li {
		line-height: 1;
		padding: 6px 0;
	}

	hr {
		border-top: 2px solid <?php echo \esc_html( $style->borderColorSplit() ); ?>;
		border-left: 0 none;
		border-right: 0 none;
		border-bottom: 0 none;
		width: 50%;
		margin-left: auto;
		margin-right: auto;
	}

	p.sub,
	div.sub {
		font-size: 13px;
		color: <?php echo \esc_html( $style->textColorSecondary() ); ?>;
	}
	/* Utilities ------------------------------ */

	.align-right {
		text-align: right;
	}

	.align-left {
		text-align: left;
	}

	.align-center {
		text-align: center;
	}

	/* Attribute list ------------------------------ */

	.attributes {
		margin: 0 0 20px;
	}

	.attributes_content {
		background-color: <?php echo \esc_html( $style->backgroundShade() ); ?>;
		padding: 15px;
	}

	.attributes_item {
		padding: 5px;
		vertical-align: top;
	}
	.attributes_item--value a {
		white-space: pre-wrap;
		overflow-wrap: break-word;
	}

	/* Main Title ------------------------------------ */
	.main-title {
		font-size: 16px;
		line-height: 1;
		font-weight: bold;
		color: <?php echo \esc_html( $style->headingColor() ); ?>;
		padding: 0 0 12px 0;
		margin: 0 0 16px 0;
		border-bottom: 2px solid <?php echo \esc_html( $style->borderColorBase() ); ?>;
	}
	.main-title span {
		font-weight: normal;
		color: <?php echo \esc_html( $style->textColorSecondary() ); ?>;
	}

	/* Question -------------------------------------- */
	.page-title {
		border-bottom: 2px solid <?php echo \esc_html( $style->borderColorSplit() ); ?>;
		padding: 0 0 10px 0;
		margin: 20px 0 10px;
		font-size: 14px;
		color: <?php echo \esc_html( $style->textColorSecondary() ); ?>;
		font-weight: bold;
		text-transform: uppercase;
		break-after: avoid;
	}
	.page-title .para {
		text-transform: uppercase;
	}

	/* Answer ---------------------------------------- */
	.answer {
		border: 1px solid <?php echo \esc_html( $style->borderColorLight() ); ?>;
		padding: 10px 20px;
		margin: 10px 0 0;
	}

	.answer hr {
		border-top: 2px solid <?php echo \esc_html( $style->borderColorLight() ); ?>;
		border-left: 0 none;
		border-right: 0 none;
		border-bottom: 0 none;
		width: 30px;
		margin: 5px 0 0;
	}

	/* Headings */
	.answer h1,
	.answer h2,
	.answer h3,
	.answer h4,
	.answer h5,
	.answer h6 {
		margin: 0.6em 0;
		line-height: 1.2;
		clear: both;
	}

	.answer ul,
	.answer ol {
		margin: 0 0 0 20px;
		padding: 0;
		list-style: disc;
	}
	.answer ol {
		list-style: decimal;
	}

	.answer th,
	.answer td {
		padding: 10px 20px;
	}

	.answer-title {
		margin: 20px 0 10px;
		font-size: 16px;
		line-height: 1.5;
	}
	.answer-subtitle {
		margin: 0 0 10px;
		color: <?php echo \esc_html( $style->textColorSecondary() ); ?>;
		font-weight: normal;
		font-style: italic;
		line-height: 1.5;
	}
	.answer h1 + p,
	.answer h2 + p,
	.answer h3 + p,
	.answer h4 + p,
	.answer h5 + p {
		margin: 0 0 20px 0;
	}



	/* Hints --------------------------------------- */
	.hint {
		background-color: <?php echo \esc_html( $style->backgroundControl() ); ?>;
		padding: 0;
		margin: 0;
		color: <?php echo \esc_html( $style->textColor() ); ?>;
		border: 1px solid <?php echo \esc_html( $style->borderColorLight() ); ?>;
		border-top: 0 none;
		width: 100%;
	}

	.hint th,
	.hint td {
		padding: 10px 20px;
	}

	/* Score list ---------------------------------- */
	.scores {
		border-collapse: collapse;
		border-top: 0 none;
		border-left: 1px solid <?php echo \esc_html( $style->borderColorLight() ); ?>;
		border-right: 1px solid <?php echo \esc_html( $style->borderColorLight() ); ?>;
		border-bottom: 1px solid <?php echo \esc_html( $style->borderColorLight() ); ?>;
	}
	.scores.scores--has-header {
		border-top: 1px solid <?php echo \esc_html( $style->borderColorLight() ); ?>;
	}
	.scores.scores--has-header thead {
		color: <?php echo \esc_html( $style->textColorSecondary() ); ?>;
	}
	.scores.scores--has-header thead th {
		font-size: 12px;
	}
	.scores.scores--has-header thead th.scores__cell--heading {
		text-align: left;
	}

	.scores__cell {
		border-right: 1px solid <?php echo \esc_html( $style->borderColorLight() ); ?>;
		border-bottom: 1px solid <?php echo \esc_html( $style->borderColorLight() ); ?>;
		padding: 10px 20px;
		font-size: 16px;
	}

	.scores__cell--heading {
		font-weight: bold;
	}
	.scores__cell--value {
		text-align: right;
		width: 70px;
		font-variant-numeric: tabular-nums;
	}

	.designation-title {
		color: <?php echo \esc_html( $style->headingColor() ); ?>;
		font-size: 16px;
		font-weight: bold;
		margin: 0 0 10px 0;
	}
	.designation-description {
		color: <?php echo \esc_html( $style->textColor() ); ?>;
		font-size: 16px;
		margin: 0 0 20px 0;
		padding: 0 0 20px 0;
		border-bottom: 1px dashed <?php echo \esc_html( $style->borderColorLight() ); ?>;
	}
	.designation-description:last-child {
		border-bottom: 0 none;
		margin-bottom: 0;
		padding-bottom: 0;
	}

	/* Divider ------------------------------------- */
	.divider {
		width: 150px;
		height: 2px;
		border: 0px none;
		border-radius: 2px;
		background-color: <?php echo \esc_html( $style->borderColorSplit() ); ?>;
		margin: 20px 0px 0px;
		padding: 0px;
		display: block;
	}

	/* general ------------------------------------- */

	p {
		color: <?php echo \esc_html( $style->textColor() ); ?>;
	}

	p.sub {
		color: <?php echo \esc_html( $style->textColorSecondary() ); ?>;
	}
