<?php
/**
* Custom Functions.
*
* @package CommExpress
*/

if( !function_exists( 'comm_express_sanitize_sidebar_option' ) ) :

    // Sidebar Option Sanitize.
    function comm_express_sanitize_sidebar_option( $comm_express_input ){

        $comm_express_metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $comm_express_input,$comm_express_metabox_options ) ){

            return $comm_express_input;

        }

        return;

    }

endif;

if ( ! function_exists( 'comm_express_sanitize_checkbox' ) ) :

	/**
	 * Sanitize checkbox.
	 */
	function comm_express_sanitize_checkbox( $comm_express_checked ) {

		return ( ( isset( $comm_express_checked ) && true === $comm_express_checked ) ? true : false );

	}

endif;


if ( ! function_exists( 'comm_express_sanitize_select' ) ) :

    /**
     * Sanitize select.
     */
    function comm_express_sanitize_select( $comm_express_input, $comm_express_setting ) {
        $comm_express_input = sanitize_text_field( $comm_express_input );
        $choices = $comm_express_setting->manager->get_control( $comm_express_setting->id )->choices;
        return ( array_key_exists( $comm_express_input, $choices ) ? $comm_express_input : $comm_express_setting->default );
    }

endif;