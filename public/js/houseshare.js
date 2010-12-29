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


    /**
    * This toglles 'Add a new city' fieldset display regarding
    * checkbox with id="address-new_public".
    */
    $("#address-new_public").change(function(){
        if (true == $(this).attr('checked')) {
            $('#fieldset-new_city').show();
        } else {
            $('#fieldset-new_city').hide();
        }
      
    });


    var ac_config = {
        source: "/houseshare/public/index/getcities",
        select: function(event, ui){          
            $("#i_city").val(ui.item.value);
          //  $('#h_city_id').val(ui.item.city_id);
        },
        minLength:1
    };
    $("#i_city").autocomplete(ac_config);


  
});