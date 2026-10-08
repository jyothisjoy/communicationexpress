<?php
/**
 * The template for displaying a single Offer.
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

        <?php while (have_posts()):
          the_post(); ?>
          <div class="breadcrumb breadcrumb-nav">
            <?php comm_express_breadcrumb(); ?>
          </div>
          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="headertitle post-title">
              <h3 class="all-blogs"><?php the_title(); ?></h3>
            </div>
            <?php if (has_post_thumbnail()) { ?>
              <div class="postContent">
                <?php the_post_thumbnail('large'); ?>
              </div>
            <?php } ?>
            <div class="postContent">
              <?php the_content(); ?>
            </div>
          </article>
        <?php endwhile; ?>

      </div>
    </div>
  </div>
  </div>
  </div>

<?php get_footer(); ?>
