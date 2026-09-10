<?php
/**
 * Template Name: Request a Quote Page
 *
 * Theme-level shell for the Request a Quote page.
 * The inner content (quote table, empty state, customer form) is rendered
 * by the woocommerce-request-a-quote plugin via the [addify-quote-request-page]
 * shortcode. Form styling is scoped in this template under .rfq-card--quote.
 *
 * @package CommExpress
 */

get_header();
?>

<main id="primary" class="site-main rfq-page">

	<!-- Hero -->
	<section class="rfq-hero">
		<div class="container">
			<nav class="rfq-breadcrumb" aria-label="Breadcrumb">
				<?php
				if ( function_exists( 'comm_express_breadcrumb' ) ) {
					comm_express_breadcrumb();
				} else {
					?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
					<span class="sep">/</span>
					<span aria-current="page">Request a Quote</span>
					<?php
				}
				?>
			</nav>

			<h1 class="rfq-hero__title">Request a Quote</h1>
			<p class="rfq-hero__subtitle">
				Tell us what you need and our team will get back to you with pricing,
				availability, and recommended configurations &mdash; usually within one business day.
			</p>
		</div>
	</section>

	<!-- Main content -->
	<section class="rfq-body">
		<div class="container">
			<div class="rfq-grid">

				<!-- Left: quote content (plugin shortcode slot) -->
				<div class="rfq-grid__main">
					<div class="rfq-card rfq-card--quote">
						<?php
						while ( have_posts() ) :
							the_post();
							$page_content = trim( get_the_content() );
							if ( ! empty( $page_content ) ) {
								the_content();
							} else {
								echo do_shortcode( '[addify-quote-request-page]' );
							}
						endwhile;
						?>
					</div>
				</div>

				<!-- Right: support / help sidebar -->
				<aside class="rfq-grid__aside" aria-label="Quote support">

					<div class="rfq-card rfq-card--help">
						<h3 class="rfq-card__title">Need help with your quote?</h3>
						<p class="rfq-card__text">
							Not sure which radio or accessory fits your operation?
							Our specialists can spec the right system for your team.
						</p>

						<ul class="rfq-contact-list">
							<li>
								<span class="rfq-contact-list__label">Call</span>
								<a href="tel:+17033210470" class="rfq-contact-list__value">(703) 321-0470</a>
							</li>
							<li>
								<span class="rfq-contact-list__label">Hours</span>
								<span class="rfq-contact-list__value">Mon &ndash; Fri, 8:30am &ndash; 5:00pm ET</span>
							</li>
							<li>
								<span class="rfq-contact-list__label">Email</span>
								<a href="mailto:sales@communicationsexpress.com" class="rfq-contact-list__value">sales@communicationsexpress.com</a>
							</li>
						</ul>
					</div>

					<div class="rfq-card rfq-card--why">
						<h3 class="rfq-card__title">Why request a quote?</h3>
						<ul class="rfq-why-list">
							<li>
								<span class="rfq-why-list__bullet" aria-hidden="true"></span>
								<div>
									<strong>Volume pricing</strong>
									<span>Best rates on fleet orders and bundled accessories.</span>
								</div>
							</li>
							<li>
								<span class="rfq-why-list__bullet" aria-hidden="true"></span>
								<div>
									<strong>System design included</strong>
									<span>We help you pick the right radios, batteries, and chargers.</span>
								</div>
							</li>
							<li>
								<span class="rfq-why-list__bullet" aria-hidden="true"></span>
								<div>
									<strong>Fast turnaround</strong>
									<span>Most quotes returned within one business day.</span>
								</div>
							</li>
						</ul>
					</div>

				</aside>

			</div>
		</div>
	</section>

</main>

