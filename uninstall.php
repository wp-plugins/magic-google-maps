<?php 
if(!defined('WP_UNINSTALL_PLUGIN')){
	exit();
}
delete_option( 'googlemapsCode' );
delete_option( 'googlemapsLat' );
delete_option( 'googleMapsLng' );
delete_option( 'googlemapspinLat' );
delete_option( 'googlemapspinLng' );
delete_option( 'placedescryption' );
delete_option( 'zoom' );
delete_option( 'height' );
delete_option( 'enabledescription' );