<?php
/**
 * CommExpress Dynamic Styles
 *
 * @package CommExpress
 */

// Enqueue the main stylesheet
function comm_express_enqueue_styles() {
    // Replace 'your-main-stylesheet-handle' with your actual stylesheet handle
    wp_enqueue_style('comm-express-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'comm_express_enqueue_styles');

// Function to add dynamic CSS
function comm_express_dynamic_css() {
    // Get default theme options
    $comm_express_default = comm_express_get_default_theme_options();

    // Sanitize and get theme customizations
    $comm_express_default_text_color = esc_attr(get_theme_mod('comm_express_default_text_color', '')); // Default value if needed
    $logo_width_range = absint(get_theme_mod('logo_width_range', $comm_express_default['logo_width_range']));
    $comm_express_breadcrumb_font_size = absint(get_theme_mod('comm_express_breadcrumb_font_size', $comm_express_default['comm_express_breadcrumb_font_size']));
    $comm_express_menu_font_size = absint(get_theme_mod('comm_express_menu_font_size', $comm_express_default['comm_express_menu_font_size']));
    $comm_express_border_color = esc_attr(get_theme_mod('comm_express_border_color', '')); // Default value if needed
    $background_color = '#' . ltrim(esc_attr(get_theme_mod('background_color', $comm_express_default['comm_express_background_color'])), '#');

    // Create dynamic CSS
    $dynamic_css = "
        body,
        .offcanvas-wraper,
        .header-searchbar-inner {
            background-color: {$background_color};
        }

        a:not(:hover):not(:focus):not(.btn-fancy),
        body, button, input, select, optgroup, textarea {
            color: {$comm_express_default_text_color};
        }

        .site-topbar, .site-navigation,
        .offcanvas-main-navigation li,
        .offcanvas-main-navigation .sub-menu,
        .offcanvas-main-navigation .submenu-wrapper .submenu-toggle,
        .post-navigation,
        .widget .tab-head .twp-nav-tabs,
        .widget-area-wrapper .widget,
        .footer-widgetarea,
        .site-info,
        .right-sidebar .widget-area-wrapper,
        .left-sidebar .widget-area-wrapper,
        .widget-title,
        .widget_block .wp-block-group > .wp-block-group__inner-container > h2,
        input[type='text'],
        input[type='password'],
        input[type='email'],
        input[type='url'],
        input[type='date'],
        input[type='month'],
        input[type='time'],
        input[type='datetime'],
        input[type='datetime-local'],
        input[type='week'],
        input[type='number'],
        input[type='search'],
        input[type='tel'],
        input[type='color'],
        textarea {
            border-color: {$comm_express_border_color};
        }

        .site-logo .custom-logo-link {
            max-width: {$logo_width_range}px;
        }

        .site-navigation .primary-menu > li a {
            font-size: {$comm_express_menu_font_size}px;
        }

        .breadcrumbs {
            font-size: {$comm_express_breadcrumb_font_size}px;
        }
    ";

    // Add inline styles to the main stylesheet
    wp_add_inline_style('comm-express-style', $dynamic_css); // Replace with your actual stylesheet handle
}

add_action('wp_enqueue_scripts', 'comm_express_dynamic_css');
