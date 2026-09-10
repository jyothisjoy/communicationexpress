<?php
/**
* Layouts Settings.
*
* @package CommExpress
*/

$comm_express_default = comm_express_get_default_theme_options();

// Layout Section.
$wp_customize->add_section( 'comm_express_layout_setting',
	array(
	'title'      => esc_html__( 'Global Layout Settings', 'comm-express' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
	'panel'      => 'comm_express_theme_option_panel',
	)
);

$wp_customize->add_setting( 'comm_express_global_sidebar_layout',
    array(
    'default'           => $comm_express_default['comm_express_global_sidebar_layout'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'comm_express_sanitize_sidebar_option',
    )
);
$wp_customize->add_control( 'comm_express_global_sidebar_layout',
    array(
    'label'       => esc_html__( 'Global Sidebar Layout', 'comm-express' ),
    'section'     => 'comm_express_layout_setting',
    'type'        => 'select',
    'choices'     => array(
        'right-sidebar' => esc_html__( 'Right Sidebar', 'comm-express' ),
        'left-sidebar'  => esc_html__( 'Left Sidebar', 'comm-express' ),
        'no-sidebar'    => esc_html__( 'No Sidebar', 'comm-express' ),
        ),
    )
);
