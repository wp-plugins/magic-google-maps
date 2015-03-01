(function(window, google) {

  // map options
  var options = {
    center: {
      lat: parseFloat(scriptParams.option_Map_Lat),
      lng: parseFloat(scriptParams.option_Map_lng)
    },
    zoom: parseInt(scriptParams.option_zoom),
    disableDefaultUI: false, 
  },
  
  element = document.getElementById('map-canvas1'),
  
  // map
  map = new google.maps.Map(element, options);

  var contentString = scriptParams.option_description;

  var infowindow = new google.maps.InfoWindow({
      content: contentString
  });

  var marker = new google.maps.Marker({
	  
	position: {
	lat: parseFloat(scriptParams.option_Pin_Lat),
	lng: parseFloat(scriptParams.option_Pin_lng)
  	},
    map: map,
    draggable:true
  });
  
  infowindow.open(map,marker);

   google.maps.event.addListener(marker, 'click', function()  {
    infowindow.open(map,marker);
  });
  google.maps.event.addListener(marker, 'dragend', function()  {
    document.getElementById("GoogleMapsLat").value = this.getPosition().lat();
    document.getElementById("GoogleMapsLng").value = this.getPosition().lng();
    document.getElementById("GoogleMapsPinLat").value = this.getPosition().lat();
    document.getElementById("GoogleMapsPinLng").value = this.getPosition().lng();
    
  });
  google.maps.event.addListener(map, 'zoom_changed', function()  {
    document.getElementById("Zoom").value = this.getZoom();
  });
}(window, google));