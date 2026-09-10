<?php
/**
 * Sidebar Metabox.
 *
 * @package CommExpress
 */

$comm_express_post_sidebar_fields = array(
    'global-sidebar' => array(
        'id' => 'post-global-sidebar',
        'value' => 'global-sidebar',
        'label' => esc_html__('Global sidebar', 'comm-express'),
    ),
    'right-sidebar' => array(
        'id' => 'post-left-sidebar',
        'value' => 'right-sidebar',
        'label' => esc_html__('Right sidebar', 'comm-express'),
    ),
    'left-sidebar' => array(
        'id' => 'post-right-sidebar',
        'value' => 'left-sidebar',
        'label' => esc_html__('Left sidebar', 'comm-express'),
    ),
    'no-sidebar' => array(
        'id' => 'post-no-sidebar',
        'value' => 'no-sidebar',
        'label' => esc_html__('No sidebar', 'comm-express'),
    ),
);

function comm_express_category_add_form_fields_callback()
{
    $image_id = null; ?>
    <div id="category_custom_image"></div>
    <input type="hidden" id="category_custom_image_url" name="category_custom_image_url">
    <div style="margin-bottom: 20px;">
        <span><?php esc_html_e('Category Image', 'comm-express'); ?></span>
        <a href="#" class="button custom-button-upload"
            id="custom-button-upload"><?php esc_html_e('Upload Image', 'comm-express'); ?></a>
        <a href="#" class="button custom-button-remove" id="custom-button-remove"
            style="display: none"><?php esc_html_e('Remove Image', 'comm-express'); ?></a>
    </div>
<?php
}
add_action('category_add_form_fields', 'comm_express_category_add_form_fields_callback');

function comm_express_custom_create_term_callback($term_id, $tt_id, $taxonomy)
{
    if ('category' !== $taxonomy || empty($_REQUEST['category_custom_image_url']) || !current_user_can('manage_categories')) {
        return;
    }
    // add term meta data
    add_term_meta(
        $term_id,
        'term_image',
        esc_url_raw(wp_unslash($_REQUEST['category_custom_image_url']))
    );
}
add_action('create_term', 'comm_express_custom_create_term_callback', 10, 3);

function comm_express_category_edit_form_fields_callback($ttObj, $taxonomy)
{
    $term_id = $ttObj->term_id;
    $image = '';
    $image = get_term_meta($term_id, 'term_image', true); ?>
    <tr class="form-field term-image-wrap">
        <th scope="row"><label for="image"><?php esc_html_e('Image', 'comm-express'); ?></label></th>
        <td>
            <?php if ($image): ?>
                <span id="category_custom_image">
                    <img src="<?php echo esc_url($image); ?>" style="width: 100%" />
                </span>
                <input type="hidden" id="category_custom_image_url" name="category_custom_image_url">
                <span>
                    <a href="#" class="button custom-button-upload" id="custom-button-upload"
                        style="display: none"><?php esc_html_e('Upload Image', 'comm-express'); ?></a>
                    <a href="#" class="button custom-button-remove"><?php esc_html_e('Remove Image', 'comm-express'); ?></a>
                </span>
            <?php else: ?>
                <span id="category_custom_image"></span>
                <input type="hidden" id="category_custom_image_url" name="category_custom_image_url">
                <span>
                    <a href="#" class="button custom-button-upload"
                        id="custom-button-upload"><?php esc_html_e('Upload Image', 'comm-express'); ?></a>
                    <a href="#" class="button custom-button-remove"
                        style="display: none"><?php esc_html_e('Remove Image', 'comm-express'); ?></a>
                </span>
            <?php endif; ?>
        </td>
    </tr>
    <?php
}
add_action('category_edit_form_fields', 'comm_express_category_edit_form_fields_callback', 10, 2);

