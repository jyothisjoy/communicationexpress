<?php

/* Template Name: Request for Qoute Page Template */

get_header();
/*
echo comm_express_main_slider();
comm_express_product_section();
*/

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
			 <div class="secondrow content-area requestform">
      			<div class="breadcrumb">
				  <?php comm_express_breadcrumb(); ?>
				</div>
        		<h2 class="quote-form p-0 my-5">Need a quote on any of our two-way radio communication products? We
         		 can help. Please fill out the form below to request a free quote
         		 today. One of our representatives will contact you shortly.</h2>
        		<?php echo do_shortcode('[contact-form-7 id="a5dee3c" title="Request Form"]'); ?>
      		</div>
  		</div>
	 </div>
</div>

<?php get_footer(); ?>