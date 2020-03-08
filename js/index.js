$(document).ready(function(){
    $("#contact-form").on("beforeValidateAttribute", function (event, attribute, messages, deferreds) {
            console.log("Before ",messages);
        return true;
    });
});