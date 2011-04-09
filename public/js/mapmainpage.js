/**
 * This code is used only when on accommodation/show.
 */
$(function() {
    
    showMarker = function(map_lat,map_lng, map_zoom, pan) {
    
        var pan = pan || false;
        
        // get map div
        var mapDiv = document.getElementById("map");
   

        // create the map
        var map = new google.maps.Map(mapDiv, {
            center: new google.maps.LatLng(map_lat, map_lng),
            zoom: map_zoom,
            streetViewControl:false,
            mapTypeControl: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
    
        var marker;
    
        $('table#resent-adverts td').hover(function() {
            //var addr_lat = $(this).find('input#addr_lat').val();
            var lat_input = $(this).find('input#addr_lat');
            var lng_input = $(this).find('input#addr_lng');
        
            if (lat_input.length != 1 && lng_input.length != 1) {
                return;
            }
        
            var addr_lat = lat_input.val();
            var addr_lng = lng_input.val();
        
                
            var  latlng = new google.maps.LatLng(addr_lat, addr_lng);
        
            // Creating a  marker and adding it to the map
            marker = new google.maps.Marker({
                map: map,
                draggable: false,
                position: latlng
            });  
            
            // scroll the map to position of the marker
            if (pan) {
                map.panTo(latlng);
            }

        }, function() {      
        
            if(marker != null ) {
                marker.setVisible(false);
            }
        
        });
    
    };
  
    
});