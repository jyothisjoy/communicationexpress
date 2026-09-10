<?php

/* Template Name: About Us Template */

get_header();
/*
echo comm_express_main_slider();
comm_express_product_section();
*/

?>
<?php
$comm_express_aboutus_title = get_field('about_us_title');
$comm_express_aboutus_desc = get_field('about_us_description');
$comm_express_banner = get_field('about_us_below_banner');

$comm_express_aboutus_wireless_header = get_field('wireless_header_text');
$comm_express_aboutus_wireless_tag = get_field('wireless_tag_points');
$comm_express_wireless_final = get_field('wireless_final_text');

$comm_express_aboutus_keybenefits_header = get_field('keybenefits_header_text');
$comm_express_aboutus_keybenefits_tag = get_field('keybenefits_key_points');
$comm_express_keybenefits_final = get_field('keybenefits_final_text');

$comm_express_aboutus_whychooseus_desc = get_field('why_choose_us_text');
$comm_express_aboutus_whychooseus_img = get_field('why_choose_us_image');


$comm_express_aboutus_our_services_image = get_field('our_services_image');
$comm_express_aboutus_our_services_header = get_field('our_services_header');
$comm_express_our_services_description = get_field('our_services_description');
$comm_express_aboutus_focus_counties = get_field('focus_counties');


// $comm_express_button_text = get_field('button_text');
// echo comm_express_kses($comm_express_banner_background_image['url']);
?>

<!-- About Section -->
<section id="about-us" class="section-spacing">
  <div class="container">
    <div class="aboutuscircle"></div>
    <?php if ($comm_express_aboutus_title != "") {
      echo comm_express_kses($comm_express_aboutus_title);
    } ?>
    <?php if ($comm_express_aboutus_desc != ""): ?>
      <p>
        <?php echo comm_express_kses($comm_express_aboutus_desc); ?>
      </p>
    <?php endif; ?>
  </div>

  <?php if ($comm_express_banner != ""): ?>
    <div class="image-section">
      <img src="<?php echo esc_url($comm_express_banner['url']); ?>" alt="Communication Express">
    </div>
  </section>
<?php endif; ?>

