<?php
/**
 * Plugin Name: Magic Google Maps
 * Plugin URI: http://www.magicpluginfactory.com/
 * Description: Add Google maps quickly and easly to your page. Light weight plugin optymized for speed.
 * Version: 1.0.4
 * Author: Magic Plugin Factory
 * Author URI: http://www.magicpluginfactory.com/
 * License: GPL2
 */
 
function magic_maps_activate() {

    add_option( 'googlemapsCode', '' );
    add_option( 'googlemapsLat', '1' );
    add_option( 'googleMapsLng', '1' );
    add_option( 'googlemapspinLat', '1' );
    add_option( 'googlemapspinLng', '1' );
    add_option( 'placedescription', 'Your text' );
    add_option( 'height', '350px' );
    add_option( 'zoom', '1' );
    add_option('enabledescription', '1');

   
    
}
register_activation_hook( __FILE__, 'magic_maps_activate' );
 
function bf_magic_maps() {
	
	wp_enqueue_style( 'map-style', plugins_url() . '/magic-google-maps/css/style.css');
	wp_enqueue_script( 'script-name',"https://maps.googleapis.com/maps/api/js?key=".get_option('googlemapsCode')."", array(), '2.2.2', false );	
	wp_register_script( 'magic-maps',plugins_url() . '/magic-google-maps/js/bf_script.js', array(), '6.6.6', true );
	
}

add_action( 'wp_enqueue_scripts', 'bf_magic_maps' );

function bf_admin_map(){
	wp_enqueue_style( 'map-style', plugins_url() . '/magic-google-maps/css/style.css');
	wp_enqueue_script( 'script-name',"https://maps.googleapis.com/maps/api/js?key=".get_option('googlemapsCode')."", array(), '2.2.2', false );	
	wp_register_script( 'magic-maps',plugins_url() . '/magic-google-maps/js/bf_script_backend.js', array(), '6.6.6', true );
	
}
add_action( 'admin_enqueue_scripts', 'bf_admin_map' );

//---------------------------------------------------
//shortcode [map]
//---------------------------------------------------

function bf_map_func( $atts, $content){
	
	$a = shortcode_atts(array(
		'mapnr' => '2'
	), $atts);

	$html = '<div id="map-canvas'.$a['mapnr'].'">';
	$html .= '</div>';
	
	return $html;
}
add_shortcode( 'map', 'bf_map_func' );

//---------------------------------------------------
//Add Settings page
//---------------------------------------------------


function bf_add_map_page(){
	
	add_menu_page(
					"Magic Maps", 												// The text to be displayed in the browser title bar
					"Magic Maps",												// The text to be used for the menu
					"manage_options", 												// The required capability of users to access this menu
					"magicmaps",												// The slug by which this menu item is accessible 
					"bf_map_settings_page", 										// The name of the function used to display the page content
					plugins_url( 'images/Magic-maps.png' , __FILE__ ), 			// Icon
					30 );															// Position
}

add_action("admin_menu", "bf_add_map_page");

//---------------------------------------------------
//Add Settings and fields
//---------------------------------------------------

