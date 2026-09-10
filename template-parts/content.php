<?php
/**
 * The default template for displaying content
 * @package CommExpress
 * @since 1.0.0
 */

$comm_express_default = comm_express_get_default_theme_options();
$comm_express_image_size = 'large';
global $comm_express_archive_first_class;
$comm_express_archive_classes = [
    'theme-article-post',
    'theme-article-animate',
    $comm_express_archive_first_class
]; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class($comm_express_archive_classes); ?>>
    <div class="theme-article-image">
        <div class="entry-thumbnail">
            <?php
            if (is_search() || is_archive() || is_front_page()) {
                $comm_express_featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                $comm_express_featured_image = isset($comm_express_featured_image[0]) ? $comm_express_featured_image[0] : '';
                $comm_express_background_style = $comm_express_featured_image ? 'background-image: url(' . esc_url($comm_express_featured_image) . ');' : 'background-color: #f0f0f0;';
                ?>
                <div class="post-thumbnail data-bg data-bg-big" style="<?php echo $comm_express_background_style; ?>">
                    <a href="<?php the_permalink(); ?>" class="theme-image-responsive" tabindex="0"></a>
                </div>
                <?php
            } else {
                comm_express_post_thumbnail($comm_express_image_size);
            }
            if (get_theme_mod('comm_express_display_archive_post_sticky_post', true) == true):
                comm_express_post_format_icon();
            endif;
            ?>
        </div>
    </div>
    <div class="theme-article-details">
        <div class="entry-meta-top">
            <div class="entry-meta">
                <?php comm_express_entry_footer($cats = true, $tags = false, $edits = false); ?>
            </div>
        </div>
        <header class="entry-header">
            <h2 class="entry-title entry-title-medium">
                <a href="<?php the_permalink(); ?>" rel="bookmark">
                    <span><?php the_title(); ?></span>
                </a>
            </h2>
        </header>
        <div class="entry-content">

            <?php
            if (has_excerpt()) {

                the_excerpt();

            } else {

                echo '<p>';
                echo esc_html(wp_trim_words(get_the_content(), get_theme_mod('comm_express_excerpt_limit', 10), '...'));
                echo '</p>';
            }

            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'comm-express'),
                'after' => '</div>',
            )); ?>

        </div>
        <a href="<?php the_permalink(); ?>" rel="bookmark" class="theme-btn-link">
            <span> <?php esc_html_e('Read More', 'comm-express'); ?> </span>
            <span class="topbar-info-icon"><?php comm_express_the_theme_svg('arrow-right-1'); ?></span>
        </a>
    </div>
</article>