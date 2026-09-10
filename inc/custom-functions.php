<?php
/**
 * Custom Functions.
 *
 * @package CommExpress
 */

if (!function_exists('comm_express_fonts_url')):

    //Google Fonts URL
    function comm_express_fonts_url()
    {

        $font_families = array(
            'Mulish:ital,wght@0,200..800;1,200..800', //    font-family: "Mulish", sans-serif;
            'Rajdhani:ital,wght@0,200..800;1,200..800', //    font-family: "Mulish", sans-serif;
        );

        $fonts_url = add_query_arg(array(
            'family' => implode('&family=', $font_families),
            'display' => 'swap',
        ), 'https://fonts.googleapis.com/css2');

        return esc_url_raw($fonts_url);

    }

endif;

if (!function_exists('comm_express_sub_menu_toggle_button')):

    function comm_express_sub_menu_toggle_button($args, $item, $depth)
    {

        // Add sub menu toggles to the main menu with toggles
        if ($args->theme_location == 'comm-express-primary-menu' && isset($args->show_toggles)) {

            // Wrap the menu item link contents in a div, used for positioning
            $args->before = '<div class="submenu-wrapper">';
            $args->after = '';

            // Add a toggle to items with children
            if (in_array('menu-item-has-children', $item->classes)) {

                $toggle_target_string = '.menu-item.menu-item-' . $item->ID . ' > .sub-menu';

                // Add the sub menu toggle
                $args->after .= '<button type="button" class="theme-aria-button submenu-toggle" data-toggle-target="' . $toggle_target_string . '" data-toggle-type="slidetoggle" data-toggle-duration="250" aria-expanded="false"><span class="btn__content" tabindex="-1"><span class="screen-reader-text">' . esc_html__('Show sub menu', 'comm-express') . '</span>' . comm_express_get_theme_svg('chevron-down') . '</span></button>';

            }

            // Close the wrapper
            $args->after .= '</div><!-- .submenu-wrapper -->';
            // Add sub menu icons to the main menu without toggles (the fallback menu)

        } elseif ($args->theme_location == 'comm-express-primary-menu') {

            if (in_array('menu-item-has-children', $item->classes)) {

                $args->before = '<div class="link-icon-wrapper">';
                $args->after = comm_express_get_theme_svg('chevron-down') . '</div>';

            } else {

                $args->before = '';
                $args->after = '';

            }

        }

        return $args;

    }

endif;

add_filter('nav_menu_item_args', 'comm_express_sub_menu_toggle_button', 10, 3);

if (!function_exists('comm_express_the_theme_svg')):

    function comm_express_the_theme_svg($svg_name, $return = false)
    {

        if ($return) {

            return comm_express_get_theme_svg($svg_name); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in comm_express_get_theme_svg();.

        } else {

            echo comm_express_get_theme_svg($svg_name); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in comm_express_get_theme_svg();.

        }
    }

endif;

if (!function_exists('comm_express_get_theme_svg')):

    function comm_express_get_theme_svg($svg_name)
    {

        // Make sure that only our allowed tags and attributes are included.
        $svg = wp_kses(
            comm_express_SVG_Icons::get_svg($svg_name),
            array(
                'svg' => array(
                    'class' => true,
                    'xmlns' => true,
                    'width' => true,
                    'height' => true,
                    'viewbox' => true,
                    'aria-hidden' => true,
                    'role' => true,
                    'focusable' => true,
                ),
                'path' => array(
                    'fill' => true,
                    'fill-rule' => true,
                    'd' => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill' => true,
                    'fill-rule' => true,
                    'points' => true,
                    'transform' => true,
                    'focusable' => true,
                ),
                'polyline' => array(
                    'fill' => true,
                    'points' => true,
                ),
                'line' => array(
                    'fill' => true,
                    'x1' => true,
                    'x2' => true,
                    'y1' => true,
                    'y2' => true,
                ),
            )
        );
        if (!$svg) {
            return false;
        }
        return $svg;

    }

endif;

