<?php
/**
 * The template for displaying the footer
 * @package CommExpress
 * @since 1.0.0
 */

/**
 * Toogle Contents
 * @hooked comm_express_content_offcanvas - 30
 */
do_action('comm_express_before_footer_content_action');



$comm_express_default = comm_express_get_default_theme_options();

$comm_express_footer_layout_facebook_link = esc_url(get_theme_mod(
    'comm_express_footer_layout_facebook_link',
    $comm_express_default['comm_express_footer_layout_facebook_link']
));

$comm_express_footer_layout_twitter_link = esc_url(get_theme_mod(
    'comm_express_footer_layout_twitter_link',
    $comm_express_default['comm_express_footer_layout_twitter_link']
));

$comm_express_footer_layout_pintrest_link = esc_url(get_theme_mod(
    'comm_express_footer_layout_pintrest_link',
    $comm_express_default['comm_express_footer_layout_pintrest_link']
));

$comm_express_footer_layout_instagram_link = esc_url(get_theme_mod(
    'comm_express_footer_layout_instagram_link',
    $comm_express_default['comm_express_footer_layout_instagram_link']
));

$comm_express_footer_layout_youtube_link = esc_url(get_theme_mod(
    'comm_express_footer_layout_youtube_link',
    $comm_express_default['comm_express_footer_layout_youtube_link']
));

?>

</div>

<footer class="site-footer">
    <?php do_action('digital_media_footer_content_action'); ?>
    <div class="container footer-spacing">
        <div class="footer-widget column-row">

            <?php if (is_active_sidebar('comm-express-footer-widget-0')): ?>
                <div class="footer-widgets-container footer-widget-one col-md-4">
                    <?php dynamic_sidebar('comm-express-footer-widget-0'); ?>
                </div>
            <?php endif; ?>

            <?php if (is_active_sidebar('comm-express-footer-widget-1')): ?>
                <div class="footer-widgets-container footer-widget-two col-md-8">
                    <?php dynamic_sidebar('comm-express-footer-widget-1'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
	<div class="container-fluid">
		<div class="marquee-text">
			<div class="marquee-text-track">
				<p>Motorola digital two-way radios Motorola digital two-way radios</p>

			</div>
		</div>
	 </div>	

    <div class="container footer-spacing">
        <div class="row">
            <div class="footer-logo col-md-2">
                <?php if (get_theme_mod('comm_express_footer_logo')): ?>
                    <img src="<?php echo esc_url(get_theme_mod('comm_express_footer_logo')); ?>" alt="Footer Logo">
                <?php endif; ?>
                <div class="footer-social">
                    <?php if ($comm_express_footer_layout_facebook_link || $comm_express_footer_layout_twitter_link || $comm_express_footer_layout_pintrest_link || $comm_express_footer_layout_instagram_link || $comm_express_footer_layout_youtube_link) { ?>
                        <?php if ($comm_express_footer_layout_facebook_link) { ?>
                            <a class="social-1" href="<?php echo esc_url($comm_express_footer_layout_facebook_link); ?>"><svg
                                    xmlns="http://www.w3.org/2000/svg" height="1em"
                                    viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2024 Fonticons, Inc. -->
                                    <path
                                        d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z" />
                                </svg></a>
                        <?php } ?>
                        <?php if ($comm_express_footer_layout_twitter_link) { ?>
                            <a class="social-2" href="<?php echo esc_url($comm_express_footer_layout_twitter_link); ?>"><svg
                                    xmlns="http://www.w3.org/2000/svg" height="1em"
                                    viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z" />
                                </svg></a>
                        <?php } ?>
                        <?php if ($comm_express_footer_layout_pintrest_link) { ?>
                            <a class="social-3" href="<?php echo esc_url($comm_express_footer_layout_pintrest_link); ?>"><svg
                                    xmlns="http://www.w3.org/2000/svg" height="1em"
                                    viewBox="0 0 384 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2024 Fonticons, Inc. -->
                                    <path
                                        d="M204 6.5C101.4 6.5 0 74.9 0 185.6 0 256 39.6 296 63.6 296c9.9 0 15.6-27.6 15.6-35.4 0-9.3-23.7-29.1-23.7-67.8 0-80.4 61.2-137.4 140.4-137.4 68.1 0 118.5 38.7 118.5 109.8 0 53.1-21.3 152.7-90.3 152.7-24.9 0-46.2-18-46.2-43.8 0-37.8 26.4-74.4 26.4-113.4 0-66.2-93.9-54.2-93.9 25.8 0 16.8 2.1 35.4 9.6 50.7-13.8 59.4-42 147.9-42 209.1 0 18.9 2.7 37.5 4.5 56.4 3.4 3.8 1.7 3.4 6.9 1.5 50.4-69 48.6-82.5 71.4-172.8 12.3 23.4 44.1 36 69.3 36 106.2 0 153.9-103.5 153.9-196.8C384 71.3 298.2 6.5 204 6.5z" />
                                </svg></a>
                        <?php } ?>
                        <?php if ($comm_express_footer_layout_instagram_link) { ?>
                            <a class="social-4" href="<?php echo esc_url($comm_express_footer_layout_instagram_link); ?>"><svg
                                    xmlns="http://www.w3.org/2000/svg" height="1em"
                                    viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2024 Fonticons, Inc. -->
                                    <path
                                        d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                                </svg></a>
                        <?php } ?>
                        <?php if ($comm_express_footer_layout_youtube_link) { ?>
                            <a class="social-5" href="<?php echo esc_url($comm_express_footer_layout_youtube_link); ?>"><svg
                                    xmlns="http://www.w3.org/2000/svg" height="1em"
                                    viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2024 Fonticons, Inc. -->
                                    <path
                                        d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z" />
                                </svg></a>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>

            <div class="footer-columns col-md-10">
                <!-- Footer Products Menu -->
                <div class="footer-column col-md-3">
                    <h3>Products</h3>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer-products',
                        'menu_class' => 'footer-menu-list',
                        'container' => false,
                    ));
                    ?>
                </div>

                <!-- Footer Services Menu -->
                <div class="footer-column col-md-3">
                    <h3>Services</h3>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer-services',
                        'menu_class' => 'footer-menu-list',
                        'container' => false,
                    ));
                    ?>
                </div>

                <!-- Footer Industries Menu -->
                <div class="footer-column col-md-3">
                    <h3>Industries</h3>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer-industries',
                        'menu_class' => 'footer-menu-list',
                        'container' => false,
                    ));
                    ?>
                </div>

                <!-- Footer Resources Menu -->
                <div class="footer-column col-md-3">
                    <h3>Resources</h3>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer-resources',
                        'menu_class' => 'footer-menu-list',
                        'container' => false,
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom footer-spacing">
        <div class="container">
		<div class="row foo-copyright">
            <p class="col-md-12 foo-col text-center">Copyright © Communications Express all rights reserved</p>
           <!-- <div class="footer-links col-md-6 foo-col">
                <a href="#">Privacy policy</a> |
                <a href="#">Terms & conditions</a>
            </div> -->
        </div>
		</div>
    </div>
</footer>

</div>
<?php wp_footer(); ?>
</body>

</html>