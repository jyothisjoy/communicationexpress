<?php
/**
 * Header Layout
 * @package CommExpress
 */



$comm_express_sticky = get_theme_mod('comm_express_sticky');
$comm_express_data_sticky = "false";
if ($comm_express_sticky) {
    $comm_express_data_sticky = "true";
}
global $wp_customize;

?>
<div class="main-header">
    <section id="middle-header" class="header-navbar <?php if (is_user_logged_in() && !isset($wp_customize)) {
        echo "login-user";
    } ?>" data-sticky="<?php echo esc_attr($comm_express_data_sticky); ?>">
        <div class="wrapper header-wrapper header-box">
            <div class="header-titles">
                <?php
                comm_express_site_logo();
                // comm_express_site_description();
                ?>
            </div>
            <div class="theme-header-areas header-areas-right menu-box">
                <div class="site-navigation">
                    <nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e('Horizontal', 'comm-express'); ?>"
                        role="navigation">
                        <ul class="primary-menu theme-menu">
                            <?php
                            if (has_nav_menu('comm-express-primary-menu')) {
                                wp_nav_menu(
                                    array(
                                        'container' => '',
                                        'items_wrap' => '%3$s',
                                        'theme_location' => 'comm-express-primary-menu',
                                    )
                                );
                            } else {
                                wp_list_pages(
                                    array(
                                        'match_menu_classes' => true,
                                        'show_sub_menu_icons' => true,
                                        'title_li' => false,
                                        'walker' => new comm_express_Walker_Page(),
                                    )
                                );
                            } ?>
                        </ul>
                    </nav>
                </div>
                <div class="navbar-controls twp-hide-js">
                    <button type="button" class="navbar-control navbar-control-offcanvas">
                        <span class="navbar-control-trigger" tabindex="-1">
                            <?php comm_express_the_theme_svg('menu'); ?>
                        </span>
                    </button>
                </div>
            </div>
            <div class="theme-header-areas header-areas-right header-social">
                <div class="header-search-icon">
                    <a href="#" class="search-toggle">
                        <i class="fa fa-search"></i> <!-- Use Font Awesome if available -->
                    </a>
                    <div class="search-form-wrapper">
                        <?php get_search_form(); ?>
                    </div>
                </div>
                <a href="<?php echo site_url('/request-a-quote/'); ?>" class="request-btn">Request a Quote</a>

            </div>
        </div>
    </section>
</div>