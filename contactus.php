<?php

/* Template Name: Contact Us Page Template */

get_header();
/*
echo comm_express_main_slider();
comm_express_product_section();
*/

?>

<section id="tab-section">
  <div class="container">
    <div class="flex-row-feca row">
      <div class="col-md-5 p-1 contact-col">
        <div class="contactusaddresssection">

          <h2 class="communications-express-text">Communications Express LLC </h2>
          <p class="brookfield-corporate-drive">4437 Brookfield Corporate Drive, Suite 103/104 Chantilly, VA
            20151</p>
          <p class="local">Local: <a href="tel:+17033210470" onclick="trackPhoneClick('Local Phone', '703-321-0470');">(703) 321-0470</a></p>
          <div class="call-stroke">
            <div class="vector-e"></div>
          </div>
          
          <div class="call-stroke-f">
            <div class="vector-10"></div>
          </div>
          <p class="fax">Fax: <a href="tel:+17033210474" onclick="trackPhoneClick('Fax', '703-321-0474');">(703) 321-0474</a></p>
          <div class="printer-stroke"></div>
          <p class="questions-form">Have questions about Two-Way Radios communications, we can help.
            Please fill out the form below to contact Communications Express.
            One of our representatives will contact you shortly.</p>
          <div class="young-woman-security"></div>
        </div>
      </div>
      <div class="col-md-7  p-1 contact-col">
        <div class="requestform secondrow contactform">
          <h2 class="quote-form">What would you like to talk to us about?</h2>
          <?php echo do_shortcode('[contact-form-7 id="f956eb5" title="Contact Form"]'); ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php get_footer(); ?>