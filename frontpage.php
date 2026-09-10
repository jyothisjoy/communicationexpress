<?php

/* Template Name: Front Page Template */

get_header();
/*
echo comm_express_main_slider();
comm_express_product_section();
*/

?>
<?php
$home_about_title = get_field('home_about_title');
$home_about_content = get_field('home_about_content');

$home_productsandservices_title = get_field("home_productsandservices_title");

$home_best_selling_title = get_field("home_best_selling_title");
$home_best_selling_description = get_field("home_best_selling_description");
$home_bestselling_products = get_field("home_bestselling_products");

$home_das_title = get_field("home_das_title");



$comm_express_aboutus_wireless_header = get_field('wireless_header_text');
$comm_express_aboutus_wireless_tag = get_field('wireless_tag_points');
$comm_express_wireless_final = get_field('wireless_final_text');

$comm_express_aboutus_keybenefits_header = get_field('keybenefits_header_text');
$comm_express_aboutus_keybenefits_tag = get_field('keybenefits_key_points');
$comm_express_keybenefits_final = get_field('keybenefits_final_text');

$comm_express_aboutus_whychooseus_desc = get_field('why_choose_us_text');
$comm_express_aboutus_whychooseus_img = get_field('why_choose_us_image');


$comm_express_aboutus_our_services_image = get_field('our_services_image');
$comm_express_aboutus_our_services_header = get_field('our_services_header');
$comm_express_our_services_description = get_field('our_services_description');
$comm_express_aboutus_focus_counties = get_field('focus_counties');


// $comm_express_button_text = get_field('button_text');
// echo comm_express_kses($comm_express_banner_background_image['url']);
?>