function bf_initialize_map_options(){
	add_settings_section(
						"googleMapsSection",		
						"Google Maps Options Section",
						"google_maps_section",		
						"magicmaps"					
						);
	 add_settings_field(
	 					"height", 			//(string) (required) String for use in the 'id' attribute of tags.
	 					"Height of the Map", 			//(string) (required) Title of the field.
	 					"height", 			//(string) (required) Function that fills the field with the desired inputs as part of the larger form. Passed a single argument, the $args array. Name and id of the input should match the $id given to this function. The function should echo its output. Default: None
	 					"magicmaps" ,					//(string) (required) The menu page on which to display this field. Should match $menu_slug from add_theme_page()
	 					"googleMapsSection"				//(string) (optional) The section of the settings page in which to show the box (default or a section you added with add_settings_section(), look at the page in the source to see what the existing ones are.) Default: default
	 					);
	 add_settings_field(
	 					"enabledescription", 
	 					"Enable description", 		
	 					"enable_description", 		
	 					"magicmaps" ,				
	 					"googleMapsSection"			
	 					);
	 add_settings_field(
	 					"placedescription", 
	 					"Description", 		
	 					"place_description", 		
	 					"magicmaps" ,				
	 					"googleMapsSection"			
	 					);
	 add_settings_field(
	 					"zoom", 			
	 					"Zoom of the Map", 
	 					"zoom", 			
	 					"magicmaps" ,					
	 					"googleMapsSection"				
	 					);
	
	 add_settings_field(
	 					"googlemapsLat", 			
	 					"Google Maps Lat", 			
	 					"google_maps_lat", 			
	 					"magicmaps" ,				
	 					"googleMapsSection"			
	 					);
	 add_settings_field(
	 					"googlemapsLng", 			
	 					"Google Maps Lng", 			
	 					"google_maps_lng", 			
	 					"magicmaps" ,				
	 					"googleMapsSection"			
	 					);
	 add_settings_field(
	 					"googlemapspinLat", 		
	 					"Location Pin Lat", 		
	 					"google_maps_pin_lat", 		
	 					"magicmaps" ,				
	 					"googleMapsSection"			
	 					);
	 add_settings_field(
	 					"googlemapspinLng", 		
	 					"Location Pin Lng", 		
	 					"google_maps_pin_lng", 		
	 					"magicmaps" ,				
	 					"googleMapsSection"			
	 					);
	 add_settings_field(
	 					"googlemapsCode", 			
	 					"Google Maps API Code", 	
	 					"google_maps_code", 		
	 					"magicmaps" ,				
	 					"googleMapsSection"			
	 					);
	 
	 register_setting(
	 					"googleMapsSection",			//(string) (required) A settings group name. Must exist prior to the register_setting call. This must match the group name in settings_fields()
	 					"Height"				//(string) (required) A settings group name. Must exist prior to the register_setting call. This must match the group name in settings_fields()
	 );
	 register_setting(
	 					"googleMapsSection",		
	 					"GoogleMapsCode"			
	 );	
	 register_setting(
	 					"googleMapsSection",		
	 					"GoogleMapsLat"				
	 );	
	 register_setting(
	 					"googleMapsSection",		
	 					"GoogleMapsLng"				
	 );
	 register_setting(
	 					"googleMapsSection",			
	 					"GoogleMapsPinLat"				
	 );	
	 register_setting(
	 					"googleMapsSection",			
	 					"GoogleMapsPinLng"				
	 );		
	 register_setting(
	 					"googleMapsSection",			
	 					"Placedescription"				
	 );
	 register_setting(
	 					"googleMapsSection",			
	 					"Enabledescription"				
	 );
	 register_setting(
	 					"googleMapsSection",			
	 					"Zoom"				
	 );
	 	 		
}
add_action("admin_init","bf_initialize_map_options");
//---------------------------------------------------
//  Callbacks
//---------------------------------------------------
function bf_map_settings_page(){
	
	 // Create a header in the default WordPress 'wrap' container?>
    <div class="wrap">
       <h2>Magic Google Maps Options</h2>
      
	  <div id="map-canvas1"></div>
	  <form method="post" action="options.php">
	    <?php
	     settings_fields('googleMapsSection');?>
	       <br/> <p class="description">Drag and drop pin to desire location zoom in and out to set preferred view  and save.<br/> 
	      Remember to set the height of the map width will adjust automaticaly.<br/>
	      Copy and paste code to your contact page:  <span style="font-size: 1.2em; background: #ffffff; padding: 5px 10px; margin:10px; line-height: 2.8em; border: 1px solid #5b9dd9;box-shadow: 0 0 2px rgba(30,140,190,.8);"><b> [map]</b></span>
	      </p><?php
	     submit_button();
	     do_settings_sections('magicmaps');
	     submit_button();
	     
	    ?>
    </form>
    </div>
   <?php
 	
}

