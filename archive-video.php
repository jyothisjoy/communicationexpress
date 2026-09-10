<?php
/**
 * The template for displaying single videos.
 * @package CommExpress
 * @since 1.0.0
 */
get_header();
?>
<div class="singular-main-block container">
  <div class="flex-row-d row px-2">
      <div class="col-md-3 p-3">

        <?php
        if (has_nav_menu('blog-sidebar')) {
          wp_nav_menu(array('theme_location' => 'blog-sidebar'));
        } ?>
      </div>
         <div class="col-md-9 p-3">
      <div class="secondrow">
<div class="content-area">
        <div class="breadcrumb breadcrumb-nav">
          <?php comm_express_breadcrumb(); ?>
        </div>
        <div class="headertitle">
          <h3 class="all-blogs">All Videos</h3>
          <div class="blogsearch">
            <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
              <input type="hidden" name="post_type" value="video" />
              <input type="search" id="search-form" class="search-input"
                placeholder="<?php echo esc_attr_x('Search …', 'placeholder'); ?>"
                value="<?php echo get_search_query(); ?>" name="s" />
            </form>
          </div>
        </div>
        <?php	
	
		$args = [
			'order' => 'ASC', // Order in ascending
			'orderby' => 'date', // Order by date (optional)
			'post_type' => 'video',
			'posts_per_page' => 6, // Number of posts per page
    		'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
		];

		$query = new WP_Query($args);

        // Start the loop
        if ($query->have_posts()): ?>
          <div class="bloggrid row">
            <?php
            while ($query->have_posts()):
              $query->the_post();
              $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
              $videoUrl = get_field('you_tube_video_url');
			  $videoContent = get_field('you_tube_video_content'); ?>

              <div class="videolist col-md-12 my-5">
                <div class="video-item">
                  <iframe width="100%" height="390" src="<?php echo esc_url($videoUrl); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
				<div class="video-text">
				  <h4 class="title"><?php the_title(); ?></h4>	
                  <div class="text"><?php echo comm_express_kses($videoContent); ?></div>
                </div>
				
              </div>
            <?php endwhile; ?>

          </div>
          <?php echo the_posts_pagination(); ?>
        <?php endif; 
	
	wp_reset_query();
	?>

      </div>
    </div>
  </div>
 </div>
  </div>


<?php get_footer(); ?>