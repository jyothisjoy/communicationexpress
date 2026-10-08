<?php
/**
 * Accessory <-> product compatibility, built from each product's
 * "Compatible Accessories" list (_compatible_accessories meta).
 *
 * - "Compatible with" filter on the Accessories category and its subcategories.
 * - "Compatible Products" section on single accessory pages.
 *
 * @package CommExpress
 */

if (!defined('ABSPATH')) exit;

/**
 * Product ID => accessory IDs, for published products with a non-empty list (ordered by title).
 */
function comm_express_compatibility_map()
{
    static $map = null;
    if (null !== $map) {
        return $map;
    }

    $map = array();
    $ids = get_posts(array(
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'fields'         => 'ids',
        'meta_key'       => '_compatible_accessories',
        'orderby'        => 'title',
        'order'          => 'ASC',
    ));
    update_meta_cache('post', $ids);

    foreach ($ids as $id) {
        $list = get_post_meta($id, '_compatible_accessories', true);
        if (is_array($list) && !empty($list)) {
            $map[$id] = array_map('intval', $list);
        }
    }

    return $map;
}

/**
 * Whether a product_cat term is "Accessories" or one of its subcategories.
 */
function comm_express_is_accessory_term($term)
{
    $root = get_term_by('slug', 'accessories', 'product_cat');
    if (!$root || !$term instanceof WP_Term) {
        return false;
    }
    return $term->term_id === $root->term_id || term_is_ancestor_of($root, $term, 'product_cat');
}

// Filter the accessory category loop by ?compatible_with=<product ID>.
add_action('pre_get_posts', 'comm_express_filter_accessories_by_compatibility');
function comm_express_filter_accessories_by_compatibility($query)
{
    if (is_admin() || !$query->is_main_query() || !$query->is_tax('product_cat') || empty($_GET['compatible_with'])) {
        return;
    }

    $term = get_term_by('slug', $query->get('product_cat'), 'product_cat');
    if (!comm_express_is_accessory_term($term)) {
        return;
    }

    $map = comm_express_compatibility_map();
    $product_id = absint($_GET['compatible_with']);
    $query->set('post__in', !empty($map[$product_id]) ? $map[$product_id] : array(0));
}

// "Compatible with" dropdown above the accessory category grid.
add_action('woocommerce_before_shop_loop', 'comm_express_compatibility_filter_form', 15);
function comm_express_compatibility_filter_form()
{
    $term = get_queried_object();
    if (!is_product_category() || !comm_express_is_accessory_term($term)) {
        return;
    }

    // Only offer products that have at least one accessory in this category.
    $in_category = get_posts(array(
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'fields'         => 'ids',
        'tax_query'      => array(array(
            'taxonomy' => 'product_cat',
            'terms'    => $term->term_id,
        )),
    ));

    $options = array();
    foreach (comm_express_compatibility_map() as $product_id => $accessories) {
        if (array_intersect($accessories, $in_category)) {
            $options[$product_id] = get_the_title($product_id);
        }
    }
    if (empty($options)) {
        return;
    }

    $selected = isset($_GET['compatible_with']) ? absint($_GET['compatible_with']) : 0;
    ?>
    <form class="woocommerce-ordering comm-express-compat-filter" method="get" action="<?php echo esc_url(get_term_link($term)); ?>">
        <label for="comm-express-compatible-with"><?php esc_html_e('Compatible with', 'comm-express'); ?></label>
        <select name="compatible_with" id="comm-express-compatible-with" onchange="this.form.submit()">
            <option value=""><?php esc_html_e('All products', 'comm-express'); ?></option>
            <?php foreach ($options as $product_id => $title) : ?>
                <option value="<?php echo esc_attr($product_id); ?>" <?php selected($selected, $product_id); ?>><?php echo esc_html($title); ?></option>
            <?php endforeach; ?>
        </select>
        <?php if (!empty($_GET['orderby'])) : ?>
            <input type="hidden" name="orderby" value="<?php echo esc_attr(wc_clean(wp_unslash($_GET['orderby']))); ?>">
        <?php endif; ?>
        <noscript><button type="submit" class="button"><?php esc_html_e('Filter', 'comm-express'); ?></button></noscript>
    </form>
    <?php
}

// "Compatible Products" section on single product pages (after Compatible Accessories at 15).
add_action('woocommerce_after_single_product_summary', 'comm_express_compatible_products_section', 16);
function comm_express_compatible_products_section()
{
    $accessory_id = get_the_ID();
    $products = array();
    foreach (comm_express_compatibility_map() as $product_id => $accessories) {
        if ($product_id !== $accessory_id && in_array($accessory_id, $accessories, true)) {
            $products[] = $product_id;
        }
    }

    if (empty($products)) {
        return;
    }

    set_query_var('comm_express_accessories', $products);
    set_query_var('comm_express_accessories_heading', __('Compatible Products', 'comm-express'));
    wc_get_template_part('single-product/compatible-accessories');
}