function google_maps_section(){
	echo "Here you can adjust manually Google maps options ";
}
function google_maps_code(){
	$option_API_key = get_option('googlemapsCode');	
	echo '<input type="text" name="GoogleMapsCode" id="GoogleMapsCode" value="'.  $option_API_key .'" > ';
	echo "Optional";
}
function google_maps_lat(){
	$option_Map_Lat = get_option('googlemapsLat', '1');					
	echo '<input type="text" name="GoogleMapsLat" id="GoogleMapsLat" value="'.  $option_Map_Lat .'" > ';
}
function google_maps_lng(){
			$option_Map_lng = get_option('googleMapsLng', '1');			
	echo '<input type="text" name="GoogleMapsLng" id="GoogleMapsLng" value="'.  $option_Map_lng .'" > ';
}
function google_maps_pin_lat(){
			$option_Pin_Lat = get_option('googlemapspinLat', '1');			
	echo '<input type="text" name="GoogleMapsPinLat" id="GoogleMapsPinLat" value="'.  $option_Pin_Lat .'" > ';
}
function google_maps_pin_lng(){
			$option_Pin_lng = get_option('googlemapspinLng', '1');			
	echo '<input type="text" name="GoogleMapsPinLng" id="GoogleMapsPinLng" value="'.  $option_Pin_lng .'" > ';
}
function place_description(){
			$option_description = get_option('placedescription');			
	echo '<textarea rows="6" cols="30" name="Placedescription" id="Placedescription" value="" >'.  $option_description .'</textarea>';
}
function enable_description(){
			$enable_description = get_option('enabledescription');			
			$html = '<input type="checkbox" name="Enabledescription" value="1" '. checked( $enable_description , 1 , false) .' />';
		    $html .= '<label for="checkbox_example">Display or hide Info window</label>';
		    echo $html;
}
function height(){
			$option_height = get_option('height','200px');			
	echo '<input type="text" name="Height" id="Height" value="'.  $option_height .'" >';
}
function zoom(){
			$option_zoom = get_option('zoom', '1');			
	//echo '<input type="text" name="Zoom" id="Zoom" value="'.  $option_zoom .'" > ';
	$html = '<select id="Zoom" name="Zoom">';
		$html .= '<option>'.$option_zoom.'</option>';
		$i = 1;
		while($i <=  19){
		$html .= '<option value="'.$i.'">';
		$html .= $i ;
		$html .= ' </option>';	
		$html .= $i ++;
	}
	$html .= '</select>';
	echo $html;
}

//---------------------------------------------------
//Create object to be used in Java script Google Api
//---------------------------------------------------

function bf_map_settings(){
$map_style = '<style type="text/css" >';
$map_style .=	'#map-canvas1, #map-canvas2{';
$map_style .=		'height:'.get_option('height').';';
$map_style .=	'}';
$map_style .= '</style>';

echo $map_style;	
}
add_action('wp_head', 'bf_map_settings');

//---------------------------------------------------
//Create object to be used in Java script Google Api
//---------------------------------------------------

Function pass_data_to_script(){

	$script_params = array(
	    'option_API_key' => get_option('googlemapsCode'),
	    'option_Map_Lat' => get_option('googlemapsLat'),
	    'option_Map_lng' => get_option('googleMapsLng'),
	    'option_Pin_Lat' => get_option('googlemapspinLat'),
	    'option_Pin_lng' => get_option('googlemapspinLng'),
	    'option_description' => get_option('placedescription'),
	    'option_zoom' => get_option('zoom'),
	    'enable_description' => get_option('enabledescription')
	);
	
	wp_localize_script( 'magic-maps', 'scriptParams', $script_params );
	wp_enqueue_script( 'magic-maps' );
}
add_action( 'wp_enqueue_scripts', 'pass_data_to_script' );

Function bf_pass_data_to_script_admin_map(){

	$script_params = array(
	    'option_API_key' => get_option('googlemapsCode'),
	    'option_Map_Lat' => get_option('googlemapsLat'),
	    'option_Map_lng' => get_option('googleMapsLng'),
	    'option_Pin_Lat' => get_option('googlemapspinLat'),
	    'option_Pin_lng' => get_option('googlemapspinLng'),
	    'option_description' => get_option('placedescription'),
	    'option_zoom' => get_option('zoom'),
	    'enable_description' => get_option('enabledescription')
	);

	wp_localize_script( 'magic-maps', 'scriptParams', $script_params );
	wp_enqueue_script( 'magic-maps' );
}
add_action( 'admin_enqueue_scripts', 'bf_pass_data_to_script_admin_map' );