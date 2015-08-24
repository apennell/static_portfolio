<?php

function hex_to_rgb( $hex ) {
		$hex = str_replace("#", "", $hex);
		$color = array();
		
		if( is_string( $hex) && strlen($hex) == 6) {
			
			$color['r'] = hexdec(substr($hex, 0, 2));
			$color['g'] = hexdec(substr($hex, 2, 2));
			$color['b'] = hexdec(substr($hex, 4, 2));
			
			return $color;
		} else {
			return $hex;
		}
		
}

class Village_Filter_CSS_Values {	
	
	public static function decimal( $value, $option ) {
		return (float) $value / 100;
	}

	public static function rgba( $value, $option ) {

		$opacity = Village::get_theme_mod( $option . "_opacity", false );

		if ( $opacity != false && $opacity != 100 ) {
			
			$rgb = hex_to_rgb( $value );
			$alpha = (float) $opacity / 100;

			if ( is_array( $rgb ) ) {
				return "rgba(" . implode(",", $rgb) . "," . $alpha . ")";
			}

		}
		

		return $value;

	}

} // End Village_Filter_CSS_Values


class Village_CSS_Options {

	static $css_string = "";
	/**
	 * Initialize Village CSS Function
	 */
	public static function init() {		
		
		// Advanced CSS Generation
		self::css_custom();

		// Generate CSS Based on Redux Config
		add_action( 'before_redux_setup', array( __CLASS__, "css_from_config" ), 10, 1 );

		// Add the generated CSS to wp_head
		add_action( 'wp_head', array( __CLASS__, "generate" ) );
	}


	/**
	 * Generate CSS From Redux Framework Config
	 * Attached with `before_redux_setup` action
	 * @param  (array) $sections Redux Sections
	 */
	public static function css_from_config( $sections ) {
		
		$out = array();

		foreach ($sections as $section) {
			foreach ( $section['fields'] as $field) {
				
				if ( isset( $field['css'] ) ) {
					$filters = ( isset( $field['apply_filters']) ) ? $field['apply_filters'] : false;
					self::$css_string .= self::css_from_option( $field['id'], $field['default'], $field['css'], $field['type'], $filters );
				}
			}
		}
	}


	/**
	 * Advanced CSS Calculations that were inconvenient to do on-the-fly
	 */
	private static function css_custom() {	

		$css = "";

		//-----------------------------------*/
		// Header Background Color
		//-----------------------------------*/
		$header_color = Village::get_theme_mod("header_color", "#161616");
		$header_opacity = Village::get_theme_mod("header_color_opacity", "70");
	
		self::$css_string .= $css;

		$custom_css = Village::get_theme_mod("custom_css", false);
		if( $custom_css ) {
			self::$css_string .= $custom_css;
		}
	}


	private static function get_css_option( $option, $default_value ) {
		$value = Village::get_theme_mod( $option, $default_value );

		if( $value === $default_value ) { 
			return false;
		} else {
			return $value;
		}

	}

	private static function css_from_option( $option, $default_value, $css, $type, $filter = false ) {
		
		$value = self::get_css_option( $option, $default_value );
		$output = "";

		if(	$type === 'color_rgba' && isset( $value['color'] ) ) {
			
			$rgb = hex_to_rgb( $value['color'] );
			$alpha = $value['alpha'];


			if( is_array( $rgb ) && !empty( $alpha ) ) {
				$value = "rgba(" . implode(",", $rgb) . "," . $alpha . ")";
			}

		}
	
		if ( $value !== false ) {	
			
			if ( $filter !== false ) {
				$value = apply_filters( 'village_css_filter_' . $filter, $value, $option );
			}

			// Stop the output if $value is empty for some reason
			if ( empty( $value ) ) {
				return $output;
			}

			foreach ( $css as $selector => $properties ) {
				$output .= "{$selector} {";
				foreach ( $properties as $property => $value_template ) {	

					if( is_string( $value ) ) {
						$value = str_replace('%%value%%', $value, $value_template);
						$output .= "{$property}: {$value};";
					}

				}

				$output .= "} ";
			}
		}
		return $output;
	}


	public static function generate() {

		// Quit if no styles to generate
		if ( empty( self::$css_string ) ) return;


		// Output styles:
		$out = '<style id="village-inline-styles" type="text/css">';
		$out .='/* Styles Generated inline from Theme Options. */';
		$out .= self::$css_string;
		$out .= '</style>';

		$out = str_replace( "&gt;", ">", $out );
		echo  preg_replace( '/\s+/', ' ', $out );

	}



} // End Village_CSS_Options










/**
 * Get a list of `Village_Filter_CSS_Values` methods and use them as Wordpress Filters
 */
$methods = get_class_methods( 'Village_Filter_CSS_Values' );
foreach ($methods as $method) {
	add_filter( 'village_css_filter_' . $method , array( 'Village_Filter_CSS_Values', $method), 10, 2 );
}

//-----------------------------------*/
// Initialize Village CSS
//-----------------------------------*/
Village_CSS_Options::init();










