<?php
/**
 * The template for displaying Industries List .
 * @package CommExpress
 * @since 1.0.0
 */
get_header();
?>
<div id="site-content" class="main-banner">
  <div class="slider-box"
    style="background: url('<?php bloginfo('template_directory'); ?>/assets/images/capitol-washington-united-states-1.png');">
    <div class="main-slider">
      <div class="swiper-container theme-main-carousel">
        <div class="swiper-wrapper">
          <div class="main">
            <h2 class="headertext"> Industries </h2>
          </div>
        </div>

      </div>
    </div>
  </div>

</div>
<div class="services-page-section section-spacing">
<div class="container p-0">
  <h2 class="experience-beyond-boundaries">EXPERIENCE BEYOUND BOUNDARIES</h2>
  <p class="communications-express">Communications Express is based in Chantilly, Virginia. We provide Two-
    Way Radio and wireless communication solutions in Northern Virginia,
    Maryland and the Washington D.C. area. We are proud to be an authorized
    Motorola Solutions Radio Solutions Channel Partner and Motorola
    Solutions Service Specialist.</p>
</div>
<?php if (have_posts()): ?>
  <div class="flex-row-abd container p-0">
    <div class="row mb-5">
      <?php
      while (have_posts()):
        the_post();

        $media_featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
        $media_featured_image = isset($media_featured_image[0]) ? $media_featured_image[0] : '';
        ?>
        <div class="col-md-3 my-3">
          <div class="industiresgrid">
            <div class="image-f">
              <img src="<?php echo esc_url($media_featured_image) ?>" />
            </div>
            <div class="flex-row-acc">
              <span class="construction"><?php the_title(); ?></span>
              <a href="<?php the_permalink(); ?>" target="_blank">
                <div class="arrow-up-right"></div>
              </a>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
    <?php the_posts_pagination(); ?>
  </div>

<?php endif; ?>
</div>


<?php get_footer(); ?>