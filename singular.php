<?php
/**
 * The template for displaying single posts and pages.
 * @package CommExpress
 * @since 1.0.0
 */
get_header();

$comm_express_default = comm_express_get_default_theme_options();
$comm_express_global_sidebar_layout = esc_html(get_theme_mod('comm_express_global_sidebar_layout', $comm_express_default['comm_express_global_sidebar_layout']));
$comm_express_post_sidebar = esc_html(get_post_meta($post->ID, 'comm_express_post_sidebar_option', true));
$comm_express_sidebar_column_class = 'column-order-1';

if (!empty($comm_express_post_sidebar)) {
    $comm_express_global_sidebar_layout = $comm_express_post_sidebar;
}

if ($comm_express_global_sidebar_layout == 'left-sidebar') {
    $comm_express_sidebar_column_class = 'column-order-2';
} ?>

<div id="single-page" class="singular-main-block">
    <div class="wrapper">
        <div class="column-row">
            <div id="primary" class="content-area <?php echo esc_attr($comm_express_sidebar_column_class); ?>">
                <main id="site-content" class="" role="main">
                    <?php
                    comm_express_breadcrumb();
                    if (have_posts()): ?>
                        <div class="article-wraper">

                            <?php while (have_posts()):
                                the_post();

                                get_template_part('template-parts/content', 'single');

                                if ((is_single() || is_page()) && (comments_open() || get_comments_number()) && !post_password_required()) { ?>

                                    <div class="comments-wrapper">
                                        <?php comments_template(); ?>
                                    </div>

                                    <?php
                                }

                            endwhile; ?>
                        </div>
                        <?php
                    else:
                        get_template_part('template-parts/content', 'none');

                    endif;
                    /**
                     * Navigation
                     * 
                     * @hooked comm_express_related_posts - 20  
                     * @hooked comm_express_single_post_navigation - 30  
                     */

                    do_action('comm_express_navigation_action'); ?>
                </main>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>
<?php
get_footer();
