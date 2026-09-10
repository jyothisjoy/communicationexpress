<?php
/**
 * Template Name: Partners Template 
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
        <div class="breadcrumb breadcrumb-nav">
          <?php comm_express_breadcrumb();
          $cert_header_title = get_field("certifications_header_title");
          $cert_title_7 = get_field("certification_title_7");
          $cert_banner_7 = get_field("certifications_banner_7");
          $cert_desc_7 = get_field("certification_description_7");
          $cert_url_7 = get_field("certification_url_7");



          ?>
        </div>
        <div class="headertitle">
          <h3 class="all-blogs"><?php echo comm_express_kses($cert_header_title); ?></h3>
        </div>
        <?php for ($i = 7; $i >= 1; $i--) {
          $cert_title = get_field("certification_title_" . $i);
          $cert_banner = get_field("certifications_banner_" . $i);
          $cert_desc = get_field("certification_description_" . $i);
          $cert_url = get_field("certification_url_" . $i);
          if ($cert_title != "") {
            ?>
            <div class="certfirstsec row mb-5">
              <div class="latestcert col-md-5">
                <div class="latestcert-logo">
                  <img src="<?php echo esc_url($cert_banner['url']); ?>" alt="<?php echo esc_attr($cert_title); ?>" />
                </div>
              </div>
              <div class="col-md-7">
                <h4 class="latestcert-title"><?php echo comm_express_kses($cert_title); ?></h4>
                <p class="latestcert-desc"><?php echo comm_express_kses($cert_desc); ?></p>
                <button onclick="window.open('<?php echo esc_js(esc_url_raw($cert_url)); ?>');" class="latestcert-button-text">
                  <div class="visit-button">
                    <span class="visit"> Visit </span><span><?php echo comm_express_kses($cert_url); ?></span><span class="more-information">
                      for
                      more information</span>

                  </div>
                  <div class="arrow-up-right" style="left:5%"></div>
                </button>
              </div>
            </div>

          <?php }
        } ?>
      </div>
      </div>
		 
    </div>
  </div>
  </div>

<?php get_footer(); ?>