<section id="tab-section">
  <div class="container">
    <div class="tabs">
      <button class="tab-link active" onclick="openTab(event, 'wireless-integration')">Wireless Integration</button>
      <button class="tab-link" onclick="openTab(event, 'key-benefits')">Key Lifecycle Benefits</button>
      <button class="tab-link" onclick="openTab(event, 'why-choose-us')">Why Choose Us?</button>
    </div>
    <div id="wireless-integration" class="tab-content active">
      <?php if ($comm_express_aboutus_wireless_header != ""): ?>
        <p class="wirelessfirstp">
          <?php echo comm_express_kses($comm_express_aboutus_wireless_header); ?>
        </p>
      <?php endif; ?>
      <?php if ($comm_express_aboutus_wireless_tag != ""):
        $wtaglist = explode("|", $comm_express_aboutus_wireless_tag);
        ?>
        <ul>
          <?php foreach ($wtaglist as $wvalue) { ?>
            <li><?php echo comm_express_kses($wvalue); ?></li>
          <?php } ?>

        </ul>
      <?php endif; ?>
      <?php if ($comm_express_wireless_final != ""): ?>
        <p class="wirelesssecondp">
          <?php echo comm_express_kses($comm_express_wireless_final); ?>
        </p>
      <?php endif; ?>
    </div>
    <div id="key-benefits" class="tab-content">
      <?php if ($comm_express_aboutus_keybenefits_header != ""): ?>
        <p class="wirelessfirstp">
          <?php echo comm_express_kses($comm_express_aboutus_keybenefits_header); ?>
        </p>
      <?php endif; ?>
      <?php if ($comm_express_aboutus_keybenefits_tag != ""):
        $kbtaglist = explode("|", $comm_express_aboutus_keybenefits_tag);
        ?>
        <ul>
          <?php foreach ($kbtaglist as $value) { ?>
            <li><?php echo comm_express_kses($value); ?></li>
          <?php } ?>

        </ul>
      <?php endif; ?>
      <?php if ($comm_express_keybenefits_final != ""): ?>
        <p class="wirelesssecondp">
          <?php echo comm_express_kses($comm_express_keybenefits_final); ?>
        </p>
      <?php endif; ?>
    </div>
    <div id="why-choose-us" class="tab-content">
        <div class="row">
      <?php if ($comm_express_aboutus_whychooseus_desc != ""): ?>
        <!-- Text Content -->
        <div class="why-choose-us-firstblock col-md-6 ">
          <p class="wirelesssecondp">
            <?php echo comm_express_kses($comm_express_aboutus_whychooseus_desc); ?>
          </p>
        </div>
      <?php endif; ?>
      <!-- Service Image -->
      <?php if ($comm_express_aboutus_whychooseus_img != ""): ?>
        <div class="why-choose-us-secondblock col-md-6 ">
          <img src="<?php echo esc_url($comm_express_aboutus_whychooseus_img['url']); ?>" alt="Worker in safety gear" />
        </div>
      <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<section class="leadership-team">
  <div class="container">
    <h2 class="section-title">Company Leadership</h2>
    <div class="team-grid row justify-content-start">
      <?php for ($i = 1; $i <= 5; $i++) {
        $comm_express_aboutus_team_name = get_field('name_' . $i);
        $comm_express_aboutus_team_position = get_field('position_' . $i);
        $comm_express_team_desc = get_field('leadership_profile_description_' . $i);
        $comm_express_aboutus_profile_img = get_field('leadership_profile_photo_' . $i);
        if ($comm_express_aboutus_team_name != "") {
          ?>
          <!-- Team Member 1 -->
           <div class="col-md-4 my-3">
          <div class="team-member ">
            <?php if ($comm_express_aboutus_team_position != "") { ?>
              <h6 class="member-position"><?php echo comm_express_kses($comm_express_aboutus_team_position); ?></h6> <?php } ?>
            <?php if ($comm_express_aboutus_team_name != "") { ?>
              <h3 class="member-name"><?php echo comm_express_kses($comm_express_aboutus_team_name); ?></h3> <?php } ?>
            <?php if ($comm_express_aboutus_profile_img != "") { ?>
              <div class="member-photo">
                <img src="<?php echo esc_url($comm_express_aboutus_profile_img['url']) ?>"
                  alt="<?php $comm_express_aboutus_team_name; ?>" />
              </div>
            <?php } ?>
            <?php if ($comm_express_team_desc != "") { ?>
              <p class="member-description">
                <?php echo comm_express_kses($comm_express_team_desc); ?>
              </p>
            <?php } ?>
          </div>
          </div>
        <?php } ?>
      <?php } ?>
    </div>
  </div>
</section>


<section class="our-service-area">
  <div class="container">
    <div class="service-content-wrapper">
      <!-- Service Image -->
      <?php if ($comm_express_aboutus_our_services_image != ""): ?>
        <div class="service-image">
          <img src="<?php echo esc_url($comm_express_aboutus_our_services_image['url']); ?>" alt="Worker in safety gear" />
        </div>
      <?php endif; ?>
      <!-- Text Content -->
      <div class="service-text">
        <?php if ($comm_express_aboutus_our_services_header != ""): ?>
          <h2 class="section-title"><?php echo comm_express_kses($comm_express_aboutus_our_services_header); ?></h2>
        <?php endif; ?>
        <?php if ($comm_express_our_services_description != ""): ?>
          <p class="service-description">
            <?php echo comm_express_kses($comm_express_our_services_description); ?>
          </p>
        <?php endif; ?>
        <?php if ($comm_express_aboutus_focus_counties != ""):
          $fcounties = explode("|", $comm_express_aboutus_focus_counties);
          ?>
          <h3 class="counties-title">We focus on the following counties:</h3>



          <ul class="counties-list">
            <?php foreach ($fcounties as $fcvalue) { ?>
              <li><?php echo comm_express_kses($fcvalue); ?></li>
            <?php } ?>

          </ul>
        <?php endif; ?>

      </div>
    </div>
  </div>
</section>





<?php get_footer(); ?>