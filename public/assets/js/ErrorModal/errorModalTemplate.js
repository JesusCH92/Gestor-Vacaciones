var errorModal = (function (){

    var paintErrorModal = function ({message_error}) {
        // $("#main-container").append(_modal);
        $("#modal-error-text").text(message_error);
        $("#modal-error").modal('show');
        // return _modal;
    };

    return {
        paintErrorModal : paintErrorModal
    }
});