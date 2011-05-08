$(function() { 
    
    var mapDiv = document.getElementById("map");
    
//    // wroclaw's coordinates
//    var latlng = new google.maps.LatLng(51.110851, 17.034302);
//    var options = {
//        center: latlng,
//        zoom: 13,
//        mapTypeId: google.maps.MapTypeId.ROADMAP
//    };
//    
//    // create the map
//    var map = new google.maps.Map(mapDiv, options);
//    
//    // Adding a marker to the map
//    var marker = new google.maps.Marker({
//        position: latlng,
//        map: map,
//        title: 'Wroclaw',
//         draggable: true
//    });

    // Creating an InfoWindow with the content text: "Hello World"
//    var infowindow = new google.maps.InfoWindow({
//        content: 'Wroclaw'
//    });
    
    // Adding a click event to the marker
 //   google.maps.event.addListener(marker, 'click', function() {
   //     infowindow.open(map, marker);
  //  });
  
  
  
    
    var geocoder;
    var marker;
    
    var getCoordinates = function(address) {
        // Check to see if we already have a geocoded object. If not we create one
        
        if(!geocoder) {
            geocoder = new google.maps.Geocoder();
        }
        
        // Creating a GeocoderRequest object
        var geocoderRequest = {
            address: address,
            region: 'PL'
        }
        
        // Making the Geocode request
        geocoder.geocode(geocoderRequest, function(results, status) {
            // Code that will handle the response
            // 
            // Check if status is OK before proceeding
            if (status == google.maps.GeocoderStatus.OK) {
                // Center the map on the returned location
                map.setCenter(results[0].geometry.location);
                
                // Check to see if we've already got a Marker object
                if (!marker) {
                    // Creating a new marker and adding it to the map
                    marker = new google.maps.Marker({
                        map: map,
                        draggable: true
                    });
                }

                // Setting the position of the marker to the returned location
                marker.setPosition(results[0].geometry.location);

            } else {
                alert('Could not find the localization on the map');
            }

        });

    }


    var address = $("#address-for-geocoder").val();

    getCoordinates(address);
        
});