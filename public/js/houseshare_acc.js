/*
 * These JS is mainly used in accommodation views.
 * @author Marcin Wolski and Michal Chojcan
 */


$(document).ready(function () {
    
    
    $('.description').click(function() {
        var descrID = $(this).attr('for')            
        $('#'+descrID).toggle('slow');
    });        
        
    
    
    
    
    //    $("#address-city").autocomplete({
    //        source: "/houseshare/public/index/getcities/nostate/1",
    //        select: function(event, ui){
    //            $("#address-city").val(ui.item.city_name);
    //            $('#address-state').val(ui.item.state_name);
    //        }
    //    });
    
    var defaultMaxPrice =  $( "#maxpricedefault" ).val();
          
    $( "#slider" ).slider({
        range: "min",
        value: defaultMaxPrice,
        min: 200,
        max: 2000,
        step: 50,
        slide: function( event, ui ) {          
            $( "#maxprice" ).val( ui.value );
        }
    });
    $( "#maxprice" ).val(  $( "#slider" ).slider( "value" ) );


    
    
    if ($('#basic_info-acc_type').val() == "1") {
        $('#fieldset-room_features').hide();
    }
    
    $('#basic_info-acc_type').change(function() {
        if ($(this).val() == "1") {
            $('#fieldset-room_features').hide();
        } else if ($(this).val() == "2") {
            $('#fieldset-room_features').show();
        }
    });

    
     function monkeyPatchAutocomplete() {

        // don't really need this, but in case I did, I could store it and chain
        var oldFn = $.ui.autocomplete.prototype._renderItem;
        
        $.ui.autocomplete.prototype._renderItem = function( ul, item) {
            var re = new RegExp(this.term, "ig") ;
            var t = item.label.replace(re,"<span style='font-weight:bold;'>" + 
                "$&" + 
                "</span>");
            
            return $( "<li></li>" )
            .data( "item.autocomplete", item )
            .append( "<a>" + t + "</a>" )
            .appendTo( ul );
        };
    }
    
    
    
    monkeyPatchAutocomplete();
    
    
    //    $("#address-city").autocomplete({
    //        source: "/houseshare/public/index/getcities/nostate/1",
    //        select: function(event, ui){
    //            $("#address-city").val(ui.item.city_name);
    //            $('#address-state').val(ui.item.state_name);
    //        }
    //    });
    
    $.get('/houseshare/public/index/getcities/nostate/1', function(cities) {
        //console.log(streets.length);
        //    console.log(streets[0]);

        
        $("#address-city").autocomplete( {            
            delay: 0,
            minLength: 1,
            source: function(request, response){
                var matches = new Array();
                var needle = request.term.toLowerCase();
                var len = cities.length;
                for(i = 0; i < len; ++i)   {
                    var haystack = cities[i].label.toLowerCase();
                    if(haystack.indexOf(needle) == 0 || haystack.indexOf(" " + needle) != -1)   {
                        matches.push(cities[i]);
                        if (matches.length > 10 ) {                           
                            break;
                        }
                    }
                }
                response(matches);
            },
            select: function(event, ui){
                $("#address-city").val(ui.item.city_name);
                $('#address-state').val(ui.item.state_name);
            }
            
        });
   
    }, 'json');
    
    
    $("#address-state").autocomplete({
        source: "/houseshare/public/index/getstates",
        delay: 0,
        minLength: 2
    });
    
    
    $.get('/houseshare/public/index/getstreets', function(streets) {
        //console.log(streets.length);
        //    console.log(streets[0]);

        
        $("#address-street_name").autocomplete( {            
            delay: 0,
            minLength: 1,
            source: function(request, response){
                var matches = new Array();
                var needle = request.term.toLowerCase();
                var len = streets.length;
                for(i = 0; i < len; ++i)   {
                    var haystack = streets[i].label.toLowerCase();
                    if(haystack.indexOf(needle) == 0 || haystack.indexOf(" " + needle) != -1)   {
                        matches.push(streets[i]);
                        if (matches.length > 10 ) {                           
                            break;
                        }
                    }
                }
                response(matches);
            }
        });
   
    }, 'json');
    
});
