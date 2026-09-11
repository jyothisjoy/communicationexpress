<?php
/**
 * Product Call To Action
 *
 * Displayed at the bottom of single product pages and product category pages.
 *
 * @package CommExpress
 */

if (!defined('ABSPATH')) exit;

$cta = get_query_var('comm_express_product_cta', array());

$heading = isset($cta['heading']) ? $cta['heading'] : '';
$text    = isset($cta['text']) ? $cta['text'] : '';

if ($heading === '') return;
?>

<section class="comm-express-product-cta">
    <div class="comm-express-product-cta__body">
        <h3 class="comm-express-product-cta__heading"><?php echo esc_html($heading); ?></h3>
        <?php if ($text !== '') : ?>
            <p class="comm-express-product-cta__text"><?php echo esc_html($text); ?></p>
        <?php endif; ?>
    </div>
    <div class="comm-express-product-cta__actions">
        <a class="comm-express-product-cta__btn" href="<?php echo esc_url(site_url('/request-a-quote/')); ?>">
            <?php esc_html_e('Request a Quote', 'comm-express'); ?>
        </a>
        <a class="comm-express-product-cta__btn comm-express-product-cta__btn--outline" href="<?php echo esc_url(site_url('/contact-us/')); ?>">
            <?php esc_html_e('Contact Us', 'comm-express'); ?>
        </a>
        <span class="comm-express-product-cta__phone">
            <?php esc_html_e('or call', 'comm-express'); ?>
            <a href="tel:+17033210470">(703) 321-0470</a>
        </span>
    </div>
</section>