<!-- About Section -->
<div class="container-wrapper">
    <section id="about" class="about-section section-spacing">
		<div class="container">
			<div class="about-content">
        <?php if ($home_about_title != "") { ?>
            <h2><?php echo comm_express_kses($home_about_title); ?></h2>
        <?php }
        if ($home_about_content != "") { ?>
            <p><?php echo comm_express_kses($home_about_content); ?></p>
        <?php } ?>
			</div>	
		</div>	
    </section>

    <!-- Products & Services Section -->
    <section id="products" class="products-services-section section-spacing">
		<div class="container">
        <?php if ($home_productsandservices_title != "") { ?>
            <h2><?php echo comm_express_kses($home_productsandservices_title); ?> <a href="https://comexpress.lokas.org/product-category/portable-radios" class="view-all-btn">View All</a></h2>
        <?php } ?>

        <div class="products-grid row">
            <!-- Portable Radios -->
            <?php for ($i = 1; $i <= 4; $i++) {
                $servicesimage = get_field("home_ourproductsandservicesimage" . $i);
                $servicestitle = get_field("home_ourproductsandservicestitle" . $i);
                $servicesdesc = get_field("home_ourproductsandservicesdesc" . $i);
                $servicesurl = get_field("home_ourproductsandservicesurl" . $i);
                if ($servicestitle != "") { ?>
                    <div class="col-md-3 py-3 px-2">
                        <div class="product-item text-center">
							<div class="product-item-img">
                            <?php if ($servicesimage != "") { ?>
                                <img src="<?php echo esc_url($servicesimage['url']); ?>" alt="<?php echo esc_attr($servicestitle); ?>">
                            <?php } ?>
							</div>		
							<div class="product-item-content">
                            <h3 class="text-left"><?php echo comm_express_kses($servicestitle); ?></h3>
                            <?php if ($servicesdesc != "") { ?>
                                <p  class="text-left"><?php echo comm_express_kses($servicesdesc); ?>.</p>
                            <?php } ?>
                            <?php if ($servicesurl != "") { ?>
                                <a href="<?php echo esc_url($servicesurl['url']); ?> " class="read-more-btn">Read More</a>
                            <?php } ?>
							</div>	
                        </div>
                    </div>
                <?php }
            } ?>


			</div>
        </div>
    </section>

    <!-- Best Selling Products Section -->
    <div class="best-selling-products-section section-spacing">
		<div class="container">
        <?php if ($home_best_selling_title != "") { ?>
            <h2><?php echo comm_express_kses($home_best_selling_title); ?></h2>
        <?php } ?>
        <?php if ($home_best_selling_description != "") { ?>
            <p class="bestseller-subhead"><?php echo comm_express_kses($home_best_selling_description); ?></p>
        <?php } ?>
        <?php // echo comm_express_kses($home_bestselling_products); ?>
        <div class="product-carousel">
            <!-- Product 1 -->
            <?php foreach ($home_bestselling_products as $bestselling) { //echo comm_express_kses($bestselling->ID);
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id($bestselling->ID), 'single-post-thumbnail');
                    // echo comm_express_kses($image);
                    ?>

                <div class="product-item">
                    <a href="<?php echo get_permalink($bestselling->ID); ?>">
                        <img src="<?php echo esc_url($image[0]); ?>" alt="Motorola XPR 3300e">
                        <h3><?php echo esc_html($bestselling->post_title); ?></h3>
                    </a>
                </div>
            <?php } ?>


            <!-- Add more product items as needed -->
        </div>
		</div>
    </div>


    <!-- Distributed Antenna Systems (DAS) Section -->
    <section class="das-section section-spacing">
		<div class="container">
        <?php if ($home_das_title != "") { ?>
            <h2><?php echo comm_express_kses($home_das_title); ?></h2>
        <?php } ?>
        <div class="das-grid row ">
            <!-- DAS Item 1 -->
            <?php for ($j = 1; $j <= 3; $j++) {
                $dasimage = get_field("home_das_banner_image_" . $j);
                $dasdesc = get_field("home_das_desc_" . $j);
                $dasurl = get_field("home_das_link_" . $j);

                ?>
                <div class=" col-md-4 my-3">
                    <div class="das-item">
                        <?php if ($dasimage != "") { ?>
                            <img src="<?php echo esc_url($dasimage['url']); ?>" alt="DAS Image 1">
                        <?php }
                        if ($dasdesc != "") { ?>
                            <p><?php echo comm_express_kses($dasdesc); ?></p>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
		</div>
    </section>

    <!-- Motorola Products Section -->
    <section class="motorola-products-section section-spacing">
		<div class="container">
        <h2>Motorola Products</h2>
        <div class="brands">
            <?php for ($k = 1; $k <= 4; $k++) {
                $motorolalogo = get_field("home_motorola_logo_" . $k);
                if ($motorolalogo != "") {
                    ?>
                    <img src="<?php echo esc_url($motorolalogo['url']); ?>" alt="Motorola">
                    <?php
                }
            } ?>

            <!-- Add more brand logos as needed -->
        </div>
		</div>
    </section>

    <!-- Videos Section -->
    <?php
    // Define the custom post type slug
    $custom_post_type = 'video'; // Replace with your post type slug
    
    // Set up the query arguments
    $args = array(
        'post_type' => $custom_post_type,
        'posts_per_page' => 3, // Limit to the latest 3 posts
        'orderby' => 'date',
        'order' => 'ASC',
    );

    // Create a new query
    $custom_query = new WP_Query($args);

    // Start the loop
    if ($custom_query->have_posts()):

        ?>
        <section class="videos-section section-spacing">
			<div class="container">
            <h2>Videos <a href="https://comexpress.lokas.org/videos/" class="view-all-btn">View All</a></h2>
            <div class="video-grid row">

                <?php while ($custom_query->have_posts()):
                    $custom_query->the_post();
                    $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                    ?>
                    <!-- Video 1 -->
                    <div class="col-md-4 my-3">
                        <div class="video-item">
                            <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title(); ?>">
                            <a href="<?php the_permalink(); ?>" class="play-button"><span>Play</span></a>
                        </div>
                    </div>
                <?php endwhile; ?>

                <!-- Add more video items as needed -->
            </div>
			</div>
        </section>
        <?php

    endif;
    wp_reset_query();
    ?>
    <!-- Testimonials Section -->
    <?php
    // Define the custom post type slug
    $testimonials_post_type = 'testimonial'; // Replace with your post type slug
    
    // Set up the query arguments
    $argsa = array(
        'post_type' => $testimonials_post_type,
        'posts_per_page' => 5, // Limit to the latest 4 posts
        'orderby' => 'date',
        'order' => 'DESC',
    );

    // Create a new query
    $testimonials_query = new WP_Query($argsa);

    // Start the loop
    if ($testimonials_query->have_posts()):

        ?>
        <div class="testimonial-section section-spacing">
			<div class="container">
            <h2>What Our Customers Say</h2>
            <div class="testimonial-slider">
                <?php $l = 0;
                while ($testimonials_query->have_posts()):
                    $testimonials_query->the_post();

                    $authorName = get_field('testimonial_author_name');
                    $authorImage = get_field('testimonial_author_image', get_the_ID());
                    $authorPosition = get_field('testimonial_author_position');
                    $authorCompany = get_field('testimonial_author_company');
                    $testimonialDesc = get_field('testimonial_description');
                    $star_rating = get_post_meta(get_the_ID(), '_testimonial_star_rating', true);
                    // echo comm_express_kses($authorImage);
                    ?>
                    <div class="testimonial-slide <?php if ($l == 0) {
                        echo 'active';
                    } ?>">
                        <div class="testimonial-content">

                            <div class="testimonial-author">
                                <?php if ($authorImage != "") { ?>
                                    <img src="<?php echo esc_url($authorImage['url']); ?>" alt="<?php echo esc_attr($authorName); ?>">
                                <?php }
                                if ($authorName != "") { ?>
                                    <h4><?php echo comm_express_kses($authorName); ?></h4>
                                <?php }
                                if ($authorPosition != "") { ?>
                                    <span><?php echo comm_express_kses($authorPosition); ?></span>
                                <?php } ?>
                            </div>
                            <?php if ($testimonialDesc != "") { ?>
                                <p>"<?php echo comm_express_kses($testimonialDesc); ?>"</p>
                            <?php } ?>
                            <?php
                            if ($star_rating) {
                                echo '<div class="star-rating">';
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $star_rating) {
                                        echo '<span class="star filled">★</span>'; // Filled star
                                    } else {
                                        echo '<span class="star">☆</span>'; // Empty star
                                    }
                                }
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                    <?php $l++;
                endwhile;

                ?>

                <!-- Add more testimonial slides as needed -->
            </div>

            <!-- Navigation buttons -->
            <button class="prev-btn">&#10094;</button>
            <button class="next-btn">&#10095;</button>
			</div>
        </div>
    <?php endif;
    wp_reset_query(); ?>

    <?php
    // Define the custom post type slug
    $news_post_type = 'news'; // Replace with your post type slug
    
    // Set up the query arguments
    $argsn = array(
        'post_type' => $news_post_type,
        'posts_per_page' => 3, // Limit to the latest 4 posts
        'orderby' => 'date',
        'order' => 'DESC',
    );

    // Create a new query
    $news_query = new WP_Query($argsn);

    // Start the loop
    if ($news_query->have_posts()):

        ?>
        <!-- News Section -->
        <section class="news-section section-spacing">
			<div class="container">
            <div class="latest-news-section">
                <h2>Latest News</h2>
                <div class="row news-grid1">
                    <?php
                    while ($news_query->have_posts()):
                        $news_query->the_post();
                        $newsdate;
                        $newstitle;
                        $newsdesc;
                        $newslink;
                        ?>
                        <div class="col-md-4 my-3">
							<div class="news-item">
								<span class="news-date"><?php the_time('F jS, Y'); ?></span>
								<h3><?php the_title(); ?></h3>
								<p><?php $content = strip_tags( get_the_content() );
								$content = substr($content, 0, 185);
								echo esc_html($content) . '...'; ?></p>
								<a href="<?php the_permalink(); ?>" class="read-more-btn">Read More</a>
							</div>
                        </div>
                    <?php endwhile; ?>
                    <!-- Add more news items as needed -->
                </div>
            </div>

			</div>
        </section>
    <?php endif;
    wp_reset_query(); ?>
</div>

<?php get_footer(); ?>