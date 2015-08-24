<?php



class Horizontal_Entry {

	private static  $counter = 0;
	private static $first = true;
	private static $last_column_size = 0;

	private static $column_size_names = array(
		1 => 'full',
		2 => 'half',
	);
	private $column_size;


	/**
	 * Constructor
	 *
	 * @param (string) $column_size The size of this entry
	 */
	public function __construct( $column_size ) {

		// Auto-increase counter with each new instance
		self::$counter++;

		if ( ! empty( $column_size ) ) {
			$this -> column_size = $column_size;
		} else {
			$this -> column_size = 2;
		}

		$this -> column_size_name = self::$column_size_names[ $this -> column_size ];

		// Store the last column_size for use in self::clean_up()
		self::$last_column_size = $this->column_size;
	}


	//-----------------------------------*/
	// Private
	//-----------------------------------*/

	/**
	 * Open Horizontal Entry <div>
	 *
	 * @return echo output
	 */
	private function column_open() {
		echo '<div class="hscol box-column ' . $this -> column_size_name . '">';
	}

	/**
	 * Close Horizontal Entry </div>
	 *
	 * @return echo output
	 */
	private static function column_close() {
		echo '</div><!-- .hscol.box-column ' . self::$last_column_size . ' -->';
		self::$counter = 0;
	}


	//-----------------------------------*/
	// Public
	//-----------------------------------*/

	/**
	 * Check if current entry is first out of all entries
	 * @return bool
	 */
	public static function is_first() {
		return self::$first;
	}



	public function render() {

		// Open .hscol
		if ( self::$counter === 1 ) {
			$this -> column_open();
		}

		get_template_part( 'parts/box-' . get_post_type(), $this -> column_size_name );

		// Close .hscol
		if ( self::$counter === $this -> column_size ) {
			self::column_close();
		}

		// Set the static instance variable to false
		self::$first = false;
	}



	/**
	 * A function to be run after the loop ends
	 * If counter didn't reach column-size
	 * Manually close the column
	 */
	public static function clean_up() {
		if ( self::$counter !== 0 && self::$last_column_size !== self::$counter ) {

			if ( defined("WP_DEBUG") && true === WP_DEBUG ) {
				echo "<!-- Force closing .hscol.box-column
						Last Column Size: " . self::$last_column_size . "
						Counter: " . self::$counter . "
					-->";
			}

			self::column_close();
		}
	}
}
