<?php
/**
 * Template Name: Blog List Template 
 * The template for displaying list of Blogs.
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
		  <div id="primary" class="content-area">

        <div class="breadcrumb">
          <?php comm_express_breadcrumb(); ?>
        </div>
        <div class="blog-title headertitle">
          <h3 class="all-blogs">All Blogs</h3>
          <div class="blogsearch">
            <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
              <input type="hidden" name="post_type" value="post" />
              <input type="search" id="search-form" class="search-input"
                placeholder="<?php echo esc_attr_x('Search …', 'placeholder'); ?>"
                value="<?php echo get_search_query(); ?>" name="s" />
            </form>
          </div>
        </div>
        <?php
        // Define the custom post type slug
        $post_type = 'post'; // Replace with your post type slug
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        // Set up the query arguments
        $args = array(
          'post_type' => $post_type,
          'posts_per_page' => 6, // Limit to the latest 4 posts
          'paged' => $paged,
          'orderby' => 'ID',
          'order' => 'DESC',
        );

        // Create a new query
        $blog_query = new WP_Query($args);

        // Start the loop
        if ($blog_query->have_posts()): ?>
          <div class="bloggrid row">
            <?php
            while ($blog_query->have_posts()):
              $blog_query->the_post();
              $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
              ?>
              <a href="<?php the_permalink(); ?>" class="col-md-4 mb-4">
                <div class="bloglist">
                  <div class="bloglistimg">
                    <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title(); ?>" />
                  </div>
                  <h4 class="bloglisttitle"><?php the_title(); ?></h4>
                </div>
              </a>
            <?php endwhile; ?>



          </div>
          <?php echo the_posts_pagination(array('query' => $blog_query));
          // wp_pagenavi( array(  ) ); ?>
          <?php
          // if (function_exists(custom_pagination)) {
          custom_pagination($blog_query->max_num_pages, "", $paged);
          //  }
          ?>
        <?php endif; ?>

      </div>
		  </div>
      </div>
    </div>
  </div>

<?php get_footer(); ?>