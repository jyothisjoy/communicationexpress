<?php
/**
 * Template Name: Mototrbo-applications Page Template 
 * The template for Showcase produts page content.
 * @package CommExpress
 * @since 1.0.0
 */
get_header();
?>


<div class="singular-main-block container">
    <div class="flex-row-d row px-2">
      <div class="col-md-3 p-3">
        <?php
        if (has_nav_menu('product-sidebar')) {
          wp_nav_menu(array('theme_location' => 'mototrbo-applications'));
        } ?>
      </div>
       <div class="col-md-9 p-3">
		<div class="secondrow">
			<div class="content-area">
				<div class="breadcrumb breadcrumb-nav ">
				  <?php comm_express_breadcrumb();	?>
				  		
				</div>
				

				<?php if (have_posts()): ?>
				  
				  <?php while (have_posts()):
                                the_post(); ?>
								
					<div class="headertitle">
						<h3 class="all-blogs"><?php the_title(); ?></h3>
					</div>	

					<div class="page-content-section">
						<?php the_content(); ?>	
					</div>
								
								
				<?php endwhile; ?>			
				<?php endif; ?>		
				
		   
			</div>
		</div>

      </div>
    </div>

  </div>

<?php get_footer(); ?>