<?php
/**
 * Compatible Accessories Section
 *
 * Displayed on single product pages below the product summary,
 * before the related products section.
 *
 * @package CommExpress
 */

if (!defined('ABSPATH')) exit;

$accessories = get_query_var('comm_express_accessories', array());

if (empty($accessories)) return;
?>

<section class="comm-express-compatible-accessories" style="margin: 40px 0;">

    <h2 style="border-bottom: 2px solid #e2e2e2; padding-bottom: 10px; margin-bottom: 20px;">
        <?php esc_html_e('Compatible Accessories', 'comm-express'); ?>
    </h2>

    <div class="row">

        <?php foreach ($accessories as $accessory_id) :
            $accessory = wc_get_product($accessory_id);
            if (!$accessory) continue;

            $permalink  = get_permalink($accessory_id);
            $title      = $accessory->get_name();
            $price_html = $accessory->get_price_html();
            $thumbnail  = get_the_post_thumbnail(
                $accessory_id,
                'woocommerce_thumbnail',
                array('class' => 'img-fluid p-2', 'style' => 'width:100%; height:180px; object-fit:contain;')
            );
            ?>

            <div class="col-6 col-sm-4 col-md-3 mb-4">
                <div class="comm-express-acc-card h-100 d-flex flex-column"
                     style="border: 1px solid #e2e2e2; border-radius: 4px; transition: box-shadow 0.2s ease; overflow: hidden;">

                    <a href="<?php echo esc_url($permalink); ?>" class="d-block text-center" style="background: #f9f9f9;">
                        <?php if ($thumbnail) : ?>
                            <?php echo $thumbnail; ?>
                        <?php else : ?>
                            <img src="<?php echo esc_url(wc_placeholder_img_src('woocommerce_thumbnail')); ?>"
                                 class="img-fluid p-2"
                                 style="width:100%; height:180px; object-fit:contain;"
                                 alt="<?php echo esc_attr($title); ?>">
                        <?php endif; ?>
                    </a>

                    <div class="p-3 d-flex flex-column flex-grow-1">

                        <h3 style="font-size: 0.9rem; line-height: 1.3; margin: 0 0 8px;">
                            <a href="<?php echo esc_url($permalink); ?>" style="color: inherit; text-decoration: none;">
                                <?php echo esc_html($title); ?>
                            </a>
                        </h3>

                        <?php if ($price_html) : ?>
                            <div class="price" style="font-weight: 600; margin-bottom: 12px;">
                                <?php echo $price_html; ?>
                            </div>
                        <?php endif; ?>

                        <a href="<?php echo esc_url($permalink); ?>"
                           class="button btn btn-sm btn-outline-secondary mt-auto"
                           style="text-align: center;">
                            <?php esc_html_e('View Product', 'comm-express'); ?>
                        </a>

                    </div>

                </div>
            </div>

        <?php endforeach; ?>

    </div><!-- .row -->

</section>
