<?php
/**
 * The template for displaying list of services.
 * @package CommExpress
 * @since 1.0.0
 */
get_header();
?>
<section id="main">
	<?php if (have_posts()): ?>
		<div class="service-single">
			<div class="container">
				<div class="breadcrumb">
					<?php comm_express_breadcrumb(); ?>
				</div>
			</div>
			<?php
			while (have_posts()):
				the_post();

				$media_featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
				$media_featured_image = isset($media_featured_image[0]) ? $media_featured_image[0] : '';
				$ourservices_short_description = get_field("ourservices_short_description");
				$ourservices_main_heading = get_field("ourservices_main_heading");
				
				if ($ourservices_short_description != ""): ?>
				<div class="container pb-5">	
					<section class="ourservicestitle">
						<div class="row align-items-center">
							<div class="titlefirst col-md-6 my-3">
								<img src="<?php echo esc_url($media_featured_image) ?>" />
							</div>
							<div class="titlesecond col-md-6 my-3">
								<?php if ($ourservices_main_heading != ""): ?>
									<h2 class="motorola-service"><?php echo comm_express_kses($ourservices_main_heading); ?></h2>
								<?php else: ?>
									<h2 class="motorola-service"><?php the_title(); ?></h2>
								<?php endif; ?>								
								<p class="protect-radios"><?php echo comm_express_kses($ourservices_short_description); ?></p>
							</div>
						</div>
					</section>
				</div>
				<?php endif; ?>
				
				
				<?php 
					$ourservices_secondsection_header = get_field("ourservices_secondsection_header_1");
					if ($ourservices_secondsection_header != ""): ?>
					 <section class="ourservicesblackbg1">
						<div class="container">
							<div class="flexcolumn">
								<?php for ($i = 0; $i <= 4; $i++):
									$ourservices_secondsection_header = get_field("ourservices_secondsection_header_" . $i);
									$ourservices_secondsection_paragraph = get_field("ourservices_secondsection_paragraph_" . $i);
									if ($ourservices_secondsection_header != ""):
										?>
										<div class="row">
											<div class="col-md-6">
												<?php echo comm_express_kses($ourservices_secondsection_header); ?>
											</div>
											<div class="col-md-6">
												<?php echo comm_express_kses($ourservices_secondsection_paragraph); ?>
											</div>
										</div>
										<?php
									endif;
								endfor; ?>
							</div>
						</div>						
					</section>					
				<?php endif; ?>
				
				
				<?php 
					$ourservices_services_section_title = get_field("services_section_title");
					$ourservices_services_section_content = get_field("services_section_content");
					if ($ourservices_services_section_title != "" || $ourservices_services_section_content != ""): ?>
					 <div class="container">
						 <section class="manufacturers-section">
							<div class="row">
								<?php if ($ourservices_services_section_title != ""): ?>	
									<div class="col-md-12">
										<?php echo comm_express_kses($ourservices_services_section_title); ?>	
									</div>
								<?php endif; ?>	
								<div class="col-md-12">
									<?php echo comm_express_kses($ourservices_services_section_content); ?>
								</div>
							</div>								
						</section>	
					</div>	
				<?php endif; ?>		
				
				<?php 
					$services_last_section_content = get_field("services_last_section_content");					
					if ($services_last_section_content != ""): ?>
					 <section class="ourservicesblackbg1 last-child">
						<div class="container">
							<div class="row">								
								<div class="col-md-12">
									<?php echo comm_express_kses($services_last_section_content); ?>
								</div>
							</div>								
						</div>						
					</section>
				<?php endif; ?>		
			   
			  
			  
			<?php endwhile; ?>

		</div>

	<?php endif; ?>  
</section>
<?php get_footer(); ?>