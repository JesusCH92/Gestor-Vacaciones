var companyRenderTemplate =  ( function () {
    var $departmentNameAdded = $("#department-name-added");
    var $codeDepartmentAdded = $("#code-department-added");

    var paintErrorMessage = function ({ errorId, errorMessage = 'Is not valid' }) {
        errorId.find(".form-error-message").text(errorMessage);
        errorId.fadeIn();
    };

    var removeErrorMessage = function ({ errorId }) {
        errorId.fadeOut();
    };

    var paintDepartment = function ( { containerDepartment, department } ) {
        containerDepartment.append(department);

        cleanInputs($departmentNameAdded, $codeDepartmentAdded);
    };

    var cleanInputs = function ( ...inputs ) {
        $.each(inputs, function (index, input) {
            input.val("");
        });
    };

    return {
        paintErrorMessage : paintErrorMessage,
        removeErrorMessage : removeErrorMessage,
        paintDepartment : paintDepartment,
        cleanInputs : cleanInputs
    }
});