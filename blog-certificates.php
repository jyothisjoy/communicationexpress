<?php
/**
 * Template Name: Certificates List Template 
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
        <div class="breadcrumb breadcrumb-nav ">
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

        <div class="certfirstsec row">
          <div class="latestcert col-md-4">
            <div class="latestcert-logo ">
              <img src="<?php echo esc_url($cert_banner_7['url']); ?>" alt="<?php echo esc_attr($cert_title_7); ?>" />
            </div>
          </div>
          <div class="col-md-8">
            <h4 class="latestcert-title"><?php echo comm_express_kses($cert_title_7); ?></h4>
            <p class="latestcert-desc"><?php echo comm_express_kses($cert_desc_7); ?></p>

            <button onclick="window.open('<?php echo esc_js(esc_url_raw($cert_url_7)); ?>');" class="latestcert-button-text">
              <div class="visit-button">
                <span class="visit"> Visit </span><span><?php echo comm_express_kses($cert_url_7); ?></span><span class="more-information">
                  for more information</span>

              </div>
              <div class="arrow-up-right" style="left:5%"></div>
            </button>
          </div>
        </div>

        <div class="certgrid row">
          <?php for ($i = 6; $i >= 1; $i--) {
            $cert_title = get_field("certification_title_" . $i);
            $cert_banner = get_field("certifications_banner_" . $i);
            $cert_desc = get_field("certification_description_" . $i);
            $cert_url = get_field("certification_url_" . $i);

            ?>
            <div class="my-3 col-md-4">
              <div class="certgridlist">
              <div class="certgridbanner">
                <img src="<?php echo esc_url($cert_banner['url']) ?>" alt="<?php echo esc_attr($cert_title); ?>" />
              </div>

              <h4 class="certgridtitle"><?php echo comm_express_kses($cert_title); ?></h4>
            </div>
            </div>
          <?php } ?>

        </div>
		  </div>
		   </div>

      </div>
    </div>

  </div>

<?php get_footer(); ?>