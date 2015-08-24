<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Acid
 * @since Acid 1.0
 */
$the_sidebars = wp_get_sidebars_widgets();
$widget_count = count( $the_sidebars['footer-1'] );

?>

	</div><!-- #main .site-main-->
	</div> <!-- .container -->
	</div><!-- #page -->
	
	<?php if( Village::is_enabled("footer", true) ): ?>
	<footer id="footer" class="site-footer" role="contentinfo">
		<div id="footer-arrow"><span>+</span></div>
		<div id="footer-content" class="site-info">

		<div class="grid-wrapper widgets-<?php echo $widget_count ?>">

			<?php dynamic_sidebar( "footer-1" ); ?>

		</div>
		
		<?php if ( Village::is_enabled("themevillage_credits", true ) ): ?>
			<span class="copyright">
			<?php printf( __( '%1$s by %2$s.', 'acid' ), 'Acid Theme', '<a href="http://themevillage.net/" rel="designer">Theme Village</a>' ); ?>
			</span>
		<?php endif; ?>

		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	<?php endif; ?>

<div id="overlay" class="fixed-overlay"></div>
	<div id="ajax-popup">
		<div id="popup-arrow"></div>
		<div id="ajax-popup-content">
			<div class="entry-content"></div>
		</div>
	</div>

<?php
$acid_options["footer_toggle"] = Village::is_enabled("footer", true);
$acid_options["auto_initial_scroll"] = Village::is_enabled("auto_initial_scroll", true);
$acid_options["blinking_arrow"] = Village::is_enabled("blinking_arrow", true);
?>

<script>
	ACID_OPTIONS_CONFIG = <?php echo json_encode( $acid_options ); ?>;
</script>


<?php wp_footer(); ?>
</body>
</html>
