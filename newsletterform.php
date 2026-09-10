<?php
/**
 * Template Name: Newsletter Form Template 
 * The template for displaying Blog details.
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
		 <div class="secondrow content-area">
      <?php while (have_posts()):
        the_post(); ?>
        <div class="breadcrumb">
          <?php comm_express_breadcrumb(); ?>
        </div>
			 
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          
          <div class="headertitle post-title">
            <h3 class="all-blogs"><?php the_title(); ?></h3>

          </div>
			
          <div class="postContent">
            <?php
            the_content(sprintf(
              /* translators: %s: Name of current post. */
              wp_kses(__('Read More %s <span class="meta-nav">&rarr;</span>', 'comm-express'), array('span' => array('class' => array()))),
              the_title('<span class="screen-reader-text">"', '"</span>', false)
            ));

            wp_link_pages(array(
              'before' => '<div class="page-links">' . esc_html__('Pages:', 'comm-express'),
              'after' => '</div>',
            )); ?>
          </div>
         
        </article>
      <?php endwhile; ?>
     
    </div>
  </div>
	   </div>

</div>

<?php get_footer(); ?>