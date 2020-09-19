var errorModal = (function (){

    var paintErrorModal = function ({ message_error, message_title = 'ERROR' }) {
        $(".modal-title").text(message_title);
        $("#modal-error-text").text(message_error);
        $("#modal-error").modal('show');
    };

    var paintSuccessModal = function ({ message, message_title }) {
        $(".modal-title").text(message_title);
        $("#modal-error-text").text(message);
        $("#modal-error").modal('show');
    };

    return {
        paintErrorModal : paintErrorModal,
        paintSuccessModal : paintSuccessModal
    }
});