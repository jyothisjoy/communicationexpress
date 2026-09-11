<?php
/**
 * CommExpress functions and definitions
 * @package CommExpress
 */

if (!function_exists('comm_express_after_theme_support')):

    function comm_express_after_theme_support()
    {

        add_theme_support('automatic-feed-links');

        add_theme_support('woocommerce');
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');
        add_theme_support('woocommerce', array(
            'gallery_thumbnail_image_width' => 300,
        ));

        add_theme_support(
            'custom-background',
            array(
                'default-color' => 'F1F3F4',
            )
        );

        $GLOBALS['content_width'] = apply_filters('comm_express_content_width', 1140);

        add_theme_support('post-thumbnails');

        add_theme_support(
            'custom-logo',
            array(
                'height' => 440,
                'width' => 60,
                'flex-height' => true,
                'flex-width' => true,
            )
        );

        add_theme_support('title-tag');

        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'script',
                'style',
            )
        );

        add_theme_support('post-formats', array(
            'video',
            'audio',
            'gallery',
            'quote',
            'image'
        ));

        add_theme_support('align-wide');
        add_theme_support('responsive-embeds');
        add_theme_support('wp-block-styles');

    }

endif;

add_action('after_setup_theme', 'comm_express_after_theme_support');

/**
 * Register and Enqueue Styles.
 */
function comm_express_register_styles()
{

    wp_enqueue_style('dashicons');

    $theme_version = wp_get_theme()->get('Version');
    $fonts_url = comm_express_fonts_url();
    if ($fonts_url) {
        require_once get_theme_file_path('lib/custom/css/wptt-webfont-loader.php');
        wp_enqueue_style(
            'comm-express-google-fonts',
            wptt_get_webfont_url($fonts_url),
            array(),
            $theme_version
        );
    }

    wp_enqueue_style('swiper', get_template_directory_uri() . '/lib/swiper/css/swiper-bundle.min.css');
    wp_enqueue_style('owl.carousel', get_template_directory_uri() . '/lib/custom/css/owl.carousel.min.css');
    wp_enqueue_style('comm-express-style', get_stylesheet_uri(), array(), $theme_version);

    wp_enqueue_style('comm-express-style', get_stylesheet_uri());
    require get_parent_theme_file_path('/custom_css.php');
    wp_add_inline_style('comm-express-style', $comm_express_custom_css);

    $comm_express_css = '';

    if (get_header_image()):

        $comm_express_css .= '
			.wrapper.header-wrapper.header-box{
				background-image: url(' . esc_url(get_header_image()) . ');
				-webkit-background-size: cover !important;
				-moz-background-size: cover !important;
				-o-background-size: cover !important;
				background-size: cover !important;
			}';

    endif;

    wp_add_inline_style('comm-express-style', $comm_express_css);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_enqueue_script('imagesloaded');
    wp_enqueue_script('masonry');
    wp_enqueue_script('comm-express-custom', get_template_directory_uri() . '/lib/custom/js/theme-custom-script.js', array('jquery'), '', 1);
    wp_enqueue_script('swiper', get_template_directory_uri() . '/lib/swiper/js/swiper-bundle.min.js', array('jquery'), '', 1);
    wp_enqueue_script('owl.carousel', get_template_directory_uri() . '/lib/custom/js/owl.carousel.js', array('jquery'), '', 1);

    // Global Query
    if (is_front_page()) {

        $posts_per_page = absint(get_option('posts_per_page'));
        $c_paged = (get_query_var('page')) ? absint(get_query_var('page')) : 1;
        $posts_args = array(
            'posts_per_page' => $posts_per_page,
            'paged' => $c_paged,
        );
        $posts_qry = new WP_Query($posts_args);
        $max = $posts_qry->max_num_pages;

    } else {
        global $wp_query;
        $max = $wp_query->max_num_pages;
        $c_paged = (get_query_var('paged') > 1) ? get_query_var('paged') : 1;
    }

    $comm_express_default = comm_express_get_default_theme_options();
    $comm_express_pagination_layout = get_theme_mod('comm_express_pagination_layout', $comm_express_default['comm_express_pagination_layout']);
}

add_action('wp_enqueue_scripts', 'comm_express_register_styles', 200);

function comm_express_admin_enqueue_scripts_callback($hook)
{
    if (!did_action('wp_enqueue_media')) {
        wp_enqueue_media();
    }
    wp_enqueue_script('comm-express-uploaderjs', get_stylesheet_directory_uri() . '/lib/custom/js/uploader.js', array(), "1.0", true);

    // Compatible Accessories admin script — only on product add/edit screens
    if (in_array($hook, array('post.php', 'post-new.php'))) {
        $screen = get_current_screen();
        if ($screen && $screen->post_type === 'product') {
            wp_enqueue_script(
                'comm-express-accessories-admin',
                get_template_directory_uri() . '/assets/js/compatible-accessories-admin.js',
                array('jquery'),
                '1.0.0',
                true
            );
            wp_localize_script('comm-express-accessories-admin', 'commExpressAccessories', array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                'nonce'   => wp_create_nonce('comm_express_search_accessories'),
            ));
        }
    }
}
add_action('admin_enqueue_scripts', 'comm_express_admin_enqueue_scripts_callback');

