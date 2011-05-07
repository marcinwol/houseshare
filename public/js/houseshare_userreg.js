/*
 * These JS is mainly used in accommodation views.
 * @author Marcin Wolski
 */


$(document).ready(function () {
       
    
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
    
    
    
});
