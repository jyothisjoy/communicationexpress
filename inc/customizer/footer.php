<?php
/**
* Footer Settings.
*
* @package CommExpress
*/

$comm_express_default = comm_express_get_default_theme_options();

$wp_customize->add_section( 'footer_widget_area',
	array(
	'title'      => esc_html__( 'Footer Setting', 'comm-express' ),
	'priority'   => 200,
	'capability' => 'edit_theme_options',
	'panel'      => 'comm_express_theme_option_panel',
	)
);

$wp_customize->add_setting( 'comm_express_footer_column_layout',
	array(
	'default'           => $comm_express_default['comm_express_footer_column_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'comm_express_sanitize_select',
	)
);
$wp_customize->add_control( 'comm_express_footer_column_layout',
	array(
	'label'       => esc_html__( 'Footer Column Layout', 'comm-express' ),
	'section'     => 'footer_widget_area',
	'type'        => 'select',
	'choices'               => array(
		'1' => esc_html__( 'One Column', 'comm-express' ),
		'2' => esc_html__( 'Two Column', 'comm-express' ),
		'3' => esc_html__( 'Three Column', 'comm-express' ),
	    ),
	)
);

$wp_customize->add_setting( 'comm_express_footer_copyright_text',
	array(
	'default'           => $comm_express_default['comm_express_footer_copyright_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'comm_express_footer_copyright_text',
	array(
	'label'    => esc_html__( 'Footer Copyright Text', 'comm-express' ),
	'section'  => 'footer_widget_area',
	'type'     => 'text',
	)
);

// Add Footer Logo Setting
$wp_customize->add_setting( 'comm_express_footer_logo',
	array(
		'default'           =>  esc_html__( 'Footer Logo', 'comm-express' ), // Set the default to an empty string or specify a default image URL if needed
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_setting('comm_express_footer_logo',array(
    'default'   => '',
    'sanitize_callback' => 'esc_url_raw',
));
// Add Footer Logo Control
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'comm_express_footer_logo',
	array(
		'label'    => __( 'Footer Logo', 'comm-express' ),
		'section'  => 'footer_widget_area', // Use the appropriate section ID
		'settings' => 'comm_express_footer_logo',
	)
));


$wp_customize->add_setting('comm_express_copyright_font_size',
    array(
        'default'           => $comm_express_default['comm_express_copyright_font_size'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'comm_express_sanitize_number_range',
    )
);
$wp_customize->add_control('comm_express_copyright_font_size',
    array(
        'label'       => esc_html__('Copyright Font Size', 'comm-express'),
        'section'     => 'footer_widget_area',
        'type'        => 'number',
        'input_attrs' => array(
           'min'   => 5,
           'max'   => 30,
           'step'   => 1,
    	),
    )
);

$wp_customize->add_setting( 'comm_express_footer_widget_background_color', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_hex_color'
));
$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'comm_express_footer_widget_background_color', array(
    'label'     => __('Footer Widget Background Color', 'comm-express'),
    'description' => __('It will change the complete footer widget background color.', 'comm-express'),
    'section' => 'footer_widget_area',
    'settings' => 'comm_express_footer_widget_background_color',
)));

$wp_customize->add_setting('comm_express_footer_widget_background_image',array(
    'default'   => '',
    'sanitize_callback' => 'esc_url_raw',
));
$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'comm_express_footer_widget_background_image',array(
    'label' => __('Footer Widget Background Image','comm-express'),
    'section' => 'footer_widget_area'
)));