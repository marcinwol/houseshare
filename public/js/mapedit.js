/**
 * This code is used only when user edits his/hers marker for an exhisting accommodation.
 * This is not used during adding new accommodation.
 * 
 */
$(function() {
    
    // get map div
    var mapDiv = document.getElementById("map");
    
    
    //get lat and lng of the address
    var addr_lat = $("#addr_lat").val();
    var addr_lng = $("#addr_lng").val();
    
    var city_lat = $("#city_lat").val();
    var city_lng = $("#city_lng").val();
   
   
    var latlng;
    // if no marker for a given address then use city's marker
    if (false == Boolean(addr_lat) || false == Boolean(addr_lng)) {
        // set city's coordinates
        latlng = new google.maps.LatLng(city_lat, city_lng);
    } else {
        latlng = new google.maps.LatLng(addr_lat, addr_lng);
    }

    // create the map
    var map = new google.maps.Map(mapDiv, {
        center: latlng,
        zoom: 16,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    
    
    // Creating a  marker and adding it to the map
    marker = new google.maps.Marker({
        map: map,
        draggable: true,
        position: latlng
    });
    
    
    
    // if user drags the marker, than update the hidden fields
    google.maps.event.addListener(marker, 'position_changed', function(event) {
        var wsp = marker.getPosition();              
        $('#addr_lat').val(wsp.lat());
        $('#addr_lng').val(wsp.lng());                
    });



    // get the address from the form
    var address = $("#address_for_geocoder").val();
      
      
    // Creating an InfoWindow with address of accommodation
    var infowindow = new google.maps.InfoWindow({
        content: address
    });
    
    
    // Adding a click event to the marker
    google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map, marker);
    });
      

//    // Creating a GeocoderRequest object
//    var geocoderRequest = {
//        address: address,
//        region: 'PL'
//    }   
//
//    // create geocoder object
//    var geocoder = new google.maps.Geocoder();
//    
//    // Making the Geocode request
//    geocoder.geocode(geocoderRequest, function(results, status) {
//        // Code that will handle the response
//      
//        // Check if status is OK before proceeding
//        if (status == google.maps.GeocoderStatus.OK) {
//            // Center the map on the returned location
//            map.setCenter(results[0].geometry.location);
//            map.setZoom(16);
//            // Check to see if we've already got a Marker object
//              
//            // Creating a new marker and adding it to the map
//            marker = new google.maps.Marker({
//                map: map,
//                draggable: true
//            });                    
//              
//            // Setting the position of the marker to the returned location
//            marker.setPosition(results[0].geometry.location);
//            
//            // set the position in the hidden form fields
//            var wsp = marker.getPosition();
//            
//        //     $('#lat').val(wsp.lat());
//        //    $('#lng').val(wsp.lng());
//            
//            
//           
//                    
//        } else {    
//    // if google cannot find the corrdinates for the given address            
//    //alert('Could not find the localization on the map');
//    }
//
//    });
    
    
    
});