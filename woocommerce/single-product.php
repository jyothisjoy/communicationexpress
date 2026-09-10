<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' );

$comm_express_default               = comm_express_get_default_theme_options();
$comm_express_global_sidebar_layout = esc_html( get_theme_mod( 'comm_express_global_sidebar_layout', $comm_express_default['comm_express_global_sidebar_layout'] ) );
$comm_express_sidebar_column_class  = 'column-order-2';
if ( $comm_express_global_sidebar_layout == 'right-sidebar' ) {
	$comm_express_sidebar_column_class = 'column-order-1';
}
?>

<div class="singular-main-block container">
	<div class="flex-row-d row px-2">

		<div class="col-md-3 p-3">
			<?php
			if ( has_nav_menu( 'product-sidebar' ) ) {
				echo '<div class="product-sidebar-menu">';
				wp_nav_menu( array( 'theme_location' => 'product-sidebar' ) );
				echo '</div>';
			}
			?>
		</div>

		<div class="col-md-9 p-3">
			<div class="secondrow b <?php echo $comm_express_sidebar_column_class; ?>">

				<?php
				/**
				 * woocommerce_before_main_content hook.
				 *
				 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
				 * @hooked woocommerce_breadcrumb - 20
				 */
				do_action( 'woocommerce_before_main_content' );
				?>

				<?php while ( have_posts() ) : ?>
					<?php the_post(); ?>

					<?php wc_get_template_part( 'content', 'single-product' ); ?>

				<?php endwhile; // end of the loop. ?>

				<?php
				/**
				 * woocommerce_after_main_content hook.
				 *
				 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
				 */
				do_action( 'woocommerce_after_main_content' );

				// woocommerce_sidebar hook intentionally omitted: this theme renders its own `product-sidebar` nav menu in the left column above instead of WC's sidebar widget area.
				?>

			</div>
		</div>

	</div>
</div>

<?php
get_footer( 'shop' );