function comm_express_edit_term_callback($term_id, $tt_id, $taxonomy)
{
    if ('category' !== $taxonomy || !current_user_can('manage_categories')) {
        return;
    }
    // Check if 'category_custom_image_url' is set in the $_POST array
    if (isset($_POST['category_custom_image_url'])) {
        $image = get_term_meta($term_id, 'term_image');
        $image_url = esc_url_raw(wp_unslash($_POST['category_custom_image_url']));

        // Sanitize and update or add the meta data
        if ($image) {
            update_term_meta($term_id, 'term_image', $image_url);
        } else {
            add_term_meta($term_id, 'term_image', $image_url);
        }
    }
}
add_action('edit_term', 'comm_express_edit_term_callback', 10, 3);

// =============================================================================
// Compatible Accessories Meta Box
// =============================================================================

add_action('add_meta_boxes', 'comm_express_register_accessories_metabox');

function comm_express_register_accessories_metabox()
{
    add_meta_box(
        'comm_express_compatible_accessories',
        __('Compatible Accessories', 'comm-express'),
        'comm_express_accessories_metabox_callback',
        'product',
        'normal',
        'default'
    );
}

function comm_express_accessories_metabox_callback($post)
{
    wp_nonce_field('comm_express_save_accessories', 'comm_express_accessories_nonce');

    $saved_ids = get_post_meta($post->ID, '_compatible_accessories', true);
    $saved_ids = is_array($saved_ids) ? array_filter(array_map('intval', $saved_ids)) : array();
    ?>
    <div id="comm-express-accessories-wrap">

        <p>
            <label for="comm-express-acc-search"><?php esc_html_e('Search products to add:', 'comm-express'); ?></label><br>
            <input type="text"
                   id="comm-express-acc-search"
                   placeholder="<?php esc_attr_e('Type a product name or SKU...', 'comm-express'); ?>"
                   autocomplete="off"
                   style="width:100%; padding:6px; margin-top:4px;">
        </p>

        <ul id="comm-express-acc-results"
            style="list-style:none; margin:0; padding:0; border:1px solid #ccc; display:none; max-height:200px; overflow-y:auto; background:#fff; position:relative; z-index:9999;">
        </ul>

        <p style="margin-top:16px;"><strong><?php esc_html_e('Attached accessories:', 'comm-express'); ?></strong></p>

        <ul id="comm-express-acc-list" style="list-style:none; margin:0; padding:0;">
            <?php foreach ($saved_ids as $product_id) :
                $product = wc_get_product($product_id);
                if (!$product) continue;
                $thumb = get_the_post_thumbnail($product_id, array(40, 40), array('style' => 'width:40px;height:40px;object-fit:cover;'));
                ?>
                <li data-id="<?php echo esc_attr($product_id); ?>"
                    style="padding:6px 0; border-bottom:1px solid #eee; display:flex; align-items:center; gap:8px;">
                    <?php echo $thumb; ?>
                    <span><?php echo esc_html($product->get_name()); ?></span>
                    <?php if ($product->get_sku()) : ?>
                        <em style="color:#999; font-size:0.85em;">(<?php echo esc_html($product->get_sku()); ?>)</em>
                    <?php endif; ?>
                    <button type="button"
                            class="button comm-express-acc-remove"
                            style="margin-left:auto;"><?php esc_html_e('Remove', 'comm-express'); ?></button>
                    <input type="hidden" name="comm_express_accessories[]" value="<?php echo esc_attr($product_id); ?>">
                </li>
            <?php endforeach; ?>
        </ul>

        <?php if (empty($saved_ids)) : ?>
            <p id="comm-express-acc-empty" style="color:#999; font-style:italic;">
                <?php esc_html_e('No accessories attached yet.', 'comm-express'); ?>
            </p>
        <?php endif; ?>

    </div>
    <?php
}

add_action('save_post_product', 'comm_express_save_accessories_meta');

function comm_express_save_accessories_meta($post_id)
{
    if (!isset($_POST['comm_express_accessories_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['comm_express_accessories_nonce'], 'comm_express_save_accessories')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_product', $post_id)) {
        return;
    }

    $accessories = isset($_POST['comm_express_accessories'])
        ? array_values(array_filter(array_map('intval', (array) $_POST['comm_express_accessories'])))
        : array();

    update_post_meta($post_id, '_compatible_accessories', $accessories);
}