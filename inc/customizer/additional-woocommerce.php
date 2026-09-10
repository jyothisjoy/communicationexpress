<?php
/**
* Additional Woocommerce Settings.
*
* @package CommExpress
*/

$comm_express_default = comm_express_get_default_theme_options();

// Additional Woocommerce Section.
$wp_customize->add_section( 'comm_express_additional_woocommerce_options',
	array(
	'title'      => esc_html__( 'Additional Woocommerce Options', 'comm-express' ),
	'priority'   => 210,
	'capability' => 'edit_theme_options',
	'panel'      => 'comm_express_theme_option_panel',
	)
);

	$wp_customize->add_setting('comm_express_per_columns',
		array(
		'default'           => $comm_express_default['comm_express_per_columns'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'comm_express_sanitize_number_range',
		)
	);
	$wp_customize->add_control('comm_express_per_columns',
		array(
		'label'       => esc_html__('Product Per Column', 'comm-express'),
		'section'     => 'comm_express_additional_woocommerce_options',
		'type'        => 'number',
		'input_attrs' => array(
		'min'   => 1,
		'max'   => 10,
		'step'   => 1,
		),
		)
	);

	$wp_customize->add_setting('comm_express_product_per_page',
		array(
		'default'           => $comm_express_default['comm_express_product_per_page'],
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'comm_express_sanitize_number_range',
		)
	);
	$wp_customize->add_control('comm_express_product_per_page',
		array(
		'label'       => esc_html__('Product Per Page', 'comm-express'),
		'section'     => 'comm_express_additional_woocommerce_options',
		'type'        => 'number',
		'input_attrs' => array(
		'min'   => 1,
		'max'   => 15,
		'step'   => 1,
		),
		)
	);