/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function responseOutput(responseArray)
{
    responseArray = $.parseJSON(responseArray);
    
    var output = '<ul class="alert-box-ul" id="ajax-alert-box-ul">';
    
    if (typeof responseArray['rates'] != "undefined") {
        $.each(responseArray['rates'], function( index, value ) {
            output += '<li class="rates-list">' + value + '</li>';
        });  
    }
    if (typeof responseArray['alert'] != "undefined") {
        $.each(responseArray['alert'], function( index, value ) {
            output += '<li class="alert-list">' + value + '</li>';
        });
    }
    if (typeof responseArray['notice'] != "undefined") {
        $.each(responseArray['notice'], function( index, value ) {
            output += '<li class="notice-list">' + value + '</li>';
        });
    }
    
    output += '</ul>';
    
    return output;
}

// Variable to hold request
var request;

//$("#ajax-alert-box").html('<img src="assets/images/ajax-loader_1.gif"/>');

// Bind to the submit event of our form
$("[name='currencyForm']").submit(function(event){
    
    /* Clear result div*/
    $("#ajax-alert-box").html('');

    // Abort any pending request
    if (request) {
        request.abort();
    }
    // setup some local variables
    var $form = $(this);

    // Let's select and cache all the fields
    var $inputs = $form.find("input, select, button, textarea");

    // Serialize the data in the form
    var serializedData = $form.serialize();
    
    console.log(serializedData);

    // Let's disable the inputs for the duration of the Ajax request.
    // Note: we disable elements AFTER the form data has been serialized.
    // Disabled form elements will not be serialized.
    $inputs.prop("disabled", true);

    // Fire off the request to /form.php
    request = $.ajax({
        url: "/",
        type: "post",
        data: serializedData,
        beforeSend: function(){
           $("#ajax-alert-box").html('<div class="spinner"></div>');
        }
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        response = responseOutput(response);

        // Log a message to the console
        $("#ajax-alert-box").html(response);
        console.log("Response: "+response);
        //console.log("Hooray, it worked!");
    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        var errMsg = '<ul class="alert-box-ul" id="ajax-alert-box-ul">';
            errMsg += '<li class="alert-list">The following error occurred: ' 
            errMsg += textStatus + ', '+ errorThrown
            errMsg += '</li>';
            errMsg += '</ul>';
        
        $("#ajax-alert-box").html(errMsg);
        // Log the error to the console
        //console.error(errMsg);
    });

    // Callback handler that will be called regardless
    // if the request failed or succeeded
    request.always(function () {
        // Reenable the inputs
        $inputs.prop("disabled", false);
    });

    // Prevent default posting of form
    event.preventDefault();
});


