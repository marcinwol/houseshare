/* 
 * This is JavaScript for houseshare project.
 * @author Marcin Wolski and Michal Chojcan
 */


$(document).ready(function () {
    
    $('form input.help, form textarea.help').formtips({ 
        tippedClass: 'tipped'
    });
    
       
    /**
     * This changes the text on a submit button on the main page
     * depending on whether you want to look for an accommodation
     * or you want to add you accommodation to the website.
     */
    $("input[name='rd_what_to_do']").change(function(){
        if ('1' == $(this).val()) {
            $('#submit').val('Add your accommodation');
            $( "#maxprice-element" ).hide();
        } else {
            $('#submit').val('Search for an accommodation');
            $( "#maxprice-element" ).show();
        }
    });
    
    $( "#slider" ).slider({
        range: "min",
        value:800,
        min: 200,
        max: 2000,
        step: 50,
        slide: function( event, ui ) {          
            $( "#maxprice" ).val( ui.value );
        }
    });
    $( "#maxprice" ).val(  $( "#slider" ).slider( "value" ) );


   
    $("#i_city").autocomplete({
        source: "/houseshare/public/index/getcities",
        delay: 0,
        minLength: 2
    });
    
      

  
});