/**
 * Register navigation menus uses wp_nav_menu in five places.
 */
function comm_express_menus()
{

    $comm_express_locations = array(
        'comm-express-primary-menu' => esc_html__('Primary Menu', 'comm-express'),
    );

    register_nav_menus($comm_express_locations);
}

add_action('init', 'comm_express_menus');

add_filter('loop_shop_columns', 'comm_express_loop_columns');
if (!function_exists('comm_express_loop_columns')) {
    function comm_express_loop_columns()
    {
        $comm_express_columns = get_theme_mod('comm_express_per_columns', 3);
        return $comm_express_columns;
    }
}

add_filter('loop_shop_per_page', 'comm_express_per_page', 20);
function comm_express_per_page($comm_express_cols)
{
    $comm_express_cols = get_theme_mod('comm_express_product_per_page', 9);
    return $comm_express_cols;
}

require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/classes/class-svg-icons.php';
require get_template_directory() . '/classes/class-walker-menu.php';
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/custom-functions.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/classes/body-classes.php';
require get_template_directory() . '/inc/widgets/widgets.php';
require get_template_directory() . '/inc/metabox.php';
require get_template_directory() . '/inc/pagination.php';
require get_template_directory() . '/lib/breadcrumbs/breadcrumbs.php';
require get_template_directory() . '/lib/custom/css/dynamic-style.php';

/**
 * Theme updates from GitHub via plugin-update-checker.
 * Publish an update by bumping "Version" in style.css and creating a release/tag on the repo.
 */
require get_template_directory() . '/lib/plugin-update-checker-master/plugin-update-checker.php';

$comm_express_update_checker = \YahnisElsts\PluginUpdateChecker\v5\PucFactory::buildUpdateChecker(
    'https://github.com/jyothisjoy/communicationexpress/',
    __FILE__,
    'communicationexpress'
);
$comm_express_update_checker->setBranch('main');
if (defined('COMMEXPRESS_GITHUB_TOKEN') && COMMEXPRESS_GITHUB_TOKEN) {
    $comm_express_update_checker->setAuthentication(COMMEXPRESS_GITHUB_TOKEN);
}

function comm_express_remove_customize_register()
{
    global $wp_customize;

    $wp_customize->remove_setting('display_header_text');
    $wp_customize->remove_control('display_header_text');

}

add_action('customize_register', 'comm_express_remove_customize_register', 11);

// Apply styles based on customizer settings

function comm_express_customizer_css()
{
    ?>
    <style type="text/css">
        <?php
        $comm_express_footer_widget_background_color = get_theme_mod('comm_express_footer_widget_background_color');
        if ($comm_express_footer_widget_background_color) {
            echo '.footer-widgetarea { background-color: ' . esc_attr($comm_express_footer_widget_background_color) . '; }';
        }

        $comm_express_footer_widget_background_image = get_theme_mod('comm_express_footer_widget_background_image');
        if ($comm_express_footer_widget_background_image) {
            echo '.footer-widgetarea { background-image: url(' . esc_url($comm_express_footer_widget_background_image) . '); }';
        }
        $comm_express_copyright_font_size = get_theme_mod('comm_express_copyright_font_size');
        if ($comm_express_copyright_font_size) {
            echo '.footer-copyright { font-size: ' . esc_attr($comm_express_copyright_font_size) . 'px;}';
        }
        ?>
    </style>
    <?php
}
add_action('wp_head', 'comm_express_customizer_css');


function enqueue_custom_script()
{
    ?>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchToggle = document.querySelector(".search-toggle");
            const searchWrapper = document.querySelector(".search-form-wrapper");

            if (searchToggle && searchWrapper) {
                searchToggle.addEventListener("click", function (e) {
                    e.preventDefault();
                    searchWrapper.classList.toggle("active");
                });
            }
        });
    </script>
    <?php
}
add_action('wp_footer', 'enqueue_custom_script');


function add_font_awesome()
{
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'add_font_awesome');



