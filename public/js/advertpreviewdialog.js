/**
 * This code is used only when on accommodation/show.
 */
$(function() {


    var previewDialogTitle = $('input#previewDialogTitle').val();
    var readMoreButtonLabel = $('input#readMoreButtonLabel').val();
    var closeButtonLabel = $('input#closeButtonLabel').val();

    var previewDialog = function(aID, divID, baseUrl, previewUrl, fullUrl){
        //define config object
        var dialogOpts = {
            title: previewDialogTitle,
            modal: false,
            autoOpen: false,
            height: 500,
            width: 600,
            open: function() {
                //display correct dialog content
                $(divID).empty().html('<div style="width:100%"> <img class="loadingimg" src="'+baseUrl+'images/loading2.gif" /></div>');
                $(divID).load(previewUrl);               
            },
            buttons: [
                {
                text: readMoreButtonLabel,
                click: function() {
                    $(divID).dialog( "close" );
                    window.location = fullUrl;
                }
                },
                {
                text: closeButtonLabel,                
                click: function() {
                    $(divID).dialog( "close" );
                    return false;
                }
                }
                
            ]
        };
        $(divID).dialog(dialogOpts);    //end dialog
    
        $(aID).click(
            function (){
                $(divID).dialog("open");
                return false;
            }
            );

    }    
            
           
    
    $('table#resent-adverts td').each(function(index) {
        //var addr_lat = $(this).find('input#addr_lat').val();
        var acc_id = $(this).find('input#acc_id').val();
        var baseUrl = $(this).find('input#baseUrl').val();    
        var accUrl = $(this).find('input#accUrl').val();    
            
        var aID = "#aID"+acc_id;
        var dialogDiv = "#dialogDiv"+acc_id;
        var previewUrl = baseUrl+'accommodation/preview/id/'+acc_id;
      //  var fullUrl = baseUrl+'accommodation/show/id/'+acc_id;
                          
        previewDialog(aID,dialogDiv, baseUrl, previewUrl, accUrl);

    });
           

    
});