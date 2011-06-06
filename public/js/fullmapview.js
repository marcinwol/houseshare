/**
 * This code is used only when on accommodation/full-map-view.
 */
$(function() {
    
    // get map div
    var mapDiv = document.getElementById("map");
    var marker, markersArray=[];
    
    
    // default map center and zoom
    var mapCenterLat = 52.385459;
    var mapCenterLng = 19.131691;
    var mapZoom = 6;
    
    var cityLat = $('#cityLat').val();
    var cityLng = $('#cityLng').val();
    
    // if we look at city only, than cent its center and zoom
    if (cityLat && cityLng) {
        mapCenterLat = cityLat;
        mapCenterLng = cityLng;
        mapZoom = 12;
    }
        
    var  latlng = new google.maps.LatLng(mapCenterLat, mapCenterLng);

    // create the map
    var map = new google.maps.Map(mapDiv, {
        center: latlng,
        zoom: mapZoom,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    
    
   
    // mc = new MarkerClusterer(map,[], mcOptions);
    var markers = [];
    
    
    
    for(i=0; i<accData.length; i++)    {
        var acc = accData[i];
        marker = makeMarker(acc);
        markers.push(marker);
    }

  
    var style = [{
        url: '../images/m2.png',
        height: 53,
        width: 53,        
        textColor: '#000000',
        textSize: 12
    }];

    var mcOptions = {       
        maxZoom: 15
    };    
  
    
    var mc = new MarkerClusterer(map,markers, mcOptions);
    
    //    if(mc != null) {
    //        mc.clearMarkers();
    //    }
    //    
    //    mc.addMarkers(markers);



    
    function makeMarker(acc)  {
        
        var latlng = new google.maps.LatLng(acc.lat,acc.lng);
      
        var marker = new google.maps.Marker({
            position: latlng,
            map: map
        });
        
        // prepare the contents of the InfoWindow
        var info = "<div class=\"accInfoWindow\"><h1>"+acc.title+"</h1>";
        
        if (acc.thumbLink) {
            info += "<div class=\"infoImage\"><img src=\""+acc.thumbLink+"\" width=\"120px\"/></div>";  
        }
        info += "<div class=\"infoData\"><p>"+ acc.type+"</p><p>"+acc.price+"</p><p>"+acc.address+"</p>";      
        info += "<p>"+acc.created+"</p>"
        info += "<p class=\"read-more\">"+acc.link+"</p>"
        info += "</div>";
        info +="</div>";
        
       
        // Creating an InfoWindow with address of accommodation
        var infowindow = new google.maps.InfoWindow({
            content: info
        });
    
    
        // Adding a click event to the marker
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
        });  

        return marker;
    }

    


});
