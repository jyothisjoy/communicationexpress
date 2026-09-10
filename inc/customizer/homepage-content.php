<?php
/**
* Header Banner Options.
*
* @package CommExpress
*/

$comm_express_default = comm_express_get_default_theme_options();
$comm_express_post_category_list = comm_express_post_category_list();

$wp_customize->add_section( 'header_banner_setting',
    array(
    'title'      => esc_html__( 'Slider Settings', 'comm-express' ),
    'priority'   => 10,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_home_pannel',
    )
);

$wp_customize->add_setting('comm_express_display_header_text',
    array(
        'default' => $comm_express_default['comm_express_header_slider'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'comm_express_sanitize_checkbox',
    )
);
$wp_customize->add_control('comm_express_display_header_text',
    array(
        'label' => esc_html__('Enable / Disable Tagline', 'comm-express'),
        'section' => 'title_tagline',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('comm_express_header_slider',
    array(
        'default' => $comm_express_default['comm_express_header_slider'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'comm_express_sanitize_checkbox',
    )
);
$wp_customize->add_control('comm_express_header_slider',
    array(
        'label' => esc_html__('Enable Slider', 'comm-express'),
        'section' => 'header_banner_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('comm_express_banner_background_image',
    array(
        'default' => $comm_express_default['comm_express_banner_background_image'],
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control(
    new WP_Customize_Image_Control( $wp_customize,'comm_express_banner_background_image',
        array(
            'label' => __('Slider Background Image','comm-express'),
            'section' => 'header_banner_setting',
            'settings' => 'comm_express_banner_background_image',
        )
    )
);

$wp_customize->add_setting( 'comm_express_header_banner_cat',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'comm_express_sanitize_select',
    )
);
$wp_customize->add_control( 'comm_express_header_banner_cat',
    array(
    'label'       => esc_html__( 'Slider Post Left Category', 'comm-express' ),
    'section'     => 'header_banner_setting',
    'type'        => 'select',
    'choices'     => $comm_express_post_category_list,
    )
);

$wp_customize->add_setting( 'comm_express_header_phone_number',
    array(
    'default'           => $comm_express_default['comm_express_header_phone_number'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'comm_express_header_phone_number',
    array(
    'label'    => esc_html__( 'Phone Number', 'comm-express' ),
    'section'  => 'header_banner_setting',
    'type'     => 'text',
    )
);

$wp_customize->add_setting( 'comm_express_header_email_id',
    array(
    'default'           => $comm_express_default['comm_express_header_email_id'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'comm_express_header_email_id',
    array(
    'label'    => esc_html__( 'Email Id', 'comm-express' ),
    'section'  => 'header_banner_setting',
    'type'     => 'text',
    )
);

$wp_customize->add_setting( 'comm_express_header_location',
    array(
    'default'           => $comm_express_default['comm_express_header_location'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'comm_express_header_location',
    array(
    'label'    => esc_html__( 'Address', 'comm-express' ),
    'section'  => 'header_banner_setting',
    'type'     => 'text',
    )
);


// Case Studies Setting

$wp_customize->add_section( 'product_column_setting',
    array(
    'title'      => esc_html__( 'Case Studies Setting', 'comm-express' ),
    'priority'   => 10,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_home_pannel',
    )
);

$wp_customize->add_setting('comm_express_header_case_studies',
    array(
        'default' => $comm_express_default['comm_express_header_case_studies'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'comm_express_sanitize_checkbox',
    )
);
$wp_customize->add_control('comm_express_header_case_studies',
    array(
        'label' => esc_html__('Enable Case Studies', 'comm-express'),
        'section' => 'product_column_setting',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting( 'comm_express_team_section_subtitle',
    array(
    'default'           => $comm_express_default['comm_express_team_section_subtitle'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'comm_express_team_section_subtitle',
    array(
    'label'    => esc_html__( 'Sub Title ', 'comm-express' ),
    'section'  => 'product_column_setting',
    'type'     => 'text',
    )
);

$wp_customize->add_setting( 'comm_express_team_section_title',
    array(
    'default'           => $comm_express_default['comm_express_team_section_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'comm_express_team_section_title',
    array(
    'label'    => esc_html__( 'Title ', 'comm-express' ),
    'section'  => 'product_column_setting',
    'type'     => 'text',
    )
);

for($i=1; $i<= 4; $i++) {

    $wp_customize->add_setting('comm_express_price_list_tab_title'.$i,array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('comm_express_price_list_tab_title'.$i,array(
      'label' => __('Case Studies Tab Heading ','comm-express').$i,
      'section' => 'product_column_setting',
      'setting' => 'comm_express_price_list_tab_title'.$i,
      'type'  => 'text'
    ));
}

    $categories = get_categories();
    $cat_post = array();
    $cat_post[]= 'select';
    $m = 0;
    foreach($categories as $category){
        if($m==0){
            $default = $category->slug;
            $m++;
        }
        $cat_post[$category->slug] = $category->name;
    }

    $wp_customize->add_setting('comm_express_category_tab1',array(
        'default'   => 'select',
        'sanitize_callback' => 'comm_express_sanitize_select',
    ));
    $wp_customize->add_control('comm_express_category_tab1' ,array(
        'type'    => 'select',
        'choices' => $cat_post,
        'label' => __('Select Category to display Case Studies 1','comm-express'),
        'section' => 'product_column_setting',
    ));

    $categories = get_categories();
    $cat_post = array();
    $cat_post[]= 'select';
    $m = 0;
    foreach($categories as $category){
        if($m==0){
            $default = $category->slug;
            $m++;
        }
        $cat_post[$category->slug] = $category->name;
    }

    $wp_customize->add_setting('comm_express_category_tab2',array(
        'default'   => 'select',
        'sanitize_callback' => 'comm_express_sanitize_select',
    ));
    $wp_customize->add_control('comm_express_category_tab2',array(
        'type'    => 'select',
        'choices' => $cat_post,
        'label' => __('Select Category to display Case Studies 2','comm-express'),
        'section' => 'product_column_setting',
    ));

     $categories = get_categories();
    $cat_post = array();
    $cat_post[]= 'select';
    $m = 0;
    foreach($categories as $category){
        if($m==0){
            $default = $category->slug;
            $m++;
        }
        $cat_post[$category->slug] = $category->name;
    }

    $wp_customize->add_setting('comm_express_category_tab3',array(
        'default'   => 'select',
        'sanitize_callback' => 'comm_express_sanitize_select',
    ));
    $wp_customize->add_control('comm_express_category_tab3',array(
        'type'    => 'select',
        'choices' => $cat_post,
        'label' => __('Select Category to display Case Studies 3','comm-express'),
        'section' => 'product_column_setting',
    ));

     $categories = get_categories();
    $cat_post = array();
    $cat_post[]= 'select';
    $m = 0;
    foreach($categories as $category){
        if($m==0){
            $default = $category->slug;
            $m++;
        }
        $cat_post[$category->slug] = $category->name;
    }

    $wp_customize->add_setting('comm_express_category_tab4',array(
        'default'   => 'select',
        'sanitize_callback' => 'comm_express_sanitize_select',
    ));
    $wp_customize->add_control('comm_express_category_tab4',array(
        'type'    => 'select',
        'choices' => $cat_post,
        'label' => __('Select Category to display Case Studies 4','comm-express'),
        'section' => 'product_column_setting',
    ));