<?php
/**
 * Template Name: Brochures Template 
 * The template for displaying Brochures details.
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
			
          <div class="postContent">
           <?php 
           $ebooklist = get_field("ebooklist"); 
           // echo comm_express_kses($ebooklist);
           $brochures_and_spec_sheets_list = get_field("brochures_and_spec_sheets_list"); 
           $protable_radio_list = get_field("protable_radio_list"); 
           $mobile_radios_list = get_field("mobile_radios_list"); 
           $repeaters_list = get_field("repeaters_list"); 
           
           $application_briefs_list = get_field("application_briefs_list"); 
           $casestudies_list = get_field("casestudies_list"); 
           $video_and_webminar_list = get_field("video_and_webminar_list"); 
           $whitepaperlist = get_field("whitepaperlist"); 
           ?>
           <div class="ebookgrid">
               <h3 class="title">eBooks</h3>
               <ul class="downloadList">
               <?php foreach($ebooklist as $ebook){ ?>
               <a href="<?php echo esc_url($ebook['download_link']['url']);?>"><li><?php echo comm_express_kses($ebook['name']);?></li></a>
               <?php } ?>
               </ul>
           </div>
           
           <div class="brouchersgrid row">    
           <div class="col-12">
               <h3 class="title">Brochures and Spec Sheets</h3>
               </div>
           
               <?php foreach($brochures_and_spec_sheets_list as $brochures_and_spec_sheets){ 
               // echo comm_express_kses($brochures_and_spec_sheets);
               
               ?>
                <div class="col-6 agrid">
                <div class="ebookgrid loop">
                    <h3 class="title"><?php echo comm_express_kses($brochures_and_spec_sheets['title']);?></h3>
               <ul class="downloadList">
                   <?php foreach($brochures_and_spec_sheets['downloadlist'] as $downloadlist){ ?>
               <a href="<?php  echo esc_url($downloadlist['downloadfile']['url']);?>"><li><?php  echo comm_express_kses($downloadlist['name']);?></li></a>
               <?php } ?>
                </ul>
           </div>
           </div>
               <?php } ?>
              
           </div>
           
           <div class="brouchersgrid row">      
            <div class="col-12">
               <h3 class="title">Portable Radios</h3>
               </div>
           
               <?php foreach($protable_radio_list as $protable_radio){ 
               // echo comm_express_kses($brochures_and_spec_sheets);
               
               ?>
                <div class="col-4 agrid">
                    <div class="ebookgrid loop ">
                    <h3 class="title"><?php echo comm_express_kses($protable_radio['title']);?></h3>
               <ul class="downloadList">
                   <?php foreach($protable_radio['downloadlist'] as $downloadlist){ ?>
               <a href="<?php  echo esc_url($downloadlist['downloadfile']['url']);?>"><li><?php  echo comm_express_kses($downloadlist['name']);?></li></a>
               <?php } ?>
                </ul>
           </div>
           </div>
               <?php } ?>
              
           </div>
           
           <div class="brouchersgrid row">
               <div class="col-12">           
               <h3 class="title">Mobile Radios</h3>
               </div>
           
               <?php foreach($mobile_radios_list as $mobile_radios){ 
               // echo comm_express_kses($brochures_and_spec_sheets);
               
               ?>
                <div class="col-4 agrid">
                <div class="ebookgrid loop">
                    <h3 class="title"><?php echo comm_express_kses($mobile_radios['title']);?></h3>
               <ul class="downloadList">
                   <?php foreach($mobile_radios['downloadlist'] as $downloadlist){ ?>
               <a href="<?php  echo esc_url($downloadlist['downloadfile']['url']);?>"><li><?php  echo comm_express_kses($downloadlist['name']);?></li></a>
               <?php } ?>
                </ul>
           </div>
           </div>
               <?php } ?>
              
           </div>
           
           <div class="brouchersgrid row">  
           <div class="col-12">
               <h3 class="title">Repeaters</h3>
               </div>
           
               <?php foreach($repeaters_list as $repeaters){ 
               // echo comm_express_kses($brochures_and_spec_sheets);
               
               ?>
                <div class="col-4 agrid">
                <div class="ebookgrid loop">
                    <h3 class="title"><?php echo comm_express_kses($repeaters['title']);?></h3>
               <ul class="downloadList">
                   <?php foreach($repeaters['downloadlist'] as $downloadlist){ ?>
               <a href="<?php  echo esc_url($downloadlist['downloadfile']['url']);?>"><li><?php  echo comm_express_kses($downloadlist['name']);?></li></a>
               <?php } ?>
                </ul>
           </div>
           </div>
               <?php } ?>
              
           </div>
           
            <div class="brouchersgrid">           
               <h3 class="title">Application Briefs</h3>
            <div class="ebookgrid">
               <ul class="downloadList">
               <?php foreach($application_briefs_list as $application_briefs){ ?>
               <a href="<?php echo esc_url($application_briefs['download_link']['url']);?>"><li><?php echo comm_express_kses($application_briefs['name']);?></li></a>
               <?php } ?>
               </ul>
           </div>
           </div>
           <div class="brouchersgrid">
               <h3 class="title">Case Studies</h3>
           <div class="ebookgrid">
               
               <ul class="downloadList">
               <?php foreach($casestudies_list as $casestudies){ ?>
               <a href="<?php echo esc_url($casestudies['download_link']['url']);?>"><li><?php echo comm_express_kses($casestudies['name']);?></li></a>
               <?php } ?>
               </ul>
           </div>
           </div>
           <div class="brouchersgrid">
               <h3 class="title">Videos and Webinars</h3>
           <div class="ebookgrid">
               
               <ul class="downloadList">
               <?php foreach($video_and_webminar_list as $video_and_webminar){ ?>
               <a href="<?php echo esc_url($video_and_webminar['download_link']['url']);?>"><li><?php echo comm_express_kses($video_and_webminar['name']);?></li></a>
               <?php } ?>
               </ul>
           </div>
           </div>
           <div class="brouchersgrid">
               <h3 class="title">White Papers</h3>
           <div class="ebookgrid">
               
               <ul class="downloadList">
               <?php foreach($whitepaperlist as $whitepaper){ ?>
               <a href="<?php echo esc_url($whitepaper['download_link']['url']);?>"><li><?php echo comm_express_kses($whitepaper['name']);?></li></a>
               <?php } ?>
               </ul>
           </div>
           </div>
          </div>
         
        </article>
      <?php endwhile; ?>
     
    </div>
  </div>
	   </div>

</div>

<?php get_footer(); ?>