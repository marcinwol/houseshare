/*
 * These JS is mainly used in accommodation views.
 * @author Marcin Wolski and Michal Chojcan
 */


$(document).ready(function () {
    $("#address-city").autocomplete({
        source: "/houseshare/public/index/getcities/nostate/1",
        select: function(event, ui){
            $("#address-city").val(ui.item.city_name);
            $('#address-state').val(ui.item.state_name);
        }
    });
    
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

    $("#address-state").autocomplete({
        source: "/houseshare/public/index/getstates",
        delay: 0,
        minLength: 2
    });

    $("#address-street_name").autocomplete({
        source: "/houseshare/public/index/getstreets",
        delay: 0,
        minLength: 2
    });

    $( "#basic_info-date_avaliable" ).datepicker({
        dateFormat: 'dd/mm/yy' 
    });
   
});
