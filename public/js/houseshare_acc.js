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
