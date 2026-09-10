<?php
/**
* Custom Addons.
*
* @package CommExpress
*/

$wp_customize->add_section( 'theme_pagination_options',
    array(
    'title'      => esc_html__( 'Customizer Custom Settings', 'comm-express' ),
    'priority'   => 10,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_addons_panel',
    )
);

$wp_customize->add_setting( 'comm_express_theme_pagination_options_alignment',
    array(
    'default'           => $comm_express_default['comm_express_theme_pagination_options_alignment'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'comm_express_sanitize_pagination_meta',
    )
);
$wp_customize->add_control( 'comm_express_theme_pagination_options_alignment',
    array(
    'label'       => esc_html__( 'Pagination Alignment', 'comm-express' ),
    'section'     => 'theme_pagination_options',
    'type'        => 'select',
    'choices'     => array(
        'Center'    => esc_html__( 'Center', 'comm-express' ),
        'Right' => esc_html__( 'Right', 'comm-express' ),
        'Left'  => esc_html__( 'Left', 'comm-express' ),
        ),
    )
);

$wp_customize->add_setting( 'comm_express_theme_breadcrumb_options_alignment',
    array(
    'default'           => $comm_express_default['comm_express_theme_breadcrumb_options_alignment'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'comm_express_sanitize_pagination_meta',
    )
);
$wp_customize->add_control( 'comm_express_theme_breadcrumb_options_alignment',
    array(
    'label'       => esc_html__( 'Breadcrumb Alignment', 'comm-express' ),
    'section'     => 'theme_pagination_options',
    'type'        => 'select',
    'choices'     => array(
        'Center'    => esc_html__( 'Center', 'comm-express' ),
        'Right' => esc_html__( 'Right', 'comm-express' ),
        'Left'  => esc_html__( 'Left', 'comm-express' ),
        ),
    )
);

$wp_customize->add_setting('comm_express_breadcrumb_font_size',
    array(
        'default'           => $comm_express_default['comm_express_breadcrumb_font_size'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'comm_express_sanitize_number_range',
    )
);
$wp_customize->add_control('comm_express_breadcrumb_font_size',
    array(
        'label'       => esc_html__('Breadcrumb Font Size', 'comm-express'),
        'section'     => 'theme_pagination_options',
        'type'        => 'number',
        'input_attrs' => array(
           'min'   => 1,
           'max'   => 45,
           'step'   => 1,
        ),
    )
);

$wp_customize->add_setting( 'comm_express_single_page_content_alignment',
    array(
    'default'           => $comm_express_default['comm_express_single_page_content_alignment'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'comm_express_sanitize_page_content_alignment',
    )
);
$wp_customize->add_control( 'comm_express_single_page_content_alignment',
    array(
    'label'       => esc_html__( 'Single Page Content Alignment', 'comm-express' ),
    'section'     => 'theme_pagination_options',
    'type'        => 'select',
    'choices'     => array(
        'left' => esc_html__( 'Left', 'comm-express' ),
        'center'  => esc_html__( 'Center', 'comm-express' ),
        'right'    => esc_html__( 'Right', 'comm-express' ),
        ),
    )
);