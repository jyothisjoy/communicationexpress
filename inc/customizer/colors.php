<?php
/**
* Color Settings.
* @package CommExpress
*/

$comm_express_default = comm_express_get_default_theme_options();

$wp_customize->add_setting( 'comm_express_default_text_color',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'comm_express_default_text_color',
    array(
        'label'      => esc_html__( 'Text Color', 'comm-express' ),
        'section'    => 'colors',
        'settings'   => 'comm_express_default_text_color',
    ) ) 
);

$wp_customize->add_setting( 'comm_express_border_color',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'comm_express_border_color',
    array(
        'label'      => esc_html__( 'Border Color', 'comm-express' ),
        'section'    => 'colors',
        'settings'   => 'comm_express_border_color',
    ) ) 
);