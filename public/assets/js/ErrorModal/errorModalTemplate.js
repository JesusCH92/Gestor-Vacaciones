var errorModal = (function (){

    var paintErrorModal = function ({ message_error, message_title = 'ERROR' }) {
        if ( $("#modal-content").hasClass("modal--success-container") ) {
            $("#modal-content").removeClass("modal--success-container");
        }

        if ( $("#modal-button").hasClass("btn-success") ) {
            $("#modal-button").removeClass("btn-success");
        }

        if ( !$("#modal-button").hasClass("btn-danger") ) {
            $("#modal-button").addClass("btn-danger");
        }

        $(".modal-title").text(message_title);
        $("#modal-error-text").text(message_error);
        $("#modal-error").modal('show');
    };

    var paintSuccessModal = function ({ message, message_title }) {
        if ( !$("#modal-content").hasClass("modal--success-container") ) {
            $("#modal-content").addClass("modal--success-container");
        }

        if ( $("#modal-button").hasClass("btn-danger") ) {
            $("#modal-button").removeClass("btn-danger");
        }

        if ( !$("#modal-button").hasClass("btn-success") ) {
            $("#modal-button").addClass("btn-success");
        }

        $(".modal-title").text(message_title);
        $("#modal-error-text").text(message);
        $("#modal-error").modal('show');
    };

    return {
        paintErrorModal : paintErrorModal,
        paintSuccessModal : paintSuccessModal
    }
});