if (!function_exists('comm_express_post_category_list')):

    // Post Category List.
    function comm_express_post_category_list($select_cat = true)
    {

        $post_cat_lists = get_categories(
            array(
                'hide_empty' => '0',
                'exclude' => '1',
            )
        );

        $post_cat_cat_array = array();
        if ($select_cat) {

            $post_cat_cat_array[''] = esc_html__('-- Select Category --', 'comm-express');

        }

        foreach ($post_cat_lists as $post_cat_list) {

            $post_cat_cat_array[$post_cat_list->slug] = $post_cat_list->name;

        }

        return $post_cat_cat_array;
    }

endif;

if (!function_exists('comm_express_single_post_navigation')):

    function comm_express_single_post_navigation()
    {

        $comm_express_default = comm_express_get_default_theme_options();
        $twp_navigation_type = esc_attr(get_post_meta(get_the_ID(), 'twp_disable_ajax_load_next_post', true));
        $current_id = '';
        $article_wrap_class = '';
        global $post;
        $current_id = $post->ID;
        if ($twp_navigation_type == '' || $twp_navigation_type == 'global-layout') {
            $twp_navigation_type = get_theme_mod('twp_navigation_type', $comm_express_default['twp_navigation_type']);
        }

        if ($twp_navigation_type != 'no-navigation' && 'post' === get_post_type()) {

            if ($twp_navigation_type == 'theme-normal-navigation') { ?>

                <div class="navigation-wrapper">
                    <?php
                    // Previous/next post navigation.
                    the_post_navigation(array(
                        'prev_text' => '<span class="arrow" aria-hidden="true">' . comm_express_the_theme_svg('arrow-left', $return = true) . '</span><span class="screen-reader-text">' . esc_html__('Previous post:', 'comm-express') . '</span><span class="post-title">%title</span>',
                        'next_text' => '<span class="arrow" aria-hidden="true">' . comm_express_the_theme_svg('arrow-right', $return = true) . '</span><span class="screen-reader-text">' . esc_html__('Next post:', 'comm-express') . '</span><span class="post-title">%title</span>',
                    )); ?>
                </div>
                <?php

            } else {

                $next_post = get_next_post();
                if (isset($next_post->ID)) {

                    $next_post_id = $next_post->ID;
                    echo '<div loop-count="1" next-post="' . absint($next_post_id) . '" class="twp-single-infinity"></div>';

                }
            }

        }

    }

endif;

add_action('comm_express_navigation_action', 'comm_express_single_post_navigation', 30);

if (!function_exists('comm_express_content_offcanvas')):

    // Offcanvas Contents
    function comm_express_content_offcanvas()
    { ?>

        <div id="offcanvas-menu">
            <div class="offcanvas-wraper">
                <div class="close-offcanvas-menu">
                    <div class="offcanvas-close">
                        <a href="javascript:void(0)" class="skip-link-menu-start"></a>
                        <button type="button" class="button-offcanvas-close">
                            <span class="offcanvas-close-label">
                                <?php echo esc_html__('Close', 'comm-express'); ?>
                            </span>
                        </button>
                    </div>
                </div>
                <div id="primary-nav-offcanvas" class="offcanvas-item offcanvas-main-navigation">
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
                                        'show_toggles' => true,
                                    )
                                );
                            } else {

                                wp_list_pages(
                                    array(
                                        'match_menu_classes' => true,
                                        'show_sub_menu_icons' => true,
                                        'title_li' => false,
                                        'show_toggles' => true,
                                        'walker' => new comm_express_Walker_Page(),
                                    )
                                );
                            }
                            ?>
                        </ul>
                    </nav><!-- .primary-menu-wrapper -->
                </div>
                <a href="javascript:void(0)" class="skip-link-menu-end"></a>
            </div>
        </div>

        <?php
    }

endif;

add_action('comm_express_before_footer_content_action', 'comm_express_content_offcanvas', 30);

