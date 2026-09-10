<?php
/**
 * The template for displaying Video Details page.
 * @package CommExpress
 * @since 1.0.0
 */
get_header();
?>
<section id="main">
	<?php if (have_posts()): ?>
		<div class="video-single">
			<div class="container">
				<div class="breadcrumb">
					<?php comm_express_breadcrumb(); ?>
				</div>
			</div>
			<?php
			while (have_posts()):
				the_post();

				$videoUrl = get_field('you_tube_video_url');
				$videoContent = get_field('you_tube_video_content'); ?>

				<div class="container">
					<div class="videolist col-md-12 my-5">
						<div class="video-item">
							<iframe width="1280" height="720" src="<?php echo esc_url($videoUrl); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
						</div>
						<div class="video-text my-3">
							<h4 class="title"><?php the_title(); ?></h4>	
							<div class="text"><?php echo comm_express_kses($videoContent); ?></div>
						</div>
					</div>
				</div>
			  
			<?php endwhile; ?>

		</div>

	<?php endif; ?>  
</section>
<?php get_footer(); ?>