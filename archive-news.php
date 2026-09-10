<?php
/**

 * The template for displaying list of News.
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
          <h3 class="all-blogs">All Industry News</h3>
          <div class="blogsearch">
            <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
              <input type="hidden" name="post_type" value="news" />
              <input type="search" id="search-form" class="search-input"
                placeholder="<?php echo esc_attr_x('Search …', 'placeholder'); ?>"
                value="<?php echo get_search_query(); ?>" name="s" />
            </form>
          </div>
        </div>
        <?php
        if (have_posts()): ?>
          <div class="bloggrid row">
            <?php
            while (have_posts()):
              the_post();
              $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
              ?>
              <a href="<?php the_permalink(); ?>" class="col-md-4">
                <div class="bloglist">
                  <div class="bloglistimg">
                    <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title(); ?>" />
                  </div>
                  <h4 class="bloglisttitle"><?php the_title(); ?></h4>
                </div>
              </a>
            <?php endwhile; ?>




          </div>
          <?php the_posts_pagination(); ?>
        <?php endif; ?>

      </div>
    </div>
  </div>
</div>
  </div>
<?php get_footer(); ?>