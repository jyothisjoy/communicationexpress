<?php
/*
Template Name: Industry Construction
Template Post Type: industries
*/
get_header();
?>
<style>
  .network-boundaries {
    position: relative;
    color: #75787b;
    font-family: Mulish, var(--default-font-family);
    font-size: 32px;
    font-weight: 700;
    line-height: 52px;
    text-align: left;
  }

  .team-connect {
    position: relative;
    color: #ffffff;
    font-family: Mulish, var(--default-font-family);
    font-size: 32px;
    font-weight: 700;
    line-height: 52px;
    text-align: left;
  }
</style>
<section id="main">
  <div class="container">
    <div class="flex-row-d industries-details-law-enforcement row">





      <?php if (have_posts()): ?>
        <div class="flex-row-abd">
          <div class="breadcrumb">
            <?php comm_express_breadcrumb(); ?>
          </div>
          <?php
          while (have_posts()):
            the_post();

            $media_featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
            $media_featured_image = isset($media_featured_image[0]) ? $media_featured_image[0] : '';
            $desc = get_field("title_description");
            $stay_ahead_title = get_field("stay_ahead_title");
            $today_section = get_field("today_section");
            $collaborative_devices_title = get_field("collaborative_devices_title");
            $collaborative_devices_desc = get_field("collaborative_devices_desc");
            $two_way_radio_title = get_field("two_way_radio_title");

            ?>
            <section class="ourservicestitle row">
              <div class="titlefirst col-md-6">
                <img src="<?php echo esc_url($media_featured_image) ?>" />
              </div>
              <div class="titlesecond col-md-6">
                <h2 class="motorola-service"><?php the_title(); ?></h2>
                <p class="protect-radios"><?php echo comm_express_kses($desc); ?></p>
              </div>
            </section>


            <div class="stay-section">
              <?php echo comm_express_kses($stay_ahead_title); ?>
            </div>
            <div class="today-section">
              <ul class="today-section-span">

                <?php echo comm_express_kses($today_section); ?>

              </ul>
            </div>
            <div class="row todaysectionbelow m-1 todaysection-4col">
              <?php
              $todaybelowGrid = get_field("below_todays_section");
              if (isset($todaybelowGrid)) {
                for ($v = 1; $v <= count($todaybelowGrid); $v++) {
                  $todaybelowGridcontent = $todaybelowGrid['content_' . $v];
                  if (($todaybelowGridcontent['title'] != "")) {
                    // echo comm_express_kses($middleGridcontent);
                    ?>
                    <div class="col-md-4 ">
                      <div class="twocolumngrid res-space" style="border:none">
                        <div class="twocolumnheader mt-3">
                          <?php echo comm_express_kses($todaybelowGridcontent['title']); ?>
                        </div>
                        <div class="twocolumndesc">
                          <?php echo comm_express_kses($todaybelowGridcontent['description']); ?>
                        </div>


                      </div>
                    </div>
                  <?php }
                }
              } ?>


            </div>

            <div class="row black-container">

              <div class="col-12 m-4">
                <h2><span class="network-boundaries">Using Unified Workgroup Communications, network, device, and geographic
                    boundaries are</span><span class="team-connect">
                    overcome – your team members can connect from their preferred device to
                    other team members, anywhere, anytime with business-critical
                    information.</span>
                </h2>
                <?php
                $backcontainerGrid = get_field("black_container_section");
                if (isset($backcontainerGrid)) {
                  for ($v = 1; $v <= count($backcontainerGrid) - 1; $v++) {
                    $backcontainerGridcontent = $backcontainerGrid['content_' . $v];
                    if (isset($backcontainerGridcontent) && ($backcontainerGridcontent['title'] != "")) {
                      // echo comm_express_kses($middleGridcontent);
                      ?>
                      <div class="row ">

                        <div class="col-md-6">
                          <h4 class="backrowtitle"><?php echo comm_express_kses($backcontainerGridcontent['title']); ?></h4>
                        </div>
                        <div class="col-md-6">
                          <p class="backrowdesc"> <?php echo comm_express_kses($backcontainerGridcontent['description']); ?></p>
                        </div>



                      </div>
                    <?php }
                  }
                } ?>

              </div>

            </div>
            <section id="tab-section">
              <div class="container">
                <div class="tabs">
                  <button class="tab-link active" onclick="openTab(event, 'components')">Components</button>
                  <button class="tab-link" onclick="openTab(event, 'solutions')">Solutions</button>
                  <button class="tab-link" onclick="openTab(event, 'downloads')">Downloads</button>
                </div>
                <div id="components" class="tab-content active">
                  <?php if ($collaborative_devices_title != ""): ?>
                    <div class="collaborative-devices"><?php echo comm_express_kses($collaborative_devices_title); ?></div>
                  <?php endif; ?>
                  <?php if ($collaborative_devices_desc != ""): ?>
                    <div class="collaborative-devices-ul">
                      <ul class="collaborative-devices-ul-span">
                        <li>
                          <?php echo comm_express_kses($collaborative_devices_desc); ?>
                        </li>
                      </ul>
                    </div>
                  <?php endif; ?>
                  <div class="two-way-radios"><?php echo comm_express_kses($two_way_radio_title); ?></div>
                  <?php for ($a = 1; $a <= 2; $a++) {
                    $componentitems = get_field("componentitems_" . $a);
                    if (isset($componentitems)) {

                      ?>
                      <div class="row justify-content-center my-5">

                        <?php if ($componentitems['com_image'] != ""): ?>
                          <div
                            class="astro25imageCol col-md-6 <?php echo $componentitems["com_image_position"] == "Left" ? 'order-1' : 'order-2'; ?>">
                            <div class="astro25image"><img src="<?php echo esc_url($componentitems['com_image']['url']); ?>" /> </div>
                          </div>
                        <?php endif; ?>
                        <div
                          class="astro25contentCol col-md-6 <?php echo $componentitems["com_image_position"] == "Left" ? 'order-2' : 'order-1'; ?>">
                          <div class="astro-25-header">
                            <?php echo comm_express_kses($componentitems["com_title"]); ?>
                          </div>
                          <div class="astro-25-desc">
                            <?php echo comm_express_kses($componentitems["com_description"]); ?>

                            <div class="motorola-apx-p-25-portable-radios">
                              <a
                                href="<?php echo esc_url(empty($componentitems['com_read_more_link']) ? '#' : $componentitems['com_read_more_link']['url']); ?>"><?php echo comm_express_kses($componentitems['com_read_more_text']); ?></a>
                            </div>

                          </div>
                        </div>
                      </div>
                    <?php }
                  } ?>


                  <div class="row justify-content-start my-5 d-in-flex">
                    <?php
                    $middleGrid = get_field("middle_block_section");
                    if (isset($middleGrid)) {
                      for ($v = 1; $v <= count($middleGrid); $v++) {
                        $middleGridcontent = $middleGrid['content_' . $v];
                        if (($middleGridcontent['title'] != "")) {
                          // echo comm_express_kses($middleGridcontent);
                          ?>
                          <div class=" col-md-6 my-3">
                            <div class="twocolumngrid ">
                              <?php if (!empty($middleGridcontent['icon_image'])) { ?>
                                <img class="twocolumnimg"
                                  src="<?php echo esc_url(empty($middleGridcontent['icon_image']) ? "" : $middleGridcontent['icon_image']['url']); ?>" />
                              <?php } ?>
                              <div class="twocolumnheader mt-3">
                                <?php echo comm_express_kses($middleGridcontent['title']); ?>
                              </div>
                              <div class="twocolumndesc">
                                <?php echo comm_express_kses($middleGridcontent['description']); ?>
                              </div>

                              <a class="twocolumnurl"
                                href="<?php echo esc_url(empty($middleGridcontent['read_more_link']) ? "" : $middleGridcontent['read_more_link']['url']); ?>">Know
                                More</a>
                            </div>
                          </div>
                        <?php }
                      }
                    } ?>


                  </div>


                  <?php for ($a = 3; $a <= 6; $a++) {
                    $componentitems = get_field("componentitems_" . $a);
                    if (isset($componentitems)) {
                      // echo comm_express_kses($componentitems);
                      ?>
                      <div class="row justify-content-center my-5">

                        <?php if ($componentitems['com_image'] != ""): ?>
                          <div
                            class="astro25imageCol col-md-6 <?php echo $componentitems["com_image_position"] == "Left" ? 'order-1' : 'order-2'; ?>">
                            <div class="astro25image"><img src="<?php echo esc_url($componentitems['com_image']['url']); ?>" /> </div>
                          </div>
                        <?php endif; ?>
                        <div
                          class="astro25contentCol col-md-6 <?php echo $componentitems["com_image_position"] == "Left" ? 'order-2' : 'order-1'; ?>">
                          <div class="astro-25-header">
                            <?php echo comm_express_kses($componentitems["com_title"]); ?>
                          </div>
                          <div class="astro-25-desc">
                            <?php echo comm_express_kses($componentitems["com_description"]); ?>


                            <div class="motorola-apx-p-25-portable-radios">
                              <a
                                href="<?php echo esc_url(empty($componentitems['com_read_more_link']) ? '#' : $componentitems['com_read_more_link']['url']); ?>"><?php echo comm_express_kses($componentitems['com_read_more_text']); ?></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php }
                  } ?>
                </div>
                <div id="solutions" class="tab-content">
                  <?php $solutionsec_header = get_field("solutionsec_header");
                  $solutionsec_list = get_field("solutionsec_list");
                  ?>
                  <div class="row">
                    <div class="stay-section">
                      <?php echo comm_express_kses($solutionsec_header); ?>
                    </div>
                    <div class="today-section">
                      <ul class="today-section-span">

                        <?php echo comm_express_kses($solutionsec_list); ?>

                      </ul>
                    </div>
                  </div>

                  <div class="row justify-content-start d-in-flex">

                    <?php for ($l = 1; $l <= 6; $l++) {
                      $solutions = get_field("solution_content_" . $l);
                      if (isset($solutions) && $solutions['title'] != "") {
                        ?>
                        <div class="col-md-4 my-3">
                          <div class="solutionsgrid">
                            <div class="solutionheader">
                              <?php echo comm_express_kses($solutions['title']); ?>
                            </div>
                            <div class="solutiongridcontent mt-3 mb-5">
                              <?php echo comm_express_kses($solutions['description']); ?>
                            </div>
                            <?php if ($solutions['readmore_link'] != ""): ?>
                              <a href="<?php echo esc_url(empty($solutions['readmore_link']) ? '' : $solutions['readmore_link']['url']); ?>"
                                class="read-more">Read more</a>
                            <?php endif; ?>
                          </div>
                        </div>
                      <?php }
                    } ?>


                  </div>
                  <div class="row my-5 ">
					<div class="col-md-12">
                    <a class="request-btn btn2"
                      href="<?php $mckinsey_report_url = get_field('mckinsey_report_url');
                      echo esc_url($mckinsey_report_url['url']); ?>">Know
                      More</a> <span style="font-size:14px; font-weight:normal; color:#444444; margin:auto 1%;">*McKinsey
                      Global Institute
                      Report </span>
					  </div>
                  </div>
                  <div class="row black-container m-3 p-1 rounded">
                    <div class="row m-3">
                      <div class="col-md-10">There’s never been a better time to bring Unified Communications to your job
                        sites. Have one of our representatives contact you for a complimentary analysis of your
                        communications needs.</div>
                      <div class="col-md-2 position-relative"><a href="<?php echo site_url(); ?>/contact"
                          class="request-btn contactusbutton">Contact us</a></div>
                    </div>
                  </div>
                </div>
                <div id="downloads" class="tab-content">

                  <?php
                  for ($s = 1; $s <= 6; $s++) {
                    $downloadGroupTop = get_field("dowloads_" . $s . "");

                    if ($downloadGroupTop['title'] != "") { ?>
                      <div class="downloadsection mb-3">

                        <div class="case-studies"><?php echo comm_express_kses($downloadGroupTop['title']) ?></div>


                        <div class="downlist">
                          <div class="downloader">
                            <ol class="downloader-span p-0">
                              <?php

                              if (isset($downloadGroupTop)) {
                                for ($k = 1; $k <= count($downloadGroupTop) - 1; $k++) {
                                  $downloadlinks = $downloadGroupTop["dowload_details_" . $k];
                                  if (!empty($downloadlinks) && $downloadlinks['name'] != "") {
                                    ?>
                                    <li class="downloadlist">
                                      <?php echo comm_express_kses($downloadlinks["name"]); ?>
                                      <a href="<?php echo esc_url($downloadlinks['file']['url']); ?>" target="_blank">
                                        <img class="download-square-01-stroke-rounded"
                                          src="<?php echo get_template_directory_uri(); ?>/assets/images/download-square-01-stroke-rounded.svg" />
                                      </a>
                                    </li>
                                  <?php }
                                }
                              } ?>
                            </ol>
                          </div>

                        </div>

                      </div>
                    <?php }
                  } ?>



                </div>
              </div>
            </section>

          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>