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
				<div id="primary" class="content-area ">

					<div class="breadcrumb">
						<?php comm_express_breadcrumb(); ?>
					</div>
					<?php
					$first_banner = get_field('first_banner');
					$first_content = get_field('first_content');

					$second_banner = get_field('second_banner');
					$second_content_title = get_field('second_content_title');
					$second_content = get_field('second_content');

					$order_title = get_field('order_title');
					$order_content = get_field('order_content');
					$order_box_title = get_field('order_box_title');
					$order_callbox_list = get_field('order_callbox_list');

					$third_content_title = get_field('third_content_title');
					$third_content = get_field('third_content');
					$fourth_content_title = get_field('fourth_content_title');
					$fourth_content = get_field('fourth_content');
					$fifth_content_title = get_field('Fifth_content_title');
					$fifth_content = get_field('Fifth_content');



					?>
					<div class="productheadertitle">
						<h3 class="all-blogs"><?php single_term_title(); ?></h3>

					</div>

					<div class="bloggrid row m-2 p-3 prod-category-single-page">
						<!-- content will come here  -->

						<div class="row">
							<?php if (isset($first_banner) && $first_banner['url'] != ''): ?>
								<div class="col-12">
									<img class="img-responsive" src="<?php echo esc_url($first_banner['url']); ?>" />
								</div>
							<?php endif; ?>
							<?php if (isset($first_content) && $first_content != ''): ?>
								<div class="col-12 my-3">
									<p><?php echo comm_express_kses($first_content); ?></p>
								</div>
							<?php endif; ?>
						</div>



						<div class="row">
							<?php if (isset($second_banner) && $second_banner['url'] != ''): ?>
								<div class="col-12  my-3">

									<img class="img-responsive" src="<?php echo esc_url($second_banner['url']); ?>" />
								</div>
							<?php endif; ?>
							<div class="col-12">
								<h3><?php echo comm_express_kses($second_content_title); ?></h3>
								<p><?php echo comm_express_kses($second_content); ?></p>
							</div>
						</div>

						<?php 
							$order_title = get_field('order_title');
							$order_content = get_field('order_content');
							$order_box_title = get_field('order_box_title');
							$order_callbox_list = get_field('order_callbox_list');
						
						?>
						<div class="row">
							<div class="col-12 my-3">
								<h5><?php echo comm_express_kses($order_title);?></h5>
								<p><?php echo comm_express_kses($order_content);?></p>
								<h6><?php echo comm_express_kses($order_box_title);?></h6>
						   
								<?php if ($order_callbox_list != ""):
								$wtaglist = explode("|", $order_callbox_list);
								?>
								<ul  class="callboxlist p-0">
								  <?php foreach ($wtaglist as $wvalue) { ?>
									<li><?php echo comm_express_kses($wvalue); ?></li>
								  <?php } ?>

								</ul>
							  <?php endif; ?>
							</div>
						</div>
						
						<div class="row">
							
							<div class="col-12  my-3">
								<h5><?php echo comm_express_kses($third_content_title); ?></h5>
								<p><?php echo comm_express_kses($third_content); ?></p>
							</div>
						</div>

						<div class="row">
						  
							<div class="col-12  my-3">
								<h5><?php echo comm_express_kses($fourth_content_title); ?></h5>
								<p><?php echo comm_express_kses($fourth_content); ?></p>
							</div>
						</div>

						<div class="row">
						   
							<div class="col-12  my-3">
								<h5><?php echo comm_express_kses($fifth_content_title); ?></h5>
								<p><?php echo comm_express_kses($fifth_content); ?></p>
							</div>
						</div>

						<?php 
						
							$section_header_title = get_field("section_header_title");
							
						?>
						<div class="row">
							<div class="col-12">
							<h3 class="all-blogs"><?php echo comm_express_kses($section_header_title);?></h3>
							</div>
							<?php for($i=1; $i<=2; $i++):
							$productgroup = get_field("products_group_".$i);
							  // echo comm_express_kses($productgroup['products']);  
							?>
								<h5><?php echo comm_express_kses($productgroup['title']);?></h5>
								<p><?php echo comm_express_kses($productgroup['description']) ;?></p>
								<div class="row m-2">
									<?php foreach($productgroup['products'] as $products): ?>
										<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 p-2">
											<div class="product-item text-center p-0">
												<a href="<?php echo get_permalink($products->ID); ?>">
												<?php echo get_the_post_thumbnail($products->ID, 'woocommerce_thumbnail', array('class' => 'p-3'));?>
													<h3 class="py-4 pl-2"><?php echo esc_html($products->post_title); ?></h3>
												</a>
											</div>
										</div>
									<?php endforeach;?>
								</div>

							<?php endfor; ?>
						</div>


						<div class="row my-3">
							<?php $section_title = get_field('section_title');

							?>
							<div class="col-12">
								<h3><?php echo comm_express_kses($section_title);?></h3>
							</div>
							<?php for($j=1; $j<=10; $j++):
								$featuregroup = get_field('features_and_accessories_'.$j);


							?>
							<div class="col-12">
								<h4><?php echo comm_express_kses($featuregroup['title']);?> </h4>
								<?php if ($featuregroup['featureslist'] != ""):
									$wtaglist = explode("|", $order_callbox_list);
									?>
									<ul  class="callboxlist p-0">
									<?php foreach ($wtaglist as $wvalue) { ?>
										<li><?php echo comm_express_kses($wvalue); ?></li>
									<?php } ?>

									</ul>
								<?php endif; ?>
							</div>
							<?php endfor;?>
						</div>
						<div class="container">
							<div class="row my-3">
								<?php 
									$must_have_title = get_field("must_have_title"); 
									$must_have_content = get_field("must_have_content");



								?>
								<div class="col-12 col-md-12 col-lg-12 ">
									<h3><?php echo comm_express_kses($must_have_title);?></h3>
									<p><?php echo comm_express_kses($must_have_content);?></p>
									<h3>Downloads</h3>
									<?php for($k=1; $k<=3;$k++):
										$downloads = get_field("download_button_".$k);
										//echo comm_express_kses($downloads);
										if(isset($downloads['download_file']) && $downloads['title'] !=""):
										?>
										<a class="filedownload" href="<?php echo esc_url(isset($downloads['download_file']) && $downloads['download_file'] !="" ?$downloads['download_file']['url']:""); ?>"><?php echo comm_express_kses($downloads['title']) ?></a>
									<?php
								endif;
								endfor;?>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			
			</div>			
        </div>
    </div>
</div>

<?php get_footer('shop');
