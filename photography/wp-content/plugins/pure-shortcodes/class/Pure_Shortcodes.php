<?php

/* ---------------------------------------------------------------*/
/* 	Not a real Class, Singleton, or anything really.
/*  This is just a very nice wrapper for everything, and in the end
/*  Nice is all that matters, right ?
/* ---------------------------------------------------------------*/
class Pure_Shortcodes {

	// Available, Protected an Disabled Shortcodes
	private $available_shortcodes;
	private $protected_shortcodes;
	private $disabled_shortcodes;

	// Instance Getter
	static $self;

	// Shortcode Prefix
	public $prefix;


	function __construct() {
		self::$self = $this;
		// Defer on Filtering and Setting up until Wordpress is up and running.
		// We want themes to be able to tap in here after all.
		add_action( 'init', array( &$this, 'init' ) );

	}

	public function init() {
		$this -> prefix = apply_filters( 'pure_shortcode_prefix', 'pure_' );
		$this -> disabled_shortcodes = apply_filters( 'pure_disabled_shortcodes', array() );
		$this -> available_shortcodes = get_class_methods( 'Pure_ML' );

		foreach ( $this -> available_shortcodes as $shortcode ) {

			// You know, because WILD shortcodes don't need protection.
			// They're badass like that
			if ( strstr( $shortcode, 'WILD_' ) ) {
				$shortcode_name = str_replace( "WILD_", "", $shortcode );
			} else {
				$shortcode_name = $shortcode;
			}

			// Skip this shortcode if it's in disabled shortcodes...
			if ( in_array( $this -> prefix . $shortcode_name, $this -> disabled_shortcodes ) ) { continue; }

			add_shortcode( $this -> prefix . $shortcode_name, array( 'Pure_ML', $shortcode ) );
			$this -> protected_shortcodes[] = $shortcode;
		}

		add_filter ( 'the_content', array( &$this, 'run_shortcodes' ), 7 );
	}

	/**
	 * Run a shortcode in a clean way
	 *
	 * @param unknown $content Wordpress Post Content
	 * @return $content The Processed Content
	 */
	public function run_shortcodes( $content ) {
		global $shortcode_tags;

		$original_shortcode_tags = $shortcode_tags;
		remove_all_shortcodes();

		foreach ( $this -> protected_shortcodes as $shortcode ) {
			add_shortcode( $this -> prefix . $shortcode, array( 'Pure_ML', $shortcode ) );
		}

		// Do only Pure_Shortcodes!
		$content = do_shortcode( $content );



		$shortcode_tags = $original_shortcode_tags;

		return $content;
	}


	/**
	 * Get This Instance
	 *
	 * @return (object) Instance
	 */
	public static function get_instance() {
		return self::$self;
	}

}
