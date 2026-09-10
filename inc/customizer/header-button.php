<?php
/**
* Header Options.
*
* @package CommExpress
*/

$comm_express_default = comm_express_get_default_theme_options();

// Header Section.
$wp_customize->add_section( 'button_header_setting',
	array(
	'title'      => esc_html__( 'Header Settings', 'comm-express' ),
	'priority'   => 10,
	'capability' => 'edit_theme_options',
	'panel'      => 'comm_express_theme_option_panel',
	)
);

$wp_customize->add_setting('comm_express_menu_font_size',
    array(
        'default'           => $comm_express_default['comm_express_menu_font_size'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'comm_express_sanitize_number_range',
    )
);
$wp_customize->add_control('comm_express_menu_font_size',
    array(
        'label'       => esc_html__('Menu Font Size', 'comm-express'),
        'section'     => 'button_header_setting',
        'type'        => 'number',
        'input_attrs' => array(
           'min'   => 1,
           'max'   => 30,
           'step'   => 1,
        ),
    )
);

$wp_customize->add_setting( 'comm_express_menu_text_transform',
    array(
    'default'           => $comm_express_default['comm_express_menu_text_transform'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'comm_express_sanitize_menu_transform',
    )
);
$wp_customize->add_control( 'comm_express_menu_text_transform',
    array(
    'label'       => esc_html__( 'Menu Text Transform', 'comm-express' ),
    'section'     => 'button_header_setting',
    'type'        => 'select',
    'choices'     => array(
        'capitalize' => esc_html__( 'Capitalize', 'comm-express' ),
        'uppercase'  => esc_html__( 'Uppercase', 'comm-express' ),
        'lowercase'    => esc_html__( 'Lowercase', 'comm-express' ),
        ),
    )
);

$wp_customize->add_setting('comm_express_sticky',
    array(
        'default' => $comm_express_default['comm_express_sticky'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'comm_express_sanitize_checkbox',
    )
);
$wp_customize->add_control('comm_express_sticky',
    array(
        'label' => esc_html__('Enable Sticky Header', 'comm-express'),
        'section' => 'button_header_setting',
        'type' => 'checkbox',
    )
);