<style>
	/* ============================================
	   Request a Quote &mdash; page shell
	   Scoped to .rfq-page so plugin styles stay isolated.
	   ============================================ */

	/* Kill the white gap between the floating header and the dark hero.
	   The theme leaves body bg showing through #content; we make the
	   parent containers dark so the hero meets the header cleanly. */
	body.page-template-template-request-quote #content,
	body.page-template-template-request-quote .main-banner {
		background: #1c1c1c;
		margin: -32px 0 0;
		padding: 0;
		overflow-x: hidden;
	}

	body.page-template-template-request-quote {
		overflow-x: hidden;
	}

	.rfq-page {
		background: #f7f8fa;
		color: #1c1c1c;
		margin-top: 0;
	}

	.rfq-page .container {
		width: 100%;
		max-width: 1240px;
		margin: 0 auto;
		padding: 0 24px;
		box-sizing: border-box;
	}

	/* Hero */
	.rfq-hero {
		background: linear-gradient(135deg, #1c1c1c 0%, #2a2a2a 60%, #3a2812 100%);
		color: #fff;
		padding: 156px 0 72px;
		margin: 0;
		position: relative;
		overflow: hidden;
	}

	.rfq-hero::before {
		content: "";
		position: absolute;
		inset: 0;
		background:
			radial-gradient(circle at 85% 20%, rgba(246, 140, 8, 0.18), transparent 55%),
			radial-gradient(circle at 10% 90%, rgba(246, 140, 8, 0.08), transparent 50%);
		pointer-events: none;
	}

	.rfq-hero > .container {
		position: relative;
		z-index: 1;
	}

	.rfq-breadcrumb {
		font-family: "Mulish", sans-serif;
		font-size: 13px;
		letter-spacing: 0.04em;
		text-transform: uppercase;
		color: rgba(255, 255, 255, 0.7);
		margin-bottom: 24px;
	}

	.rfq-breadcrumb a,
	.rfq-breadcrumb a:visited {
		color: #f68c08;
		text-decoration: none;
	}

	.rfq-breadcrumb a:hover {
		color: #ffb058;
		text-decoration: underline;
	}

	.rfq-breadcrumb .sep {
		margin: 0 8px;
		color: rgba(255, 255, 255, 0.4);
	}

	.rfq-hero__title {
		font-family: "Rajdhani", sans-serif;
		font-size: clamp(38px, 4.4vw, 58px);
		line-height: 1.1;
		font-weight: 700;
		letter-spacing: 0.01em;
		margin: 0 0 14px;
		color: #fff;
	}

	.rfq-hero__subtitle {
		font-family: "Mulish", sans-serif;
		font-size: 17px;
		line-height: 1.6;
		max-width: 640px;
		color: rgba(255, 255, 255, 0.78);
		margin: 0;
	}

	/* Body */
	.rfq-body {
		padding: 56px 0 80px;
		margin-top: -36px;
	}

	.rfq-grid {
		display: grid;
		grid-template-columns: minmax(0, 1fr) 340px;
		gap: 28px;
		align-items: start;
	}

	@media (max-width: 960px) {
		.rfq-grid {
			grid-template-columns: 1fr;
		}
	}

	/* Cards */
	.rfq-card {
		background: #fff;
		border-radius: 14px;
		box-shadow: 0 2px 4px rgba(20, 22, 30, 0.04), 0 14px 40px rgba(20, 22, 30, 0.06);
		border: 1px solid rgba(0, 0, 0, 0.04);
	}

	.rfq-card--quote {
		padding: 36px 36px 40px;
		min-height: 360px;
	}

	@media (max-width: 600px) {
		.rfq-card--quote {
			padding: 24px 20px 28px;
		}
	}

	.rfq-card--help,
	.rfq-card--why {
		padding: 26px 26px 28px;
		margin-bottom: 20px;
	}

	.rfq-card--help {
		border-top: 4px solid #f68c08;
	}

	.rfq-card__title {
		font-family: "Rajdhani", sans-serif;
		font-size: 20px;
		font-weight: 700;
		letter-spacing: 0.01em;
		margin: 0 0 10px;
		color: #1c1c1c;
		text-transform: uppercase;
	}

	.rfq-card__text {
		font-family: "Mulish", sans-serif;
		font-size: 14.5px;
		line-height: 1.6;
		color: #4a4a4a;
		margin: 0 0 18px;
	}

	/* Contact list */
	.rfq-contact-list {
		list-style: none;
		padding: 0;
		margin: 0;
	}

	.rfq-contact-list li {
		padding: 12px 0;
		border-top: 1px solid #ececec;
		display: flex;
		flex-direction: column;
		gap: 2px;
	}

	.rfq-contact-list li:first-child {
		border-top: none;
		padding-top: 4px;
	}

	.rfq-contact-list__label {
		font-family: "Rajdhani", sans-serif;
		font-size: 12px;
		text-transform: uppercase;
		letter-spacing: 0.08em;
		font-weight: 600;
		color: #8a8a8a;
	}

	.rfq-contact-list__value,
	.rfq-contact-list a.rfq-contact-list__value {
		font-family: "Mulish", sans-serif;
		font-size: 15px;
		color: #1c1c1c;
		text-decoration: none;
		font-weight: 500;
		word-break: break-word;
	}

	.rfq-contact-list a.rfq-contact-list__value:hover {
		color: #f68c08;
	}

	/* Why list */
	.rfq-why-list {
		list-style: none;
		padding: 0;
		margin: 4px 0 0;
	}

	.rfq-why-list li {
		display: flex;
		gap: 12px;
		padding: 12px 0;
		font-family: "Mulish", sans-serif;
		font-size: 14px;
		line-height: 1.5;
	}

	.rfq-why-list li + li {
		border-top: 1px dashed #ececec;
	}

	.rfq-why-list__bullet {
		flex: 0 0 8px;
		width: 8px;
		height: 8px;
		margin-top: 7px;
		border-radius: 50%;
		background: #f68c08;
		display: inline-block;
	}

	.rfq-why-list strong {
		display: block;
		font-family: "Rajdhani", sans-serif;
		color: #1c1c1c;
		font-weight: 700;
		font-size: 16px;
		letter-spacing: 0.01em;
		margin-bottom: 2px;
	}

	.rfq-why-list span {
		font-family: "Mulish", sans-serif;
		color: #6a6a6a;
		font-size: 13.5px;
	}

	/* Sticky sidebar on desktop */
	@media (min-width: 961px) {
		.rfq-grid__aside {
			position: sticky;
			top: 110px;
		}
	}

	/* Addify quote plugin — form + product table */
	.rfq-card--quote .woocommerce,
	.rfq-card--quote .adf-request-quote-page,
	.rfq-card--quote .adf-main-qoute-page,
	.rfq-card--quote .addify-quote-form {
		width: 100% !important;
		max-width: 100% !important;
		margin: 0 !important;
		padding: 0 !important;
	}

	.rfq-card--quote .addify-quote-form.template_one,
	.rfq-card--quote .addify-quote-form.template_two {
		display: block !important;
	}

	.rfq-card--quote .adf-quote-detail-wrap,
	.rfq-card--quote .af_quote_fields {
		width: 100% !important;
		max-width: 100% !important;
	}

	.rfq-card--quote .af_quote_fields {
		border-top: 1px solid #ececec !important;
		margin-top: 28px !important;
		padding-top: 28px !important;
		background: transparent !important;
	}

	.rfq-card--quote .addify-quote-form.template_one .af-quote-field-table,
	.rfq-card--quote .addify-quote-form.template_two .af-quote-field-table,
	.rfq-card--quote .af-quote-field-table {
		width: 100% !important;
		max-width: none !important;
	}

	/* Product table */
	.rfq-card--quote table.addify-quote-form__contents {
		width: 100%;
		border: 1px solid #ececec !important;
		border-radius: 8px;
		border-collapse: separate;
		border-spacing: 0;
		overflow: hidden;
		margin: 0 0 0 !important;
	}

	.rfq-card--quote table.addify-quote-form__contents thead th {
		background: #fafafa !important;
		color: #1c1c1c !important;
		font-family: "Rajdhani", sans-serif;
		font-size: 13px;
		font-weight: 700;
		letter-spacing: 0.06em;
		text-transform: uppercase;
		padding: 14px 16px !important;
		border-bottom: 1px solid #ececec !important;
		text-align: center !important;
		vertical-align: middle;
	}

	.rfq-card--quote table.addify-quote-form__contents thead th.product-name {
		text-align: left !important;
	}

	.rfq-card--quote table.addify-quote-form__contents tbody td {
		padding: 18px 16px !important;
		border-top: 1px solid #f0f0f0 !important;
		vertical-align: middle !important;
		text-align: center !important;
		font-family: "Mulish", sans-serif;
		font-size: 14px;
		color: #1c1c1c;
	}

	.rfq-card--quote table.addify-quote-form__contents tbody td.product-name {
		text-align: left !important;
	}

	.rfq-card--quote table.addify-quote-form__contents .product-name a {
		color: #f68c08 !important;
		font-family: "Mulish", sans-serif;
		font-size: 15px;
		font-weight: 600;
		line-height: 1.45;
		text-decoration: none;
	}

	.rfq-card--quote table.addify-quote-form__contents .product-name a:hover {
		color: #d36900 !important;
		text-decoration: underline;
	}

	.rfq-card--quote table.addify-quote-form__contents .product-name p {
		margin: 6px 0 0 !important;
	}

	.rfq-card--quote table.addify-quote-form__contents .product-name small {
		font-size: 13px;
		color: #6a6a6a;
		font-weight: 400;
	}

	.rfq-card--quote table.addify-quote-form__contents .product-name small b {
		color: #1c1c1c;
		font-weight: 600;
		margin-right: 4px;
	}

	.rfq-card--quote table.addify-quote-form__contents .product-thumbnail img {
		width: 64px;
		height: auto;
		display: block;
		margin: 0 auto;
	}

	.rfq-card--quote table.addify-quote-form__contents td.product-remove {
		width: 44px;
		padding-left: 12px !important;
		padding-right: 12px !important;
	}

	.rfq-card--quote table.addify-quote-form__contents td.product-remove a.remove {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		width: 24px;
		height: 24px;
		font-size: 22px;
		line-height: 1;
		color: #e74c3c !important;
		text-decoration: none !important;
		opacity: 1 !important;
	}

	.rfq-card--quote table.addify-quote-form__contents td.product-remove a.remove:hover {
		color: #c0392b !important;
	}

	.rfq-card--quote .product-quantity .quantity {
		display: inline-flex;
		align-items: center;
		justify-content: center;
	}

	.rfq-card--quote .product-quantity input.qty,
	.rfq-card--quote .offered-price .offered-price-input {
		width: 56px !important;
		min-height: 36px !important;
		padding: 6px 8px !important;
		border: 1px solid #dadada !important;
		border-radius: 4px !important;
		background: #fff !important;
		box-shadow: none !important;
		font-family: "Mulish", sans-serif;
		font-size: 14px !important;
		text-align: center;
	}

	/* Customer fields */
	.rfq-card--quote .quote-fields {
		display: flex;
		flex-wrap: wrap;
		justify-content: space-between;
		gap: 0;
		margin: 0;
	}

	.rfq-card--quote .addify-option-field {
		margin: 0 0 18px !important;
		padding: 0 !important;
	}

	.rfq-card--quote .addify-option-field.adf_half_width {
		width: calc(50% - 10px) !important;
		flex: 0 0 calc(50% - 10px) !important;
	}

	.rfq-card--quote .addify-option-field.adf_full_width {
		width: 100% !important;
		flex: 0 0 100% !important;
	}

	.rfq-card--quote .addify-option-field label {
		display: block;
		margin: 0 0 6px;
		font-family: "Mulish", sans-serif;
		font-size: 15px;
		font-weight: 600;
		line-height: 1.3;
		color: #101010;
	}

	.rfq-card--quote div.af_quote_fields input[type="text"],
	.rfq-card--quote div.af_quote_fields input[type="email"],
	.rfq-card--quote div.af_quote_fields input[type="number"],
	.rfq-card--quote div.af_quote_fields input[type="tel"],
	.rfq-card--quote div.af_quote_fields input[type="date"],
	.rfq-card--quote div.af_quote_fields input[type="time"],
	.rfq-card--quote div.af_quote_fields input[type="datetime-local"],
	.rfq-card--quote div.af_quote_fields select,
	.rfq-card--quote div.af_quote_fields textarea {
		width: 100% !important;
		min-height: 44px !important;
		padding: 10px 14px !important;
		border: 1px solid #dadada !important;
		border-radius: 4px !important;
		background: #fff !important;
		box-shadow: none !important;
		font-family: "Mulish", sans-serif;
		font-size: 14px;
		line-height: 1.4;
		color: #1c1c1c;
		box-sizing: border-box;
		transition: border-color 0.2s ease;
	}

	.rfq-card--quote div.af_quote_fields textarea {
		min-height: 110px !important;
		resize: vertical;
	}

	.rfq-card--quote div.af_quote_fields input:focus,
	.rfq-card--quote div.af_quote_fields select:focus,
	.rfq-card--quote div.af_quote_fields textarea:focus {
		outline: none;
		border-color: #f68c08 !important;
	}

	.rfq-card--quote div.af_quote_fields input[required],
	.rfq-card--quote div.af_quote_fields select[required],
	.rfq-card--quote div.af_quote_fields textarea[required] {
		border-left: 4px solid #e74c3c !important;
		padding-left: 12px !important;
	}

	.rfq-card--quote .addify-quote-form.template_one .select2-container--default .select2-selection--single,
	.rfq-card--quote .addify-quote-form.template_one .select2-container--default .select2-selection--multiple {
		min-height: 44px !important;
		height: auto !important;
		border: 1px solid #dadada !important;
		border-radius: 4px !important;
	}

	.rfq-card--quote .addify-quote-form.template_one .select2-container--default .select2-selection--single .select2-selection__rendered {
		line-height: 42px !important;
		padding-left: 12px;
		font-family: "Mulish", sans-serif;
		font-size: 14px;
	}

	.rfq-card--quote .adf-radio-btn,
	.rfq-card--quote .adf-chekboxes,
	.rfq-card--quote .adf-term-conditon {
		font-family: "Mulish", sans-serif;
		font-size: 14px !important;
		font-weight: 400 !important;
		color: #4a4a4a;
	}

	.rfq-card--quote .af-quote-field-table .form_row {
		text-align: left;
		margin-top: 6px;
	}

	.rfq-card--quote .addify_checkout_place_quote {
		display: inline-block;
		min-width: 148px;
		padding: 11px 28px !important;
		background: #fff !important;
		color: #1c1c1c !important;
		border: 1px solid #1c1c1c !important;
		border-radius: 4px !important;
		font-family: "Mulish", sans-serif;
		font-size: 15px !important;
		font-weight: 600 !important;
		line-height: 1.4 !important;
		text-transform: none !important;
		letter-spacing: 0 !important;
		cursor: pointer;
		transition: background 0.2s ease, color 0.2s ease, border-color 0.2s ease;
	}

	.rfq-card--quote .addify_checkout_place_quote:hover,
	.rfq-card--quote .addify_checkout_place_quote:focus {
		background: #1c1c1c !important;
		color: #fff !important;
		border-color: #1c1c1c !important;
	}

	.rfq-card--quote .woocommerce-notices-wrapper {
		margin-bottom: 18px;
	}

	.rfq-card--quote .cart-empty {
		font-family: "Mulish", sans-serif;
		font-size: 16px;
		color: #4a4a4a;
		margin: 0 0 22px;
	}

	.rfq-card--quote .return-to-shop .button,
	.rfq-card--quote .wc-backward {
		display: inline-block;
		background: #f68c08;
		color: #fff !important;
		border: 1px solid #d36900;
		border-radius: 30px;
		padding: 12px 26px;
		font-family: "Rajdhani", sans-serif;
		font-weight: 700;
		font-size: 15px;
		letter-spacing: 0.04em;
		text-transform: uppercase;
		text-decoration: none;
		transition: background 0.2s ease, color 0.2s ease;
	}

	.rfq-card--quote .return-to-shop .button:hover,
	.rfq-card--quote .wc-backward:hover {
		background: #1c1c1c;
		color: #f68c08 !important;
	}

	@media (max-width: 640px) {
		.rfq-card--quote .addify-option-field.adf_half_width {
			width: 100% !important;
			flex: 0 0 100% !important;
		}

		.rfq-card--quote table.addify-quote-form__contents thead {
			display: none;
		}

		.rfq-card--quote table.addify-quote-form__contents tbody tr {
			display: grid;
			grid-template-columns: 44px 72px 1fr;
			grid-template-areas:
				"remove thumb name"
				"remove thumb qty";
			gap: 8px 12px;
			padding: 16px;
			border-top: 1px solid #f0f0f0;
		}

		.rfq-card--quote table.addify-quote-form__contents tbody td {
			display: block;
			padding: 0 !important;
			border: 0 !important;
			text-align: left !important;
		}

		.rfq-card--quote table.addify-quote-form__contents td.product-remove {
			grid-area: remove;
			align-self: start;
		}

		.rfq-card--quote table.addify-quote-form__contents td.product-thumbnail {
			grid-area: thumb;
		}

		.rfq-card--quote table.addify-quote-form__contents td.product-name {
			grid-area: name;
		}

		.rfq-card--quote table.addify-quote-form__contents td.product-quantity {
			grid-area: qty;
		}
	}
</style>

<?php
get_footer();
