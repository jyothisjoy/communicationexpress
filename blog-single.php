<?php
/**
 * Template Name: Blog Single Template 
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
            <div class="commentSection" style="display: flex
;
    align-items: center;
    justify-content: flex-end;
    position: relative;
    text-align: end; width: 10%;">
              <?php print_r(get_comments_number()); ?><span style="width: 25px;
    margin: 0;margin-left: 10%;"> <svg xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                  <path fill="#292929"
                    d="M256 32C114.6 32 0 125.1 0 240c0 49.6 21.4 95 57 130.7C44.5 421.1 2.7 466 2.2 466.5c-2.2 2.3-2.8 5.7-1.5 8.7S4.8 480 8 480c66.3 0 116-31.8 140.6-51.4 32.7 12.3 69 19.4 107.4 19.4 141.4 0 256-93.1 256-208S397.4 32 256 32zM128 272c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm128 0c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm128 0c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32z" />
                </svg></span>
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
          <?php if ((is_single() || is_page()) && (comments_open() || get_comments_number()) && !post_password_required()) { ?>

            <div class="comments-wrapper">

              <a class="respond" href="#contact-popup"><span class="bubble-chat-stroke"></span>Respond</a>

              <?php // comments_template(); ?>
            </div>

            <?php
          } ?>
        </article>
      <?php endwhile; ?>
      <?php
      cc_related_posts(array(
        'limit' => 3,
        'order' => 'DESC'
      ));
      ?>
    </div>
  </div>
	   </div>

</div>
<div id="contact-popup" class="overlay">
  <div class="popup">

    <a class="close" href="#">&times;</a>
    <?php comments_template(); ?>
  </div>
</div>
<?php get_footer(); ?>