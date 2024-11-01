<?php
/**
 * Postmark template for email. Supports both light and dark mode.
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
/** @var string $header_content */
/** @var string $heading */
/** @var string $heading_link */
/** @var string $subject */
/** @var string $body */
/** @var string $data */
/** @var string $attr_label */
/** @var array  $attributes */
/** @var string $footer_content */
/** @var string $email_view_online_url */
/** @var string $cta_label */
/** @var string $cta_url */
/** @var string $cta_body */

// we disable WordPress.Security.EscapeOutput.OutputNotEscaped rule because
// this file expects HTML, this is a template file.
// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="x-apple-disable-message-reformatting" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

		<title><?php echo \esc_html( $subject ); ?></title>
		<style type="text/css">
			@import url('https://fonts.googleapis.com/css?family=Nunito+Sans:400,700&display=swap');
			<?php require dirname( __DIR__ ) . '/styles/template.php'; ?>
			body {
				background-color: <?php echo \esc_html( $style->backgroundShade() ); ?>;
				color: <?php echo \esc_html( $style->textColor() ); ?>;
			}

			.preheader {
				display: none !important;
				visibility: hidden;
				mso-hide: all;
				font-size: 1px;
				line-height: 1px;
				max-height: 0;
				max-width: 0;
				opacity: 0;
				overflow: hidden;
			}

			body,
			td,
			th {
				font-family: 'Nunito Sans', Helvetica, Arial, sans-serif;
			}

			/* Buttons ------------------------------ */

			.button {
				background-color: <?php echo \esc_html( $style->primaryColor() ); ?>;
				border-top: 10px solid <?php echo \esc_html( $style->primaryColor() ); ?>;
				border-right: 18px solid <?php echo \esc_html( $style->primaryColor() ); ?>;
				border-bottom: 10px solid <?php echo \esc_html( $style->primaryColor() ); ?>;
				border-left: 18px solid <?php echo \esc_html( $style->primaryColor() ); ?>;
				display: inline-block;
				color: <?php echo \esc_html( $style->primaryBgText() ); ?>;
				text-decoration: none;
				border-radius: 3px;
				box-shadow: <?php echo \esc_html( $style->boxShadowBase() ); ?>;
				-webkit-text-size-adjust: none;
				box-sizing: border-box;
			}

			.button--green {
				background-color: <?php echo \esc_html( $style->successColor() ); ?>;
				border-top: 10px solid <?php echo \esc_html( $style->successColor() ); ?>;
				border-right: 18px solid <?php echo \esc_html( $style->successColor() ); ?>;
				border-bottom: 10px solid <?php echo \esc_html( $style->successColor() ); ?>;
				border-left: 18px solid <?php echo \esc_html( $style->successColor() ); ?>;
			}

			.button--red {
				background-color: <?php echo \esc_html( $style->errorColor() ); ?>;
				border-top: 10px solid <?php echo \esc_html( $style->errorColor() ); ?>;
				border-right: 18px solid <?php echo \esc_html( $style->errorColor() ); ?>;
				border-bottom: 10px solid <?php echo \esc_html( $style->errorColor() ); ?>;
				border-left: 18px solid <?php echo \esc_html( $style->errorColor() ); ?>;
			}

			@media only screen and (max-width: 500px) {
				.button {
					width: 100% !important;
					text-align: center !important;
				}
			}

			/* highlight Code ------------------------------ */

			.highlight {
				width: 100%;
				margin: 0.4em 0 1.1875em;
				padding: 24px;
				-premailer-width: 100%;
				-premailer-cellpadding: 0;
				-premailer-cellspacing: 0;
				background-color: <?php echo \esc_html( $style->backgroundShade() ); ?>;
				border: 2px dashed <?php echo \esc_html( $style->borderColorSplit() ); ?>;
			}

			.highlight_heading {
				text-align: center;
			}

			.highlight_body {
				text-align: center;
				font-size: 15px;
			}

			.email-wrapper {
				width: 100%;
				margin: 0;
				padding: 0;
				-premailer-width: 100%;
				-premailer-cellpadding: 0;
				-premailer-cellspacing: 0;
				background-color: <?php echo \esc_html( $style->backgroundShade() ); ?>;
			}

			/* Email --------------------------------------- */

			.email-content {
				width: 100%;
				margin: 0;
				padding: 0;
				-premailer-width: 100%;
				-premailer-cellpadding: 0;
				-premailer-cellspacing: 0;
			}
			/* Masthead ----------------------- */

			.email-masthead {
				padding: 25px 0;
				text-align: center;
			}

			.email-masthead_logo {
				width: 94px;
			}

			.email-masthead_name {
				font-size: 16px;
				font-weight: bold;
				color: <?php echo \esc_html( $style->headingColor() ); ?>;
				text-decoration: none;
				text-shadow: 0 1px 0 white;
			}
			/* Body ------------------------------ */

			.email-body {
				width: 100%;
				margin: 0;
				padding: 0;
				-premailer-width: 100%;
				-premailer-cellpadding: 0;
				-premailer-cellspacing: 0;
				background-color: <?php echo \esc_html( $style->appBackgroundColor() ); ?>;
			}

			.email-body_inner {
				margin: 0 auto;
				padding: 0;
				width: 570px;
				-premailer-width: 570px;
				-premailer-cellpadding: 0;
				-premailer-cellspacing: 0;
				background-color: <?php echo \esc_html( $style->appBackgroundColor() ); ?>;
			}

			.email-footer {
				width: 570px;
				margin: 0 auto;
				padding: 0;
				-premailer-width: 570px;
				-premailer-cellpadding: 0;
				-premailer-cellspacing: 0;
				text-align: center;
				font-size: 12px;
			}

			.email-footer p {
				color: <?php echo \esc_html( $style->textColorSecondary() ); ?>;
				font-size: 12px;
			}
			.email-footer div.para {
				font-size: 12px;
			}

			.body-action {
				width: 100%;
				margin: 30px auto;
				padding: 0;
				-premailer-width: 100%;
				-premailer-cellpadding: 0;
				-premailer-cellspacing: 0;
				text-align: center;
			}

			.body-sub {
				margin-top: 25px;
				padding-top: 25px;
				border-top: 1px solid <?php echo \esc_html( $style->borderColorSplit() ); ?>;
			}

			.content-cell {
				padding: 35px;
			}
			/*Media Queries ------------------------------ */

			@media only screen and (max-width: 600px) {
				.email-body_inner,
				.email-footer {
					width: 100% !important;
				}
			}
		</style>
		<!--[if mso]>
			<style type="text/css">
				.f-fallback {
					font-family: Arial, sans-serif;
				}
			</style>
		<![endif]-->
	</head>
	<body>
		<?php if ( isset( $preheader ) ) : ?>
			<span class="preheader"
				><?php echo $preheader; ?></span
			>
		<?php endif; ?>
		<table
			class="email-wrapper"
			width="100%"
			cellpadding="0"
			cellspacing="0"
			role="presentation"
		>
			<tr>
				<td align="center">
					<table
						class="email-content"
						width="100%"
						cellpadding="0"
						cellspacing="0"
						role="presentation"
					>
						<tr>
							<td class="email-masthead">
								<a
									href="<?php echo \esc_attr( $heading_link ); ?>"
									class="f-fallback email-masthead_name"
								>
									<?php echo $heading; ?>
								</a>
							</td>
						</tr>
						<!-- Email Body -->
						<tr>
							<td
								class="email-body"
								width="100%"
								cellpadding="0"
								cellspacing="0"
							>
								<table
									class="email-body_inner"
									align="center"
									width="570"
									cellpadding="0"
									cellspacing="0"
									role="presentation"
								>
									<!-- Body content -->
									<tr>
										<td class="content-cell">
											<div class="f-fallback">
												<?php if ( isset( $header_content ) && ! empty( $header_content ) ) : ?>
													<?php echo $header_content; ?>
													<hr />
												<?php endif; ?>
												<?php echo $body; ?>
												<?php if ( isset( $cta_url ) && isset( $cta_label ) ) : ?>
													<hr />
													<!-- highlight -->
													<table
														class="highlight"
														align="center"
														width="100%"
														cellpadding="0"
														cellspacing="0"
														role="presentation"
													>
														<tr>
															<td align="center">
																<?php if ( isset( $cta_body ) ) : ?>
																	<div class="f-fallback highlight_body">
																		<?php echo $cta_body; ?>
																	</div>
																<?php endif; ?>
																<!-- Border based button
	https://litmus.com/blog/a-guide-to-bulletproof-buttons-in-email-design -->
																<table
																	width="100%"
																	border="0"
																	cellspacing="0"
																	cellpadding="0"
																	role="presentation"
																>
																	<tr>
																		<td align="center">
																			<a
																				href="<?php echo \esc_attr( $cta_url ); ?>"
																				class="f-fallback button"
																				target="_blank"
																				><?php echo $cta_label; ?></a
																			>
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
												<?php endif; ?>
												<?php if ( ! empty( $attributes ) ) : ?>
													<hr />
													<table
														class="attributes"
														width="100%"
														cellpadding="0"
														cellspacing="0"
														role="presentation"
													>
														<tbody>
															<tr>
																<td class="attributes_content">
																	<table width="100%" cellpadding="0" cellspacing="0" role="presentation">
																		<tbody>
																			<?php foreach ( $attributes as $attribute ) : ?>
																				<tr>
																					<td class="attributes_item" style="font-weight:bold; width: 150px;">
																						<span class="f-fallback">
																							<strong><?php echo $attribute['label']; ?></strong>
																						</span>
																					</td>
																					<td class="attributes_item attributes_item--value">
																						<span class="f-fallback">
																							<?php echo $attribute['value']; ?>
																						</span>
																					</td>
																				</tr>
																			<?php endforeach; ?>
																		</tbody>
																	</table>
																</td>
															</tr>
														</tbody>
													</table>
												<?php endif; ?>
												<?php if ( isset( $data ) ) : ?>
													<hr />
													<?php echo $data; ?>
												<?php endif; ?>
												<?php if ( isset( $email_view_online_url ) ) : ?>
													<!-- Sub copy -->
													<table class="body-sub" role="presentation">
														<tr>
															<td>
																<p class="sub">
																	<?php esc_html_e( 'If you\'re having trouble viewing the email, copy and paste the URL below into your web browser.', 'wp-eform' ); ?>
																</p>
																<p class="sub">
																	<a class="url" href="<?php echo $email_view_online_url; ?>"><?php echo $email_view_online_url; ?></a>
																</p>
															</td>
														</tr>
													</table>
												<?php endif; ?>
											</div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td>
								<table
									class="email-footer"
									align="center"
									width="570"
									cellpadding="0"
									cellspacing="0"
									role="presentation"
								>
									<tr>
										<td class="content-cell" align="center">
											<div class="f-fallback sub align-center">
												<?php echo $footer_content; ?>
											</div>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<?php if ( isset( $cta_url ) && isset( $cta_label ) ) : ?>
		<script type="application/ld+json">
		{
			"@context": "http://schema.org",
			"@type": "EmailMessage",
			"potentialAction": {
					"@type": "ViewAction",
					"url": "<?php echo \esc_attr( $cta_url ); ?>",
					"name": "<?php echo \esc_attr( $cta_label ); ?>"
			},
			"description": "<?php esc_html_e( 'View the submission online.', 'wp-eform' ); ?>"
		}
		</script>
		<?php endif; ?>
	</body>
</html>