function custom_post_types()
{
    // Register "Industries" post type
    register_post_type('industries', array(
        'labels' => array(
            'name' => __('Industries'),
            'singular_name' => __('Industry'),
            'add_new' => __('Add New Industry'),
            'add_new_item' => __('Add New Industry'),
            'edit_item' => __('Edit Industry'),
            'new_item' => __('New Industry'),
            'view_item' => __('View Industry'),
            'search_items' => __('Search Industries'),
            'not_found' => __('No industries found'),
            'not_found_in_trash' => __('No industries found in trash'),
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'industries'),
        'supports' => array('title', 'thumbnail', 'page-attributes'),
        'show_in_rest' => true, // Enable Gutenberg editor
    ));

    // Register "Our Services" post type
    register_post_type('services', array(
        'labels' => array(
            'name' => __('Our Services'),
            'singular_name' => __('Service'),
            'add_new' => __('Add New Service'),
            'add_new_item' => __('Add New Service'),
            'edit_item' => __('Edit Service'),
            'new_item' => __('New Service'),
            'view_item' => __('View Service'),
            'search_items' => __('Search Services'),
            'not_found' => __('No services found'),
            'not_found_in_trash' => __('No services found in trash'),
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'services'),
        'supports' => array('title', 'thumbnail', 'page-attributes'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'custom_post_types');

/*
// Register custom taxonomy for "Industries"
function custom_taxonomies()
{
    register_taxonomy('industry_category', 'industries', array(
        'labels' => array(
            'name' => __('Industry Categories'),
            'singular_name' => __('Industry Category'),
        ),
        'hierarchical' => true,
        'show_in_rest' => true,
    ));

    // Register custom taxonomy for "Our Services"
    register_taxonomy('service_category', 'our_services', array(
        'labels' => array(
            'name' => __('Service Categories'),
            'singular_name' => __('Service Category'),
        ),
        'hierarchical' => true,
        'show_in_rest' => true,
    ));
} 
add_action('init', 'custom_taxonomies'); */

// Register footer menu locations
function register_footer_menus()
{
    register_nav_menus(
        array(
            'footer-products' => __('Footer Products Menu'),
            'footer-services' => __('Footer Services Menu'),
            'footer-industries' => __('Footer Industries Menu'),
            'footer-resources' => __('Footer Resources Menu'),
            'blog-sidebar' => __('Resources Sidebar Menu'),
            'product-sidebar' => __('Products Sidebar Menu'),
			'mototrbo-applications' => __('Mototrbo Applications Menu'),
        )
    );
}
add_action('init', 'register_footer_menus');


function enqueue_slick_carousel_assets()
{
    // Slick CSS
    wp_enqueue_style('slick-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css');
    wp_enqueue_style('slick-theme-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css');

    // Slick JS
    wp_enqueue_script('slick-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array('jquery'), null, true);

    // Custom JS to initialize Slick Carousel
    wp_add_inline_script('slick-js', '
        jQuery(document).ready(function($) {
            $(".product-carousel").slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                arrows: true,
                dots: true,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });
        });
    ');
}
add_action('wp_enqueue_scripts', 'enqueue_slick_carousel_assets');

function theme_enqueue_scripts()
{
    if (is_page_template('frontpage.php')) {
        wp_enqueue_script('theme-functions', get_template_directory_uri() . '/assets/js/functions.js', array('jquery'), null, true);
    }
}

add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');


// Register Custom Post Type for Video Posts
function create_video_post_type()
{
    $labels = array(
        'name' => _x('Video Posts', 'Post Type General Name', 'textdomain'),
        'singular_name' => _x('Video Post', 'Post Type Singular Name', 'textdomain'),
        'menu_name' => __('Video Posts', 'textdomain'),
        'name_admin_bar' => __('Video Post', 'textdomain'),
        'add_new' => __('Add New Video', 'textdomain'),
        'add_new_item' => __('Add New Video Post', 'textdomain'),
        'new_item' => __('New Video Post', 'textdomain'),
        'edit_item' => __('Edit Video Post', 'textdomain'),
        'view_item' => __('View Video Post', 'textdomain'),
        'all_items' => __('All Video Posts', 'textdomain'),
        'search_items' => __('Search Video Posts', 'textdomain'),
        'not_found' => __('No video posts found', 'textdomain'),
        'not_found_in_trash' => __('No video posts found in Trash', 'textdomain'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'videos'), // URL slug for the video posts
        'supports' => array('title', 'thumbnail'), // Add 'comments' if you want comments enabled
        'menu_icon' => 'dashicons-video-alt3', // Dashicon for the video post type
        'show_in_rest' => true, // Enable Gutenberg block editor
        // 'taxonomies' => array('category', 'post_tag'), // Add categories and tags support
    );

    register_post_type('video', $args);
}
add_action('init', 'create_video_post_type');


// Register Custom Post Type for Testimonials
function create_testimonial_post_type()
{
    $labels = array(
        'name' => _x('Testimonials', 'Post Type General Name', 'textdomain'),
        'singular_name' => _x('Testimonial', 'Post Type Singular Name', 'textdomain'),
        'menu_name' => __('Testimonials', 'textdomain'),
        'name_admin_bar' => __('Testimonial', 'textdomain'),
        'add_new' => __('Add New', 'textdomain'),
        'add_new_item' => __('Add New Testimonial', 'textdomain'),
        'new_item' => __('New Testimonial', 'textdomain'),
        'edit_item' => __('Edit Testimonial', 'textdomain'),
        'view_item' => __('View Testimonial', 'textdomain'),
        'all_items' => __('All Testimonials', 'textdomain'),
        'search_items' => __('Search Testimonials', 'textdomain'),
        'not_found' => __('No testimonials found', 'textdomain'),
        'not_found_in_trash' => __('No testimonials found in Trash', 'textdomain'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'testimonials'),
        'supports' => array('title', 'thumbnail'),
        'menu_icon' => 'dashicons-format-quote', // Icon for the testimonials post type
        'show_in_rest' => true, // Enable Gutenberg editor
    );

    register_post_type('testimonial', $args);
}
add_action('init', 'create_testimonial_post_type');

// Register Custom Post Type for News
function create_news_post_type()
{
    $labels = array(
        'name' => _x('Industry News', 'Post Type General Name', 'textdomain'),
        'singular_name' => _x('Industry News', 'Post Type Singular Name', 'textdomain'),
        'menu_name' => __('News', 'textdomain'),
        'name_admin_bar' => __('Industry News', 'textdomain'),
        'add_new' => __('Add New Article', 'textdomain'),
        'add_new_item' => __('Add New Industry News', 'textdomain'),
        'new_item' => __('New Industry News', 'textdomain'),
        'edit_item' => __('Edit Industry News', 'textdomain'),
        'view_item' => __('View Industry News', 'textdomain'),
        'all_items' => __('All Industry News', 'textdomain'),
        'search_items' => __('Search Industry News', 'textdomain'),
        'not_found' => __('No Industry news found', 'textdomain'),
        'not_found_in_trash' => __('No Industry news found in Trash', 'textdomain'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'news'), // Custom URL slug
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
        'menu_icon' => 'dashicons-media-document', // Dashboard icon for News
        'show_in_rest' => true, // Enable Gutenberg editor
        'taxonomies' => array('category', 'post_tag'), // Add categories and tags support
    );

    register_post_type('news', $args);
}
add_action('init', 'create_news_post_type');


// Add star rating meta box for testimonials
function testimonial_add_star_rating_meta_box()
{
    add_meta_box(
        'testimonial_star_rating',
        'Star Rating',
        'testimonial_star_rating_meta_box_callback',
        'testimonial',
        'side'
    );
}
add_action('add_meta_boxes', 'testimonial_add_star_rating_meta_box');

// Display the meta box for star rating
function testimonial_star_rating_meta_box_callback($post)
{
    // Retrieve current rating value if set
    $star_rating = get_post_meta($post->ID, '_testimonial_star_rating', true);
    wp_nonce_field('testimonial_save_star_rating', 'testimonial_star_rating_nonce');
    ?>
    <label for="testimonial_star_rating">Rating (1 to 5):</label>
    <select name="testimonial_star_rating" id="testimonial_star_rating">
        <option value="1" <?php selected($star_rating, '1'); ?>>1 Star</option>
        <option value="2" <?php selected($star_rating, '2'); ?>>2 Stars</option>
        <option value="3" <?php selected($star_rating, '3'); ?>>3 Stars</option>
        <option value="4" <?php selected($star_rating, '4'); ?>>4 Stars</option>
        <option value="5" <?php selected($star_rating, '5'); ?>>5 Stars</option>
    </select>
    <?php
}

// Save the star rating when the post is saved
function save_testimonial_star_rating_meta($post_id)
{
    if (!isset($_POST['testimonial_star_rating_nonce']) || !wp_verify_nonce($_POST['testimonial_star_rating_nonce'], 'testimonial_save_star_rating')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (array_key_exists('testimonial_star_rating', $_POST)) {
        $star_rating = absint($_POST['testimonial_star_rating']);
        if ($star_rating < 1 || $star_rating > 5) {
            return;
        }
        update_post_meta($post_id, '_testimonial_star_rating', $star_rating);
    }
}
add_action('save_post_testimonial', 'save_testimonial_star_rating_meta');


function add_inline_tab_script()
{
    if (is_page_template('aboutus-template.php') || is_singular('industries')) {
        ?>
        <script>

            function openTab(evt, tabName) {
                // Hide all tab contents
                const tabContents = document.querySelectorAll('.tab-content');
                tabContents.forEach(content => content.classList.remove('active'));

                // Remove active class from all tab links
                const tabLinks = document.querySelectorAll('.tab-link');
                tabLinks.forEach(link => link.classList.remove('active'));

                // Show the current tab content and add active class to the clicked tab
                document.getElementById(tabName).classList.add('active');
                evt.currentTarget.classList.add('active');
            }



        </script>
        <?php
    }
}
add_action('wp_footer', 'add_inline_tab_script');

function add_custom_post_type_templates($post_templates, $wp_theme, $post, $post_type)
{
    if ($post_type === 'industries') {
        $post_templates['template-industry-template1.php'] = __('Industry Template 1');
        $post_templates['template-industry-template2.php'] = __('Industry Template 2');
    }
    return $post_templates;
}
add_filter('theme_page_templates', 'add_custom_post_type_templates', 10, 4);

add_filter('template_include', function ($template) {
    if (is_singular('industries') && $template_slug = get_page_template_slug()) {
        $template = locate_template($template_slug);
    }
    return $template;
});

add_filter('template_include', function ($default_template) {
    // echo is_singular('posts');
    // if (is_archive() && !is_post_type_archive('industries') && !is_post_type_archive('services') && !is_post_type_archive('product') && !is_post_type_archive('news') && !is_post_type_archive('news')) {
    if (is_archive() && is_post_type_archive('posts')) {
        $templatefilename = dirname(__FILE__) . '/blog-archive.php';
        $template = $templatefilename;
        $default_template = $template;

    } else if (is_single() && is_singular('post')) {
        $templatefilename = dirname(__FILE__) . '/blog-single.php';
        $template = $templatefilename;
        $default_template = $template;
    }

    // Load new template also fallback if both condition fails load default
    return $default_template;

}, 9999);


function hwl_pagesize($query)
{
    if (is_admin() || !$query->is_main_query())
        return;

    if (is_post_type_archive('industries')) {
        // Display 50 posts for a custom post type called 'movie'
        $query->set('posts_per_page', 12);
        return;
    }
}
add_action('pre_get_posts', 'hwl_pagesize', 1);


// ********* Related Posts *********

function cc_related_posts($args = array())
{

    global $post;

    // default args
    $args = wp_parse_args($args, array(
        'post_id' => !empty($post) ? $post->ID : '',
        'taxonomy' => 'category',
        'limit' => 3,
        'post_type' => !empty($post) ? $post->post_type : 'post',
        'orderby' => 'rand'
    ));

    // check taxonomy
    if (!taxonomy_exists($args['taxonomy'])) {
        return;
    }

    // post taxonomies
    $taxonomies = wp_get_post_terms($args['post_id'], $args['taxonomy'], array('fields' => 'ids'));

    if (empty($taxonomies)) {
        return;
    }

    // query
    $related_posts = get_posts(array(
        'post__not_in' => (array) $args['post_id'],
        'post_type' => $args['post_type'],
        'tax_query' => array(
            array(
                'taxonomy' => $args['taxonomy'],
                'field' => 'term_id',
                'terms' => $taxonomies
            ),
        ),
        'posts_per_page' => $args['limit'],
        'orderby' => $args['orderby'],
        'order' => $args['order'] ? $args['order'] : "DESC"
    ));

    if (!empty($related_posts)) { ?>
        <div class="related-posts">
            <h3 class="widget-title"><?php _e('Related Blogs', 'textdomain'); ?></h3>

            <ul class="related-posts-list bloggrid row">
                <?php
                foreach ($related_posts as $post) {
                    setup_postdata($post);
                    ?>
                    <li class="col-md-4 mb-4">
                        <a class="title" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                            <?php if (has_post_thumbnail()) { ?>
                                <div class="thumb">
                                    <?php echo get_the_post_thumbnail(null, 'medium', array('alt' => the_title_attribute(array('echo' => false)))); ?>
                                </div>
                            <?php } ?>
                            <h4><?php the_title(); ?></h4>
                        </a>
                    </li>
                <?php } ?>
            </ul>
            <div class="clearfix"></div>
        </div>
        <?php
    }

    wp_reset_postdata();
}

function wpsites_query($query)
{
    // if ( $query->is_paged() && $query->is_main_query() ) {
    $query->set('posts_per_page', 1);
    // }
}
// add_action( 'pre_get_posts', 'wpsites_query' );


// PAGINATION
function custom_pagination($numpages = '', $pagerange = '', $paged = '')
{
    if (empty($pagerange)) {
        $pagerange = 2;
    }
    /**
     * This first part of our function is a fallback
     * for custom pagination inside a regular loop that
     * uses the global $paged and global $wp_query variables.
     * 
     * It's good because we can now override default pagination
     * in our theme, and use this function in default queries
     * and custom queries.
     */
    global $paged;
    if (empty($paged)) {
        $paged = 1;
    }
    if ($numpages == '') {
        global $wp_query;
        $numpages = $wp_query->max_num_pages;
        if (!$numpages) {
            $numpages = 1;
        }
    }
    /** 
     * We construct the pagination arguments to enter into our paginate_links
     * function. 
     */
    $pagination_args = array(
        'base' => get_pagenum_link(1) . '%_%',
        'format' => 'page/%#%',
        'total' => $numpages,
        'current' => $paged,
        'show_all' => False,
        'end_size' => 1,
        'mid_size' => $pagerange,
        'prev_next' => True,
        'prev_text' => __('Prev'),
        'next_text' => __('Next'),
        'type' => 'plain',
        'add_args' => false,
        'add_fragment' => ''
    );
    $paginate_links = paginate_links($pagination_args);
    if ($paginate_links) {
        echo "<div class='navigation pagination'>";
        // echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
        echo $paginate_links;
        echo "</div>";
    }
}

/* 
add_filter('woocommerce_product_tabs', 'custom_add_content_to_reviews_tab');
function custom_add_content_to_reviews_tab($tabs) {
    $tabs['reviews']['callback'] = 'custom_reviews_tab_content';
    return $tabs;
}

function custom_reviews_tab_content() {
    echo '<h2>' . __('Custom Reviews Content', 'your-text-domain') . '</h2>';
    echo '<p>Here is some custom content for the reviews tab.</p>';
    comments_template(); // Keep the default comments section
} */

add_action('wp_enqueue_scripts', 'custom_review_modal_script');
function custom_review_modal_script()
{
    wp_enqueue_script('custom-review-modal', get_template_directory_uri() . '/assets/js/review-modal.js', array('jquery'), null, true);
}

/*

// Add template selection dropdown to product category
add_action('product_cat_add_form_fields', 'add_category_template_field');
add_action('product_cat_edit_form_fields', 'edit_category_template_field');

function add_category_template_field()
{
    ?>
    <div class="form-field">
        <label for="product_cat_template"><?php _e('Category Template', 'your-text-domain'); ?></label>
        <select name="product_cat_template" id="product_cat_template">
            <option value=""><?php _e('Default Template', 'your-text-domain'); ?></option>
            <option value="template-one.php"><?php _e('Template One', 'your-text-domain'); ?></option>
            <option value="template-two.php"><?php _e('Template Two', 'your-text-domain'); ?></option>
        </select>
        <p class="description"><?php _e('Select a template for this category.', 'your-text-domain'); ?></p>
    </div>
    <?php
}

function edit_category_template_field($term)
{
    $value = get_term_meta($term->term_id, 'product_cat_template', true);
    ?>
    <tr class="form-field">
        <th scope="row" valign="top">
            <label for="product_cat_template"><?php _e('Category Template', 'your-text-domain'); ?></label>
        </th>
        <td>
            <select name="product_cat_template" id="product_cat_template">
                <option value=""><?php _e('Default Template', 'your-text-domain'); ?></option>
                <option value="template-one.php" <?php selected($value, 'template-one.php'); ?>>
                    <?php _e('Template One', 'your-text-domain'); ?>
                </option>
                <option value="template-two.php" <?php selected($value, 'template-two.php'); ?>>
                    <?php _e('Template Two', 'your-text-domain'); ?>
                </option>
            </select>
            <p class="description"><?php _e('Select a template for this category.', 'your-text-domain'); ?></p>
        </td>
    </tr>
    <?php
}

// Save the custom field value
add_action('created_product_cat', 'save_category_template_field');
add_action('edited_product_cat', 'save_category_template_field');

function save_category_template_field($term_id)
{
    if (isset($_POST['product_cat_template'])) {
        update_term_meta($term_id, 'product_cat_template', sanitize_text_field($_POST['product_cat_template']));
    }
}



add_filter('template_include', 'load_custom_category_template');
function load_custom_category_template($template)
{
    if (is_product_category()) {
        $term = get_queried_object();
        $custom_template = get_term_meta($term->term_id, 'product_cat_template', true);

        if ($custom_template && file_exists(get_template_directory() . '/' . $custom_template)) {
            return get_template_directory() . '/' . $custom_template;
        }
    }

    return $template;
}
*/

function pwwp_enqueue_my_scripts()
{
    // jQuery is stated as a dependancy of bootstrap-js - it will be loaded by WordPress before the BS scripts 
    wp_enqueue_script('bootstrap-js', '//cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js', array('jquery'), true); // all the bootstrap javascript goodness
}
add_action('wp_enqueue_scripts', 'pwwp_enqueue_my_scripts');

function pwwp_enqueue_my_styles()
{
    wp_enqueue_style('bootstrap', '//cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css');

    // this will add the stylesheet from it's default theme location if your theme doesn't already
    //wp_enqueue_style( 'my-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'pwwp_enqueue_my_styles');

function custom_woocommerce_category_template($template)
{
    // print_r("hai this is working");
    if (is_tax('product_cat')) {
        $queried_object = get_queried_object();
        $category_id = $queried_object->term_id;

        // Check if the category has subcategories
        $subcategories = get_terms(array(
            'taxonomy' => 'product_cat',
            'parent' => $category_id,
            'hide_empty' => false,
        ));

        // Load the appropriate template
        if (!empty($subcategories)) {
            $new_template = locate_template('woocommerce/taxonomy-product_cat-with-subcategories.php');
        } else {
            $new_template = locate_template('woocommerce/taxonomy-product_cat-no-subcategories.php');
        }
        //  print_r($new_template);
//  if(file_exists($new_template)){ echo 'file exits';}else{ echo 'Not Exist';}
//  exit;
        // If the custom template exists, return it
        if ($new_template) {
            return $new_template;
        }
    }

    return $template;
}
//add_filter('template_include', 'custom_woocommerce_category_template');


function override_woocommerce_template($template, $template_name, $template_path)
{
    if (is_tax('product_cat')) {
        $queried_object = get_queried_object();
        $category_id = $queried_object->term_id;

        // Check if the category has subcategories
        $subcategories = get_terms(array(
            'taxonomy' => 'product_cat',
            'parent' => $category_id,
            'hide_empty' => false,
        ));

        // Load the correct template
        if (!empty($subcategories)) {
            $custom_template = get_template_directory() . '/woocommerce/taxonomy-product_cat-with-subcategories.php';
        } else {
            $custom_template = get_template_directory() . '/woocommerce/taxonomy-product_cat-no-subcategories.php';
        }

        if (file_exists($custom_template)) {
            return $custom_template;
        }
    }

    return $template;
}
//add_filter('woocommerce_locate_template', 'override_woocommerce_template', 10, 3);


function enqueue_ajax_product_cat_scripts()
{
    wp_enqueue_script('ajax-product-cat', get_template_directory_uri() . '/assets/js/ajax-product-cat.js', array('jquery'), null, true);

    wp_localize_script('ajax-product-cat', 'ajaxpagination', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_ajax_product_cat_scripts');


function load_more_products_in_subcategory()
{
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $category_id = isset($_POST['category_id']) ? intval($_POST['category_id']) : 0;

    $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        // 'posts_per_page' => get_option('posts_per_page'),
        'posts_per_page' => 1,
        'paged' => $paged,
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'id',
                'terms' => $category_id,
            ),
        ),
    );

    $query = new WP_Query($args);
    $products_html = '';
    $pagination_html = '';
    if ($query->have_posts()):

        $products_html = '<div class="row">';

        // Subcategory information
        $subcategory = get_term($category_id, 'product_cat');
        $total_items = $query->found_posts;
        $shown_items_start = (($paged - 1) * $args['posts_per_page']) + 1;
        $shown_items_end = min($total_items, $paged * $args['posts_per_page']);

        $products_html .= '<div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-4 subcattitle">';
        $products_html .= '<h4>' . esc_html($subcategory->name) .
            ' <span> ( Showing ' . esc_html($shown_items_start) .
            '-' . esc_html($shown_items_end) .
            ' of ' . esc_html($total_items) .
            ' products )</span></h4>';
        $products_html .= '</div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-4 float-right">
        <div class="productsearch">
<form role="search" method="get" class="search-form"
    action="' . esc_url(home_url('/')) . '">
    <input type="hidden" name="post_type" value="post" />
    <input type="search" id="search-form" class="search-input"
        placeholder="' . esc_attr_x('Search …', 'placeholder') . '"
        value="' . get_search_query() . '" name="s" />
</form>
</div>
</div>
</div>'; // Close row for the title

        $products_html .= '<div class="row">'; // Start new row for products 
        while ($query->have_posts()):
            $query->the_post();

            $products_html .= '<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 p-2">';
            $products_html .= '<div class="product-item text-center p-0">';
            $products_html .= '<a href="' . get_permalink() . '">';
            $products_html .= get_the_post_thumbnail(null, 'woocommerce_thumbnail', array('class' => 'p-3'));
            $products_html .= '<h3 class="py-4 pl-2">' . get_the_title() . '</h3>';
            $products_html .= '</a>';
            $products_html .= '</div>'; // Close product-item
            $products_html .= '</div>'; // Close Bootstrap column
        endwhile;
        $products_html .= '</div>'; // Close row for products
        // Generate pagination
        $pagination_html = paginate_links(array(
            'total' => $query->max_num_pages,
            'current' => $paged,
            'prev_text' => __('<span aria-hidden="true">&lsaquo;</span>', 'woocommerce'),
            'next_text' => __('<span aria-hidden="true">&rsaquo;</span>', 'woocommerce'),
            'type' => 'array',
        ));

        if ($pagination_html):
            $pagination_html = '<ul class="pagination justify-content-center">' . implode('', array_map(function ($link) {
                return '<li class="page-item">' . str_replace('page-numbers', 'page-link', $link) . '</li>';
            }, $pagination_html)) . '</ul>';
        endif;

    else:
        $products_html = '<p>No products found</p>';
    endif;

    wp_reset_postdata();
    // Return response as JSON
    wp_send_json(array(
        'content' => $products_html,
        'pagination' => $pagination_html,
    ));
}
add_action('wp_ajax_load_more_products', 'load_more_products_in_subcategory');
add_action('wp_ajax_nopriv_load_more_products', 'load_more_products_in_subcategory');

// Compatible Accessories: admin product search (admin-only, no nopriv)
add_action('wp_ajax_comm_express_search_accessories', 'comm_express_ajax_search_accessories');

function comm_express_ajax_search_accessories()
{
    check_ajax_referer('comm_express_search_accessories', 'nonce');

    if (!current_user_can('edit_products')) {
        wp_send_json_error(array('message' => 'Unauthorized'), 403);
    }

    $term = isset($_GET['term']) ? sanitize_text_field($_GET['term']) : '';

    if (strlen($term) < 2) {
        wp_send_json_success(array());
    }

    $exclude = isset($_GET['exclude']) ? intval($_GET['exclude']) : 0;

    $query = new WP_Query(array(
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => 15,
        's'              => $term,
        'post__not_in'   => $exclude ? array($exclude) : array(),
        'fields'         => 'ids',
    ));

    $results = array();
    foreach ($query->posts as $id) {
        $product = wc_get_product($id);
        if (!$product) continue;
        $results[] = array(
            'id'    => $id,
            'title' => $product->get_name(),
            'sku'   => $product->get_sku(),
            'thumb' => get_the_post_thumbnail_url($id, array(40, 40)) ?: '',
        );
    }

    wp_send_json_success($results);
}


add_action( 'woocommerce_single_product_summary', 'hook_before_product', 2 );
function hook_before_product() {
    $brandlogo = get_field("brand_logo");
    if (!empty($brandlogo['url'])) {
        echo '<img class="brand-logo" src="' . esc_url($brandlogo['url']) . '" />';
    }
}

add_action('woocommerce_after_setup_theme', function() {
    if (is_product()) {
        add_action('woocommerce_before_related_products', function() {
            remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
        });

        add_action('woocommerce_after_related_products', function() {
            add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
        });
    }
}, 99);

// Compatible Accessories: display on single product page (before related products at priority 20)
add_action('woocommerce_after_single_product_summary', 'comm_express_compatible_accessories_section', 15);

function comm_express_compatible_accessories_section()
{
    $ids = get_post_meta(get_the_ID(), '_compatible_accessories', true);

    if (empty($ids) || !is_array($ids)) {
        return;
    }

    // Only show published products
    $ids = array_values(array_filter($ids, function ($id) {
        return get_post_status($id) === 'publish';
    }));

    if (empty($ids)) {
        return;
    }

    set_query_var('comm_express_accessories', $ids);
    wc_get_template_part('single-product/compatible-accessories');
}

// Product CTA: bottom of single product pages (after related products at 20) and product category loops (after pagination at 10)
add_action('woocommerce_after_single_product_summary', 'comm_express_product_cta_section', 25);
add_action('woocommerce_after_shop_loop', 'comm_express_product_cta_section', 15);

function comm_express_product_cta_section()
{
    if (is_product()) {
        $cta = array(
            'heading' => sprintf(__('Interested in the %s?', 'comm-express'), get_the_title()),
            'text'    => __('Talk to a Communications Express specialist for pricing, availability and the right accessories for your team.', 'comm-express'),
        );
    } else {
        $term    = get_queried_object();
        $subject = ($term instanceof WP_Term) ? $term->name : __('radio solution', 'comm-express');
        $cta = array(
            'heading' => sprintf(__('Need help choosing the right %s?', 'comm-express'), $subject),
            'text'    => __('Our team can recommend the right equipment for your industry, coverage area and budget.', 'comm-express'),
        );
    }

    set_query_var('comm_express_product_cta', $cta);
    wc_get_template_part('global/product-cta');
}

// Remove "Accessory Catalog" tab added by YIKES Custom WooCommerce Product Tabs plugin
add_filter('woocommerce_product_tabs', function ($tabs) {
    unset($tabs['accessory-catalog']);
    return $tabs;
}, 99);

/* LOKAS Nov25*/
add_filter( 'wpcf7_submit_response', 'custom_cf7_redirect_after_submit', 10, 2 );

function custom_cf7_redirect_after_submit( $response, $result ) {
    // Check if the form was submitted successfully
    if ( 'mail_sent' == $result['status'] ) {
        // Replace with your actual thank you page URL
        $redirect_url = 'https://communicationsexpress.com/quote-thank-you/';

        // Output the JavaScript to redirect
        ?>
        <script type="text/javascript">
            window.location = "<?php echo $redirect_url; ?>";
        </script>
        <?php
        // It's good practice to exit after a redirect
        exit;
    }
}

/**
 * Product loop: small info icon whose hover tooltip shows the product short description.
 * Prints after the product link closes (priority 5) and before the add-to-cart button (10).
 * Tooltip is rendered by the Bootstrap tooltip plugin already enqueued site-wide.
 */
add_action('woocommerce_after_shop_loop_item', 'comm_express_loop_short_description_tip', 7);
function comm_express_loop_short_description_tip()
{
    if (!is_shop() && !is_product_taxonomy()) {
        return;
    }
    global $product;
    if (!$product instanceof WC_Product) {
        return;
    }
    $text = html_entity_decode(wp_strip_all_tags($product->get_short_description()), ENT_QUOTES, 'UTF-8');
    $text = trim(preg_replace('/\s+/u', ' ', $text));
    if ($text === '') {
        return;
    }
    echo '<span class="product-info-tip" tabindex="0" data-toggle="tooltip" data-placement="top" aria-label="' . esc_attr__('Product description', 'comm-express') . '" title="' . esc_attr($text) . '">'
        . '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" aria-hidden="true" focusable="false">'
        . '<circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="2"/>'
        . '<path d="M12 11v6M12 7.25v.25" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>'
        . '</svg></span>';
}
