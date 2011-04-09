/**
 * This code is used only when on accommodation/show.
 */
$(function() {
    
    // get map div
    var mapDiv = document.getElementById("map");
    
    
    //get lat and lng of the address
    var addr_lat = $("#addr_lat").val();
    var addr_lng = $("#addr_lng").val();

    var  latlng = new google.maps.LatLng(addr_lat, addr_lng);

    // create the map
    var map = new google.maps.Map(mapDiv, {
        center: latlng,
        zoom: 16,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    
    
    // Creating a  marker and adding it to the map
    marker = new google.maps.Marker({
        map: map,
        draggable: false,
        position: latlng
    });
    
    
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