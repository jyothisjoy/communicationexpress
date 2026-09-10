<?php
/**
 * The template for displaying single posts and pages.
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
          <h3 class="all-blogs">All Testimonials</h3>
          <div class="blogsearch">
            <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
              <input type="hidden" name="post_type" value="testimonial" />
              <input type="search" id="search-form" class="search-input"
                placeholder="<?php echo esc_attr_x('Search …', 'placeholder'); ?>"
                value="<?php echo get_search_query(); ?>" name="s" />
            </form>
          </div>
        </div>
        <?php


        // Start the loop
        if (have_posts()): ?>
          <div class="bloggrid row">
            <?php
            while (have_posts()):
              the_post();
              $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
              $authorName = get_field('testimonial_author_name');
              $authorImage = get_field('testimonial_author_image', get_the_ID());
              $authorPosition = get_field('testimonial_author_position');
              $authorCompany = get_field('testimonial_author_company');
              $testimonialDesc = get_field('testimonial_description');
              $star_rating = get_post_meta(get_the_ID(), '_testimonial_star_rating', true);
              ?>
              <div class="bloglist col-md-6">
                <div class="testimonial-content">

                  <div class="testimonial-author">
                    <?php if ($authorImage != "") { ?>
                      <img src="<?php echo esc_url($authorImage['url']); ?>" alt="<?php echo esc_attr($authorName); ?>">
                    <?php }
                    if ($authorName != "") { ?>
                      <h4><?php echo comm_express_kses($authorName); ?></h4>
                    <?php }
                    if ($authorPosition != "") { ?>
                      <span><?php $authorPosition; ?></span>
                    <?php } ?>
                  </div>
                  <?php if ($testimonialDesc != "") { ?>
                    <p>"<?php echo comm_express_kses($testimonialDesc); ?>"</p>
                  <?php } ?>
                  <?php
                  if ($star_rating) {
                    echo '<div class="star-rating">';
                    for ($i = 1; $i <= 5; $i++) {
                      if ($i <= $star_rating) {
                        echo '<span class="star filled">★</span>'; // Filled star
                      } else {
                        echo '<span class="star">☆</span>'; // Empty star
                      }
                    }
                    echo '</div>';
                  }
                  ?>
                </div>
              </div>
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