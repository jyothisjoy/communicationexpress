<?php
/**
* Posts Settings.
*
* @package CommExpress
*/

$comm_express_default = comm_express_get_default_theme_options();

// Single Post Section.
$wp_customize->add_section( 'posts_settings',
	array(
	'title'      => esc_html__( 'Metainformation Settings', 'comm-express' ),
	'priority'   => 35,
	'capability' => 'edit_theme_options',
	'panel'      => 'comm_express_theme_option_panel',
	)
);

$wp_customize->add_setting('comm_express_post_author',
    array(
        'default' => $comm_express_default['comm_express_post_author'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'comm_express_sanitize_checkbox',
    )
);
$wp_customize->add_control('comm_express_post_author',
    array(
        'label' => esc_html__('Enable Posts Author', 'comm-express'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('comm_express_post_date',
    array(
        'default' => $comm_express_default['comm_express_post_date'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'comm_express_sanitize_checkbox',
    )
);
$wp_customize->add_control('comm_express_post_date',
    array(
        'label' => esc_html__('Enable Posts Date', 'comm-express'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('comm_express_post_category',
    array(
        'default' => $comm_express_default['comm_express_post_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'comm_express_sanitize_checkbox',
    )
);
$wp_customize->add_control('comm_express_post_category',
    array(
        'label' => esc_html__('Enable Posts Category', 'comm-express'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('comm_express_post_tags',
    array(
        'default' => $comm_express_default['comm_express_post_tags'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'comm_express_sanitize_checkbox',
    )
);
$wp_customize->add_control('comm_express_post_tags',
    array(
        'label' => esc_html__('Enable Posts Tags', 'comm-express'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('comm_express_excerpt_limit',
    array(
        'default'           => $comm_express_default['comm_express_excerpt_limit'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'comm_express_sanitize_number_range',
    )
);
$wp_customize->add_control('comm_express_excerpt_limit',
    array(
        'label'       => esc_html__('Blog Post Excerpt limit', 'comm-express'),
        'section'     => 'posts_settings',
        'type'        => 'number',
        'input_attrs' => array(
           'min'   => 1,
           'max'   => 45,
           'step'   => 1,
        ),
    )
);