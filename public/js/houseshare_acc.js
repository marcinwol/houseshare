/*
 * These JS is mainly used in accommodation views.
 * @author Marcin Wolski
 */


$(document).ready(function () {
    
    $("form#main-search-form").jqTransform();
    // $("form").jqTransform();
    
    $('.description').click(function() {
        var descrID = $(this).attr('for')            
        $('#'+descrID).toggle('slow');
    });        
        
    
   
    var defaultMaxPrice =  $( "#maxpricedefault" ).val();
          
    $( "#slider" ).slider({
        range: "min",
        value: defaultMaxPrice,
        min: 200,
        max: 3000,
        step: 100,
        slide: function( event, ui ) {          
            $( "#maxprice" ).val( ui.value );
        }
    });
    $( "#limit-form #maxprice" ).val(  $( "#slider" ).slider( "value" ) );


    // set language for the datepicker and form
    $("#basic_info-date_avaliable").datepicker($.datepicker.regional[myGlobals['lang']]);
    $( "#basic_info-date_avaliable" ).datepicker({ 
        dateFormat: 'dd/mm/yy' 
    });

    
    
    if ($('#basic_info-acc_type').val() == "1") {
        $('#fieldset-room_features').hide();       
    }
    
    if ($('#basic_info-acc_type').val() == "1" || $('#basic_info-acc_type').val() == "2") {
        $('#appartment_details-element').hide();       
    }
    
    if ($('#basic_info-acc_type').val() == "3") {
        $('#roomates-element').hide();
        $('#room_features-element').hide();
        $('#acc_features-element').hide();
    } 
        
    
    $('#basic_info-acc_type').change(function() {
        if ($(this).val() == "1") {
            $('#fieldset-room_features').hide();
            $('#appartment_details-element').hide();          
        } else if ($(this).val() == "2") {
            $('#fieldset-room_features').show();
            $('#appartment_details-element').hide();          
        } else if ($(this).val() == "3") {
            $('#roomates-element').hide();
            $('#room_features-element').hide();
            $('#acc_features-element').hide();
            $('#appartment_details-element').show();          
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
    
    
    $("#address-city").autocomplete({
        source: myGlobals['baseUrl'] + "/index/getcities/nostate/1",
        delay: 0,
        minLength: 2,
        select: function(event, ui){
            $("#address-city").val(ui.item.city_name);
            $('#address-state').val(ui.item.state_name);
        }
    });
    
    
    $("#address-street_name").autocomplete({
        source: myGlobals['baseUrl'] + "/index/getstreets",
        delay: 0,
        minLength: 2
    });


    
    // JQTIP 
    
    
    var addQtip = function(elemId, qtipContent) {
        $('#'+elemId).qtip({
            content: qtipContent,
            show: {
                when: {
                    event: 'focus'
                }
            },
            hide: {
                when: {
                    event: 'blur'
                }
            },
            position: {
                corner: {
                    target: 'topRight',
                    tooltip: 'bottomLeft'
                }
            },
            style: {
                width: 200, 
                padding: 5, 
                'font-size': '10px',
                'font-family': 'Verdana', 
                textAlign: 'center', 
                tip: 'bottomLeft',
                border: {
                    width: 2, 
                    radius: 1, 
                    color: 'orange'
                }
            }
        });
    };
    
    // addQtip("basic_info-title",  'Kontaktowy numer telefonu.');
   
   
    $('input[tooltip], textarea[tooltip] ').each(function()  {        
        $(this).qtip({
            content: $(this).attr('tooltip'), // Use the tooltip attribute of the element for the content     
            position: {
                corner: {
                    target: 'topMiddle',
                    tooltip: 'bottomMiddle'
                }
            },
            style: {
                width: 400, 
                padding: 5, 
                'font-size': '10px',
                'font-family': 'Verdana', 
                textAlign: 'center', 
                tip: 'bottomMiddle',
                border: {
                    width: 2, 
                    radius: 1, 
                    color: 'orange'
                }
            }
        });
    });
    
    
    //make shortcut function for charsLeft jquery plugion
   
    myCharsLeft = function(textAreaId, length) { 
        
        var length = typeof(length) != 'undefined' ? length : 150;
        var id = textAreaId + '-charsLeft';
        
        var html = '<p class="charsLeft">'
                    +myGlobals['charPrefix']
                    +' <span id="'
                    +id+'"></span>&nbsp;'
                    +myGlobals['charSuffix']+'</p>';
                
        $('#' + textAreaId).after(html);
        $('#' + textAreaId).limit(length.toString(),'#'+id);
        
    };
    
    
});