/**
 * This code is used only when on accommodation/full-map-view.
 */
$(function() {
    
    // get map div
    var mapDiv = document.getElementById("map");
    var marker, markersArray=[];
    
    markersArray.push("51.144263,17.127253");
    markersArray.push("51.144262,17.127243");
    markersArray.push("51.144362,17.127143");
    markersArray.push("51.146362,17.125143");
    markersArray.push("51.144263,17.124253");
    markersArray.push("51.144262,17.127243");
    markersArray.push("51.145362,17.127143");
    markersArray.push("51.144562,17.125143");
    
    //get lat and lng of the address
    //var addr_lat = $("#addr_lat").val();
    //var addr_lng = $("#addr_lng").val();
    //var label = $(this).find('input#label').val();
        
    var  latlng = new google.maps.LatLng(52.385459, 19.131691);

    // create the map
    map = new google.maps.Map(mapDiv, {
        center: latlng,
        zoom: 6,
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
        url: '/../images/map/m1.png',
        height: 34,
        width: 33,
        anchor: [9,0],
        textColor: '#000000',
        textSize: 12
    }];
    
    var mcOptions = {       
        maxZoom: 15,
        style: style
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
        
        // Creating an InfoWindow with address of accommodation
        var infowindow = new google.maps.InfoWindow({
            content: acc.title
        });
    
    
        // Adding a click event to the marker
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
        });  
        
        // marker.txt=txt;
    
        //        google.maps.event.addListener(marker,"mouseover",function()   {
        //            infowindow.setContent(marker.txt);
        //            infowindow.open(map,marker);
        //        });
        
        return marker;
    }

    


});