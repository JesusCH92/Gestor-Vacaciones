var companyRenderTemplate =  ( function () {
    var paintErrorMessage = function ({ errorId, errorMessage = 'Is not valid' }) {
        errorId.find(".form-error-message").text(errorMessage);
        errorId.fadeIn();
    };

    var removeErrorMessage = function ({ errorId }) {
        errorId.fadeOut();
    };

    var paintDepartment = function( {containerDepartment, department} ) {
        containerDepartment.append(department);
    };

    return {
        paintErrorMessage : paintErrorMessage,
        removeErrorMessage : removeErrorMessage,
        paintDepartment : paintDepartment
    }
});