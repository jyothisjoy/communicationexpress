<?php
/**
 * Header file for the CommExpress WordPress theme.
 * @package CommExpress
 * @since 1.0.0
 */
?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <!--<link href='//fonts.googleapis.com/css?family=Rajdhani' rel='stylesheet'>-->	
    <link href='//fonts.googleapis.com/css?family=Mulish' rel='stylesheet'>
    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

    <?php
    if (function_exists('wp_body_open')) {
        wp_body_open();
    }
    $comm_express_default = comm_express_get_default_theme_options(); ?>

    <div id="comm-express-page" class="comm-express-hfeed comm-express-site">
        <a class="skip-link screen-reader-text"
            href="#site-content"><?php esc_html_e('Skip to the content', 'comm-express'); ?></a>

        <?php
        get_template_part('template-parts/header/header', 'layout');
        ?>

        <div id="content" class="site-content">
            <?php
            $comm_express_banner_background_image = get_field('main_banner');
            $comm_express_mainbanner_text = get_field('mainbanner_text');
            $comm_express_button_link = get_field('button_link');
            $comm_express_button_text = get_field('button_text');
            // echo comm_express_kses($comm_express_banner_background_image['url']);
            ?>

            <div id="site-content" class="main-banner">
                <?php if ($comm_express_banner_background_image != ""): ?>
                    <div class="slider-box"
                        style="background: url(<?php echo esc_url($comm_express_banner_background_image['url']); ?>);">
                        <div class="main-slider">
                            <div class="swiper-container theme-main-carousel">
                                <div class="swiper-wrapper">
                                    <div class="main">
                                        <?php if ($comm_express_mainbanner_text != ""): ?>
                                            <h2 class="headertext"> <?php echo comm_express_kses($comm_express_mainbanner_text); ?> </h2>
                                        <?php endif; ?>
                                        <?php if (!empty($comm_express_button_link)): ?>
                                            <div class="header-btn">
                                                <a href="<?php echo esc_url($comm_express_button_link['url']); ?>">

                                                    <?php if ($comm_express_button_text != "") {
                                                        echo comm_express_kses($comm_express_button_text);
                                                    } ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>