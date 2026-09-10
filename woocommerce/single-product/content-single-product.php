<div class="product-gallery-wrapper">
    <!-- Thumbnail Slider -->
    <div class="product-thumbnails swiper-container">
        <div class="swiper-wrapper">
            <?php
            global $product;
            $attachment_ids = $product->get_gallery_image_ids();
            if ($attachment_ids) {
                foreach ($attachment_ids as $attachment_id) {
                    $image_url = wp_get_attachment_image_url($attachment_id, 'thumbnail');
                    echo '<div class="swiper-slide"><img src="' . esc_url($image_url) . '" alt=""></div>';
                }
            }
            ?>
        </div>
    </div>

    <!-- Main Image Slider -->
    <div class="product-main-image swiper-container">
        <div class="swiper-wrapper">
            <?php
            $main_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
            echo '<div class="swiper-slide"><img src="' . esc_url($main_image[0]) . '" alt=""></div>';
            if ($attachment_ids) {
                foreach ($attachment_ids as $attachment_id) {
                    $image_url = wp_get_attachment_image_url($attachment_id, 'large');
                    echo '<div class="swiper-slide"><img src="' . esc_url($image_url) . '" alt=""></div>';
                }
            }
            ?>
        </div>
    </div>
</div>
