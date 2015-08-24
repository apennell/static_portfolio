<?php


class Village_One_Page extends Village {

	public static function init() {

		register_nav_menu( "village_one_page", "Acid One-Page Contents" );

	}

	/**
	 * Filter Menu items (let only actual pages through)
	 *
	 * @param  (object) $item
	 *
	 * @return (str) Page ID or NULL
	 */
	public static function page_filter( $item ) {
		if ( ( isset( $item->object ) && $item->object == "page" ) ) {
			return $item->object_id;
		}

		return null;
	}

	/**
	 * Get the Page Menu items
	 *
	 * @param  boolean $location
	 *
	 * @return array|bool [type]
	 */
	public static function page_get_menu_items( $location = false ) {

		$menu = self::page_get_menu( $location );

		if ( ! empty( $menu ) && ! is_wp_error( $menu ) ) {
			// Get menu items ( List of pages );
			$menu_items = wp_get_nav_menu_items( $menu->term_id );
			$menu_items = array_values(  // Fix the index
				array_diff(  // Remove null values
				// Filter Pages with self::page_filter()
					array_map( array( __CLASS__, "page_filter" ), $menu_items )
					, array( null ) // array_diff()
				)
			);

			return $menu_items;
		}

		return false;
	}

	/**
	 * Get the "Page Menu"
	 *
	 * @param bool $location
	 *
	 * @return ARRAY_A
	 * @internal param Menu $Which to get ? $location
	 *
	 */
	public static function page_get_menu( $location = false ) {

		if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $location ] ) ) {
			$menu = wp_get_nav_menu_object( $locations[ $location ] );

			return $menu;
		}

		return false;
	}
}