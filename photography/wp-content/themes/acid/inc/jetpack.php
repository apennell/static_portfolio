<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package acid
 */


//-----------------------------------*/
// Disable Jetpack Photon
//-----------------------------------*/
if ( class_exists( 'Jetpack' ) && method_exists('Jetpack', 'deactivate_module') && Jetpack::is_module_active('photon') ) {
	Jetpack::deactivate_module( 'photon' );
}