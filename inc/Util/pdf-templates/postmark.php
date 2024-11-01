<?php
/**
 * Postmark template for PDF.
 *
 * @package EForm
 * @see https://github.com/wildbit/postmark-templates
 */

/*
TODO: Implement Dark Mode when themes are ready

<meta name="color-scheme" content="light dark" />
<meta name="supported-color-schemes" content="light dark" />

@media (prefers-color-scheme: dark) {
	body,
	.email-body,
	.email-body_inner,
	.email-content,
	.email-wrapper,
	.email-masthead,
	.email-footer {
		background-color: #333333 !important;
		color: #fff !important;
	}
	p,
	ul,
	ol,
	blockquote,
	h1,
	h2,
	h3,
	span,
	.purchase_item {
		color: #fff !important;
	}
	.attributes_content,
	.highlight {
		background-color: #222 !important;
	}
	.email-masthead_name {
		text-shadow: none !important;
	}
}

:root {
	color-scheme: light dark;
	supported-color-schemes: light dark;
}
*/

// @codeCoverageIgnoreStart
if ( ! defined( 'ABSPATH' ) ) {
	die( '' );
}
// @codeCoverageIgnoreEnd

// The following variables need to be set from the caller of include

/** @var \WPEForm\Util\Style $style */
/** @var string $mode */
/** @var string $page_title_content */
/** @var string $title_content */
/** @var array  $attributes */
/** @var string $body */
/** @var string $footer_content */

// we disable WordPress.Security.EscapeOutput.OutputNotEscaped rule because
// this file expects HTML, this is a template file.
// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped

?>
<!DOCTYPE html>
<html>
<head>
		<title><?php echo \esc_html( $page_title_content ); ?></title>
		<style type="text/css">
			<?php require dirname( __DIR__ ) . '/styles/template.php'; ?>

			.answer {
				box-decoration-break: slice;
				page-break-before: avoid;
			}
			.answer-title,
			.answer-subtitle {
				page-break-after: avoid;
			}

			body {
				background-color: <?php echo \esc_html( $style->appBackgroundColor() ); ?>;
				color: <?php echo \esc_html( $style->textColor() ); ?>;
				font-family: <?php $mode === 'pdf' ? 'freesans' : "--apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif"; ?>;
			}
			.container {
				margin: 0 auto;
				max-width: 900px;
				padding: <?php echo $mode === 'pdf' ? '0' : '30px'; ?>;
			}

			.footer {
				margin: 20px 0 0 0;
			}
			.footer td {
				font-size: 14px;
				color: <?php echo \esc_html( $style->textColorSecondary() ); ?>;
			}
			.footer a {
				white-space: pre-wrap;
				overflow-wrap: break-word;
			}
		</style>
</head>
<body>
	<div class="container">
		<h2 class="main-title">
			<?php echo $title_content; ?>
		</h2>
		<?php if ( ! empty( $attributes ) ) : ?>
			<div class="attributes">
				<div class="attributes_content">
					<table>
						<tbody>
							<?php foreach ( $attributes as $attribute ) : ?>
								<tr>
									<td class="attributes_item" style="font-weight:bold; width: 200px;">
										<strong><?php echo $attribute['label']; ?></strong>
									</td>
									<td class="attributes_item attributes_item--value">
										<?php echo $attribute['value']; ?>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		<?php endif; ?>
		<?php echo $body; ?>
		<table class="footer">
			<tbody>
				<tr>
					<td>
						<?php echo $footer_content; ?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>
