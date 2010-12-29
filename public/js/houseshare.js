/* 
 * This is JavaScript for houseshare project.
 * @author Marcin Wolski and Michal Chojcan
 */


$(document).ready(function () {

    /**
     * This changes the text on a submit button on the main page
     * depending on whether you want to look for an accommodation
     * or you want to add you accommodation to the website.
     */
    $("input[name='rd_what_to_do']").change(function(){
        if ('1' == $(this).val()) {
            $('#submit').val('Add your accommodation');
        } else {
            $('#submit').val('Search for an accommodation');
        }
    });


   
    $("#i_city").autocomplete({
        source: "/houseshare/public/index/getcities"
    });

    $("#address-city").autocomplete({
        source: "/houseshare/public/index/getcities/nostate/1",
        select: function(event, ui){            
              $("#address-city").val(ui.item.city_name);
              $('#address-state').val(ui.item.state_name);
        }
    });

    $("#address-state").autocomplete({
        source: "/houseshare/public/index/getstates"
    });
  
});