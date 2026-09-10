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
            <div class="headertitle post-meta">
              <div style="display: flex; gap: 3%; align-items: inherit;">
                <div class="authorimage"><?php echo get_avatar(get_the_author_meta('ID'), 96); ?></div>
                <div class="entry-meta">

                  <h3 style="width:100%; margin-bottom:1%;"> <?php
                  comm_express_posted_by(false);
                  ?></h3>
                  <h5>
                    <?php
                    comm_express_posted_on(false);
                    ?>
                    </h6>
                    <?php


                    // comm_express_entry_footer( $cats = true, $tags = false, $edits = false );
                    ?>
                </div>
              </div>

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
        <?php
        cc_related_posts(array(
          'limit' => 3,
          'order' => 'DESC',
          'post_type' => 'news'
        ));
        ?>
      </div>

    </div>
  </div>
  </div>
  </div>

<?php get_footer(); ?>