if (!function_exists('comm_express_footer_content_widget')):

    function comm_express_footer_content_widget()
    {

        $comm_express_default = comm_express_get_default_theme_options();

        $comm_express_footer_column_layout = absint(get_theme_mod('comm_express_footer_column_layout', $comm_express_default['comm_express_footer_column_layout']));
        $comm_express_footer_sidebar_class = 12;
        if ($comm_express_footer_column_layout == 2) {
            $comm_express_footer_sidebar_class = 6;
        }
        if ($comm_express_footer_column_layout == 3) {
            $comm_express_footer_sidebar_class = 4;
        }
        ?>

        <div class="footer-widgetarea">
            <div class="wrapper">
                <div class="column-row">

                    <?php for ($i = 0; $i < $comm_express_footer_column_layout; $i++) {
                        ?>
                        <div class="column <?php echo 'column-' . absint($comm_express_footer_sidebar_class); ?> column-sm-12">
                            <?php dynamic_sidebar('comm-express-footer-widget-' . $i); ?>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>

        <?php

    }

endif;

add_action('comm_express_footer_content_action', 'comm_express_footer_content_widget', 10);

if (!function_exists('comm_express_footer_content_info')):

    /**
     * Footer Copyright Area
     **/
    function comm_express_footer_content_info()
    {

        $comm_express_default = comm_express_get_default_theme_options(); ?>
        <div class="site-info">
            <div class="wrapper">
                <div class="column-row">
                    <div class="column column-9">
                        <div class="footer-credits">
                            <div class="footer-copyright">
                                <?php
                                $comm_express_footer_copyright_text = wp_kses_post(get_theme_mod('comm_express_footer_copyright_text', $comm_express_default['comm_express_footer_copyright_text']));
                                echo esc_html($comm_express_footer_copyright_text);
                                echo '<br>';
                                echo esc_html__('Theme: ', 'comm-express') . 'CommExpress ' . esc_html__('By ', 'comm-express') . '  <span>' . esc_html__('commexp ', 'comm-express') . '</span>';
                                echo esc_html__('Powered by ', 'comm-express') . '<a href="' . esc_url('https://wordpress.org') . '" title="' . esc_attr__('WordPress', 'comm-express') . '" target="_blank"><span>' . esc_html__('WordPress.', 'comm-express') . '</span></a>';
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="column column-3 align-text-right">
                        <a class="to-the-top" href="#site-header">
                            <span class="to-the-top-long">
                                <?php
                                printf(esc_html__('To the Top %s', 'comm-express'), '<span class="arrow" aria-hidden="true">&uarr;</span>');
                                ?>
                            </span>
                            <span class="to-the-top-short">
                                <?php
                                printf(esc_html__('Up %s', 'comm-express'), '<span class="arrow" aria-hidden="true">&uarr;</span>');
                                ?>
                            </span>
                        </a>

                    </div>
                </div>
            </div>
        </div>

        <?php
    }

endif;

add_action('comm_express_footer_content_action', 'comm_express_footer_content_info', 20);


if (!function_exists('comm_express_main_slider')):

    function comm_express_main_slider()
    {
        $output = '';
        $comm_express_defaults = comm_express_get_default_theme_options();
        $comm_express_header_slider = get_theme_mod('comm_express_header_slider', $comm_express_defaults['comm_express_header_slider']);

        // Debugging header slider status
        if (!$comm_express_header_slider) {
            error_log('Header slider is not enabled or has a falsy value.');
            return '';  // Exit early if no slider
        }

        $comm_express_banner_background_image = get_theme_mod('comm_express_banner_background_image', $comm_express_defaults['comm_express_banner_background_image']);
        $comm_express_header_banner_cat = get_theme_mod('comm_express_header_banner_cat');

        $banner_query = new WP_Query(array(
            'post_type' => 'post',
            'posts_per_page' => 4,
            'post__not_in' => get_option('sticky_posts'),
            'category_name' => esc_html($comm_express_header_banner_cat),
        ));

        // Check if the query has posts
        if (!$banner_query->have_posts()) {
            error_log('No posts found for the banner query.');
            return '';  // Exit early if no posts
        }

        ob_start();  // Start output buffering
        ?>
        <div id="site-content" class="main-banner">
            <div class="slider-box" style="background: url(<?php echo esc_url($comm_express_banner_background_image); ?>);">
                <div class="main-slider">
                    <div class="swiper-container theme-main-carousel">
                        <div class="swiper-wrapper">
                            <?php while ($banner_query->have_posts()):
                                $banner_query->the_post();
                                $comm_express_featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large')[0] ?? get_template_directory_uri() . '/assets/images/default.png';
                                ?>
                                <div class="swiper-slide main-carousel-item">
                                    <div class="slider-main">
                                        <div class="left-box">
                                            <div class="slide-heading-main">
                                                <div class="main-carousel-caption">
                                                    <div class="post-content">
                                                        <header class="entry-header">
                                                            <h2 class="slider-heading">
                                                                <a href="<?php the_permalink(); ?>"
                                                                    rel="bookmark"><span><?php echo esc_html(get_the_title()); ?></span></a>
                                                            </h2>
                                                        </header>
                                                        <div class="entry-content">
                                                            <?php
                                                            if (has_excerpt()) {
                                                                echo esc_html(get_the_excerpt());
                                                            } else {
                                                                echo esc_html(wp_trim_words(get_the_content(), 25, '...'));
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="slide-btn">
                                                            <a href="<?php the_permalink(); ?>" class="btn-fancy btn-fancy-primary">
                                                                <?php echo esc_html__('Get Started Now', 'comm-express'); ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="right-box">
                                            <div class="image-main-box">
                                                <div class="data-bg banner-img"
                                                    data-background="<?php echo esc_url($comm_express_featured_image); ?>">
                                                    <a href="<?php the_permalink(); ?>" class="theme-image-responsive"></a>
                                                </div>
                                                <?php comm_express_post_format_icon(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        wp_reset_postdata();
        $output = ob_get_clean(); // Get buffered output and clean buffer
        return $output; // Return the output instead of echoing
    }

endif;



if (!function_exists('comm_express_product_section')):

    function comm_express_product_section()
    {

        $comm_express_default = comm_express_get_default_theme_options();

        $comm_express_header_case_studies = get_theme_mod('comm_express_header_case_studies', $comm_express_default['comm_express_header_case_studies']);
        $commexp_storefron_locations_post_cat = get_theme_mod('commexp_storefron_locations_post_cat');

        $comm_express_team_section_subtitle = esc_html(get_theme_mod(
            'comm_express_team_section_subtitle',
            $comm_express_default['comm_express_team_section_subtitle']
        ));

        $comm_express_team_section_title = esc_html(get_theme_mod(
            'comm_express_team_section_title',
            $comm_express_default['comm_express_team_section_title']
        ));

        $comm_express_locations_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 6, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($commexp_storefron_locations_post_cat)));

        if ($comm_express_locations_query->have_posts()):
            if ($comm_express_header_case_studies) {
                ?>

                <div class="theme-product-block">
                    <div class="wrapper">
                        <div class="section-heading">
                            <?php if ($comm_express_team_section_subtitle) { ?>
                                <h6><?php echo esc_html($comm_express_team_section_subtitle); ?>
                                    <span><?php echo esc_html($comm_express_team_section_subtitle); ?></span>
                                </h6>
                            <?php } ?>
                            <?php if ($comm_express_team_section_title) { ?>
                                <h4><?php echo esc_html($comm_express_team_section_title); ?></h4>
                            <?php } ?>
                        </div>
                        <div class="tab-box">
                            <!-- Tab Header -->
                            <div class="tab-header">
                                <?php
                                for ($i = 1; $i <= 4; $i++) {
                                    $comm_express_tab_title = get_theme_mod('comm_express_price_list_tab_title' . $i);
                                    if ($comm_express_tab_title) {
                                        echo '<div class="tab-item ' . (($i == 1) ? 'active' : '') . '" onclick="showTabContent(' . $i . ')">' . esc_html($comm_express_tab_title) . '</div>';
                                    }
                                }
                                ?>
                            </div>
                            <!-- Tab Content -->
                            <?php if (get_theme_mod('comm_express_category_tab1') || get_theme_mod('comm_express_category_tab2') || get_theme_mod('comm_express_category_tab3') || get_theme_mod('comm_express_category_tab4')) { ?>
                                <div class="tabcontent">
                                    <?php

                                    // Separate post query outside the tab content loop
                                    $comm_express_header_pricing_plans_cats = array(
                                        get_theme_mod('comm_express_category_tab1'),
                                        get_theme_mod('comm_express_category_tab2'),
                                        get_theme_mod('comm_express_category_tab3'),
                                        get_theme_mod('comm_express_category_tab4')
                                    );

                                    for ($i = 1; $i <= 4; $i++) {
                                        $category_slug = esc_html($comm_express_header_pricing_plans_cats[$i - 1]);

                                        $comm_express_tab_banner_query = new WP_Query(array(
                                            'post_type' => 'post',
                                            'posts_per_page' => 2,
                                            'post__not_in' => get_option("sticky_posts"),
                                            'category_name' => $category_slug
                                        ));

                                        if ($comm_express_tab_banner_query->have_posts()):
                                            echo '<div class="tab-content" id="tab-content-' . $i . '">'; ?>
                                            <div class="post-main-content">
                                                <?php
                                                $s = 1;
                                                while ($comm_express_tab_banner_query->have_posts()):
                                                    $comm_express_tab_banner_query->the_post();
                                                    $comm_express_featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                                    $comm_express_featured_image = isset($comm_express_featured_image[0]) ? $comm_express_featured_image[0] : '';

                                                    $comm_express_team_section_designation = esc_html(get_theme_mod('comm_express_team_section_designation' . $s));

                                                    ?>
                                                    <div class="theme-article-post slider-post-content">
                                                        <div class="entry-thumbnail">
                                                            <div class="data-bg featured-img"
                                                                data-background="<?php echo esc_url($comm_express_featured_image ? $comm_express_featured_image : get_template_directory_uri() . '/assets/images/default.png'); ?>">
                                                                <a href="<?php the_permalink(); ?>" class="theme-image-responsive" tabindex="0"></a>
                                                            </div>
                                                            <?php comm_express_post_format_icon(); ?>
                                                        </div>
                                                        <div class="main-owl-caption">
                                                            <div class="post-content-location">
                                                                <span class="slide-cat">
                                                                    <?php
                                                                    $categories = get_the_category();
                                                                    if (!empty($categories)) {
                                                                        echo esc_html($categories[0]->name); // Display the first category name
                                                                    }
                                                                    ?>
                                                                </span>
                                                                <header class="entry-header">
                                                                    <?php if ($comm_express_team_section_designation) { ?>
                                                                        <p><?php echo esc_html($comm_express_team_section_designation); ?></p>
                                                                    <?php } ?>
                                                                    <h2 class="entry-title entry-title-big">
                                                                        <a href="<?php the_permalink(); ?>"
                                                                            rel="bookmark"><span><?php the_title(); ?></span></a>
                                                                    </h2>
                                                                    <a class="banner-btn"
                                                                        href="<?php the_permalink(); ?>"><?php echo esc_html('View Case Study +', 'comm-express'); ?></a>
                                                                </header>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php $s++; endwhile;
                                                echo '</div>';
                                                echo '</div>';
                                                wp_reset_postdata();
                                        endif;
                                    } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <?php
                wp_reset_postdata();
        endif;
        ?>
        <?php }

endif;

if (!function_exists('comm_express_post_format_icon')):

    // Post Format Icon.
    function comm_express_post_format_icon()
    {

        $format = get_post_format(get_the_ID()) ?: 'standard';
        $icon = '';
        $title = '';
        if ($format == 'video') {
            $icon = comm_express_get_theme_svg('video');
            $title = esc_html__('Video', 'comm-express');
        } elseif ($format == 'audio') {
            $icon = comm_express_get_theme_svg('audio');
            $title = esc_html__('Audio', 'comm-express');
        } elseif ($format == 'gallery') {
            $icon = comm_express_get_theme_svg('gallery');
            $title = esc_html__('Gallery', 'comm-express');
        } elseif ($format == 'quote') {
            $icon = comm_express_get_theme_svg('quote');
            $title = esc_html__('Quote', 'comm-express');
        } elseif ($format == 'image') {
            $icon = comm_express_get_theme_svg('image');
            $title = esc_html__('Image', 'comm-express');
        }

        if (!empty($icon)) { ?>
                <div class="theme-post-format">
                    <span class="post-format-icom"><?php echo comm_express_svg_escape($icon); ?></span>
                    <?php if ($title) {
                        echo '<span class="post-format-label">' . esc_html($title) . '</span>';
                    } ?>
                </div>
            <?php }
    }

endif;

if (!function_exists('comm_express_svg_escape')):

    /**
     * Get information about the SVG icon.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function comm_express_svg_escape($input)
    {

        // Make sure that only our allowed tags and attributes are included.
        $svg = wp_kses(
            $input,
            array(
                'svg' => array(
                    'class' => true,
                    'xmlns' => true,
                    'width' => true,
                    'height' => true,
                    'viewbox' => true,
                    'aria-hidden' => true,
                    'role' => true,
                    'focusable' => true,
                ),
                'path' => array(
                    'fill' => true,
                    'fill-rule' => true,
                    'd' => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill' => true,
                    'fill-rule' => true,
                    'points' => true,
                    'transform' => true,
                    'focusable' => true,
                ),
            )
        );

        if (!$svg) {
            return false;
        }

        return $svg;

    }

endif;

if (!function_exists('comm_express_kses')):

    /**
     * Escape rich-text field output (SCF textarea/wysiwyg values).
     * Allows the same HTML as post content plus <iframe> for video embeds.
     */
    function comm_express_kses($value)
    {
        $allowed = wp_kses_allowed_html('post');
        $allowed['iframe'] = array(
            'src' => true,
            'width' => true,
            'height' => true,
            'title' => true,
            'frameborder' => true,
            'allow' => true,
            'allowfullscreen' => true,
            'referrerpolicy' => true,
            'loading' => true,
            'class' => true,
            'style' => true,
        );
        return wp_kses((string) $value, $allowed);
    }

endif;

if (!function_exists('comm_express_sanitize_sidebar_option_meta')):

    // Sidebar Option Sanitize.
    function comm_express_sanitize_sidebar_option_meta($input)
    {

        $metabox_options = array('global-sidebar', 'left-sidebar', 'right-sidebar', 'no-sidebar');
        if (in_array($input, $metabox_options)) {

            return $input;

        } else {

            return '';

        }
    }

endif;

if (!function_exists('comm_express_sanitize_pagination_meta')):

    // Sidebar Option Sanitize.
    function comm_express_sanitize_pagination_meta($input)
    {

        $comm_express_metabox_options = array('Center', 'Right', 'Left');
        if (in_array($input, $comm_express_metabox_options)) {

            return $input;

        } else {

            return '';

        }
    }

endif;

if (!function_exists('comm_express_sanitize_menu_transform')):

    // Sidebar Option Sanitize.
    function comm_express_sanitize_menu_transform($input)
    {

        $comm_express_metabox_options = array('capitalize', 'uppercase', 'lowercase');
        if (in_array($input, $comm_express_metabox_options)) {

            return $input;

        } else {

            return '';

        }
    }

endif;

if (!function_exists('comm_express_sanitize_page_content_alignment')):

    // Sidebar Option Sanitize.
    function comm_express_sanitize_page_content_alignment($input)
    {

        $comm_express_metabox_options = array('left', 'center', 'right');
        if (in_array($input, $comm_express_metabox_options)) {

            return $input;

        } else {

            return '';

        }
    }

endif;