<?php
/**
 * The sidebar containing the main widget area
 * @package CommExpress
 */

global $post; // Ensure the $post global variable is available

$comm_express_default = comm_express_get_default_theme_options();

// Ensure $post->ID is properly set before using it
$comm_express_post_sidebar = $post ? esc_html(get_post_meta($post->ID, 'comm_express_post_sidebar_option', true)) : '';
$comm_express_sidebar_column_class = 'column-order-2';

if (empty($comm_express_post_sidebar)) {
    $comm_express_global_sidebar_layout = esc_html(get_theme_mod('comm_express_global_sidebar_layout', $comm_express_default['comm_express_global_sidebar_layout']));
} else {
    $comm_express_global_sidebar_layout = $comm_express_post_sidebar;
}
if (!is_active_sidebar('sidebar-1') || $comm_express_global_sidebar_layout == 'no-sidebar') {
    return;
}

if ($comm_express_global_sidebar_layout == 'left-sidebar') {
    $comm_express_sidebar_column_class = 'column-order-1';
}
?>

<aside id="secondary" class="widget-area <?php echo esc_attr($comm_express_sidebar_column_class); ?>">
    <div class="widget-area-wrapper">
        <?php dynamic_sidebar('sidebar-1'); ?>
    </div>
</aside>