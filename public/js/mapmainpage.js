/**
 * This code is used only when on accommodation/show.
 */
$(function() {
    
    // get map div
    var mapDiv = document.getElementById("map");
   

    // create the map
    var map = new google.maps.Map(mapDiv, {
        center: new google.maps.LatLng(52.025459, 19.131691),
        zoom: 5,
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
    }, function() {      
        
        if(marker != null ) {
            marker.setVisible(false);
        }
        
    });
    
//    // Creating a  marker and adding it to the map
//    marker = new google.maps.Marker({
//        map: map,
//        draggable: false,
//        position: latlng
//    });
//    
    
//    // get the address from the form
//    var address = $("#address_for_geocoder").val();
//      
//      
//    // Creating an InfoWindow with address of accommodation
//    var infowindow = new google.maps.InfoWindow({
//        content: address
//    });
//    
//    
//    // Adding a click event to the marker
//    google.maps.event.addListener(marker, 'click', function() {
//        infowindow.open(map, marker);
//    });
//      
  
    
});