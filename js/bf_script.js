(function(window, google) {

  // map options
  var options = {
    center: {
      lat: parseFloat(scriptParams.option_Map_Lat),
      lng: parseFloat(scriptParams.option_Map_lng)
    },
    zoom: parseInt(scriptParams.option_zoom),
    disableDefaultUI: true, 
  },
  
  element = document.getElementById('map-canvas2'),
  
  // map
  map = new google.maps.Map(element, options);

  var contentString = scriptParams.option_description;
  var infowindow = new google.maps.InfoWindow({
      content: contentString
  });
  var enableInfowindow = scriptParams.enable_description;
  
 
  var marker = new google.maps.Marker({
	  
	position: {
	lat: parseFloat(scriptParams.option_Pin_Lat),
	lng: parseFloat(scriptParams.option_Pin_lng)
  	},
    map: map
  });
  if (enableInfowindow =="1" ){
  infowindow.open(map,marker);
  }
   /*
google.maps.event.addListener(marker, 'click', function()  {
    infowindow.open(map,marker);
  });
*/
}(window, google));