<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined('ABSPATH') || exit;

get_header('shop'); 
$comm_express_default = comm_express_get_default_theme_options();
$comm_express_global_sidebar_layout = esc_html(get_theme_mod('comm_express_global_sidebar_layout', $comm_express_default['comm_express_global_sidebar_layout']));
$comm_express_sidebar_column_class = 'column-order-2';
if ($comm_express_global_sidebar_layout == 'right-sidebar') {
	$comm_express_sidebar_column_class = 'column-order-1';
}

?>

<div class="singular-main-block container">
	<div class="flex-row-d news row">
		<div class="col-md-3 p-1">
		<?php
		if (has_nav_menu('product-sidebar')) {
			echo '<div class="product-sidebar-menu">';
			wp_nav_menu(array('theme_location' => 'product-sidebar'));
			echo '</div>';
		} ?>
		</div>
		<div class="col-md-9  p-1">
			<div class="secondrow <?php echo $comm_express_sidebar_column_class; ?>">
					<div class="breadcrumb">
						<?php comm_express_breadcrumb(); ?>
					</div>
					<div class="productheadertitle">
						<h3 class="all-blogs"><?php single_term_title(); ?></h3>
						<p class="prodcatdesc"><?php echo term_description(); ?></p>
						<!-- <div class="blogsearch">
							<form role="search" method="get" class="search-form"
								action="<?php echo esc_url(home_url('/')); ?>">
								<input type="hidden" name="post_type" value="post" />
								<input type="search" id="search-form" class="search-input"
									placeholder="<?php echo esc_attr_x('Search …', 'placeholder'); ?>"
									value="<?php echo get_search_query(); ?>" name="s" />
							</form>
						</div> -->
					</div>

					<div class="bloggrid row">
						<?php
						// WooCommerce hooks
						// do_action('woocommerce_before_main_content');
						
						// Get the current category
						$current_category = get_queried_object();

						// Get subcategories
						$subcategories = get_terms(array(
							'taxonomy' => 'product_cat',
							'parent' => $current_category->term_id,
							'hide_empty' => false,
						));

						if (!empty($subcategories)) {
							echo '<div class="subcategory-tabs">';

							// Bootstrap 4 tabs navigation
							echo '<ul class="nav nav-tabs" id="subcategoryTabs" role="tablist">';
							foreach ($subcategories as $index => $subcategory) {
								$active_class = ($index === 0) ? 'active' : '';
								echo '<li class="nav-item">';
								echo '<a class="nav-link ' . $active_class . '" id="tab-' . $subcategory->term_id . '-tab" data-toggle="tab" href="#tab-' . $subcategory->term_id . '" role="tab" aria-controls="tab-' . $subcategory->term_id . '" aria-selected="' . ($index === 0 ? 'true' : 'false') . '">';
								echo esc_html($subcategory->name);
								echo '</a>';
								echo '</li>';
							}
							echo '</ul>';

							// Bootstrap 4 tab content
							echo '<div class="tab-content" id="subcategoryTabsContent" style="display:block;">';

							?>
							<?php
							$active = 'show active'; // Initialize active class for first tab content
							foreach ($subcategories as $subcategory):
								?>
								<div class="tab-pane fade <?php echo $active; ?>" id="tab-<?php echo $subcategory->term_id; ?>"
									role="tabpanel" aria-labelledby="tab-<?php echo $subcategory->term_id; ?>-tab">
									<!-- <div class="row">
									<div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-4 subcattitle">
									<h4><?php echo $subcategory->name . ' <span> ( Showing ' . esc_html($shown_items_start) . '-' . esc_html($shown_items_end) . ' of ' . esc_html($total_items) . ' products )</span>'; ?> </h4>
									</div> -->
									<div class="product-list" id="product-list-<?php echo $subcategory->term_id; ?>"
										data-category-id="<?php echo $subcategory->term_id; ?>">
										<?php
										// Load products for this subcategory (will be replaced by AJAX)
										// Initially load the first page of products
										?>
									</div>
									<div class="pagination-container mt-4"></div>
								</div>
								<?php
								$active = ''; // Remove active class for subsequent tab contents
							endforeach;
							?>
							<?php echo '</div>';

							echo '</div>'; // End of subcategory-tabs
						} else {
							echo '<p>No subcategories found in this category.</p>';
						}

						// WooCommerce hooks
						// do_action('woocommerce_after_main_content');
						
						?>

					</div>			
				
			</div>			
        </div>
    </div>
</div>

<?php get_footer(); ?>