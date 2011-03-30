$(function() { 
    var mapDiv = document.getElementById("map");
    console.log(mapDiv);
    // wroclaw's coordinates
    var latlng = new google.maps.LatLng(51.110851, 17.034302);
    var options = {
        center: latlng,
        zoom: 11,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    
    // create the map
    var map = new google.maps.Map(mapDiv, options);
    
    // Adding a marker to the map
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        title: 'Wroclaw'
    });

    // Creating an InfoWindow with the content text: "Hello World"
    var infowindow = new google.maps.InfoWindow({
        content: 'Wroclaw'
    });
    
    // Adding a click event to the marker
     google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
    });


        
});