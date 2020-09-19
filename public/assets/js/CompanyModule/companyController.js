var companyController = (function(){
    var $addDepartmentBtn = $("#dpt-add-btn");
    var $departmentNameAdded = $("#department-name-added");
    var $codeDepartmentAdded = $("#code-department-added");
    var $departmentContainer = $("#department--container");
    var $editCompanyBtn = $("#edit-company-name-btn");
    var $renameCompanyInput = $("#company-rename-input");
    var $companyNameLabel = $("#company--name__label");
    var $departmentNameBtnClass = "department--name-btn";
    var $departmentNameInputIdTag = "#department--name-input-";
    var $departmentNameLabelIdTag = "#department--name-label-";
    var $departmentCodeBtnClass = "department--code-btn";
    var $departmentCodeInputIdTag = "#department--code-input-";
    var $departmentCodeLabelIdTag = "#department--code-label-";
    var $companyNameErrorSpan = $("#company-name-error-span");
    var $departmentCodeErrorSpan = $("#code-department-added-error-span");
    var $departmentNameErrorSpan = $("#department-name-added-error-span");
    var $departmentNameErrorSpanIdTag = "#department--name-error-span-";
    var $departmentCodeErrorSpanIdTag = "#department--code-error-span-";


    var _errorModal = errorModal();
    var _validator = validator();
    var _companyRenderTemplate = companyRenderTemplate();

    var paintDepartment = function( {containerDepartment, department} ) {
        containerDepartment.append(department);
    };

    var initEvents =  function(){

        $addDepartmentBtn.click( function(){
            var $departmentName = $departmentNameAdded.val().trim();
            var $departmentCode = $codeDepartmentAdded.val().trim();

            if (_validator.isBlankInput({ input : $departmentName })) {
                _companyRenderTemplate.paintErrorMessage({
                    errorId : $departmentNameErrorSpan,
                    errorMessage : 'Department name must not be blank.'
                });
                return;
            }

            _companyRenderTemplate.removeErrorMessage({ errorId : $departmentNameErrorSpan });

            if (_validator.isBlankInput({ input : $departmentCode })) {
                _companyRenderTemplate.paintErrorMessage({
                    errorId : $departmentCodeErrorSpan,
                    errorMessage : 'Department code must not be blank.'
                });
                return;
            }

            if (_validator.isInputLengthGreaterThanTen({ input : $departmentCode })) {
                _companyRenderTemplate.paintErrorMessage({
                    errorId : $departmentCodeErrorSpan,
                    errorMessage : 'Department code must not be more than 10 characters.'
                });
                return;
            }
            _companyRenderTemplate.removeErrorMessage({ errorId : $departmentCodeErrorSpan });

            companyModel.createDepartment({
                department : {
                    name : $departmentName,
                    code : $departmentCode
                },
                callback : paintDepartment,
                container : $departmentContainer,
                callbackError : _errorModal.paintErrorModal
            });

        });

        $editCompanyBtn.click( function(){
            var $companyRename = $renameCompanyInput.val().trim();
            var $id = '1';  // * debe ser un string

            if (_validator.isBlankInput({ input : $companyRename })) {
                _companyRenderTemplate.paintErrorMessage({
                    errorId : $companyNameErrorSpan,
                    errorMessage : 'Company name must not be blank.'
                });
                return;
            }

            _companyRenderTemplate.removeErrorMessage({ errorId : $companyNameErrorSpan });

            companyModel.editCompany({
                company : {
                    name : $companyRename,
                    id : $id
                },
                id : $id,
                label : $companyNameLabel,
                callbackError : _errorModal.paintErrorModal
            });
        });

        $departmentContainer.click( function () {
            if ( !$(event.target).hasClass($departmentNameBtnClass) ) {
                return;
            }
            var $departmentId = $(event.target).attr('deptId');
            var $departmentNameInput = $($departmentNameInputIdTag + $departmentId);

            if (_validator.isBlankInput({ input : $departmentNameInput.val().trim() })) {
                _companyRenderTemplate.paintErrorMessage({
                    errorId : $($departmentNameErrorSpanIdTag + $departmentId),
                    errorMessage : 'Department name must not be blank.'
                });
                return;
            }

            _companyRenderTemplate.removeErrorMessage({ errorId : $($departmentNameErrorSpanIdTag + $departmentId) });

            var $departmentCorpus = {
                id : $departmentId,
                name : $departmentNameInput.val().trim()
            };

            companyModel.departmentNameUpdate({
                department : $departmentCorpus,
                label : $($departmentNameLabelIdTag + $departmentId),
                callbackError : _errorModal.paintErrorModal
            });
        });

        $departmentContainer.click( function () {
            if ( !$(event.target).hasClass($departmentCodeBtnClass) ) {
                return;
            }
            var $departmentId = $(event.target).attr('deptId');
            var $departmentCodeInput = $($departmentCodeInputIdTag + $departmentId);

            if (_validator.isBlankInput({ input : $departmentCodeInput.val().trim() })) {
                _companyRenderTemplate.paintErrorMessage({
                    errorId : $($departmentCodeErrorSpanIdTag + $departmentId),
                    errorMessage : 'Department code must not be blank.'
                });
                return;
            }

            if (_validator.isInputLengthGreaterThanTen({ input : $departmentCodeInput.val().trim() })) {
                _companyRenderTemplate.paintErrorMessage({
                    errorId : $($departmentCodeErrorSpanIdTag + $departmentId),
                    errorMessage : 'Department code must not be more than 10 characters.'
                });
                return;
            }
            _companyRenderTemplate.removeErrorMessage({ errorId : $($departmentCodeErrorSpanIdTag + $departmentId) });

            var $departmentCorpus = {
                id : $departmentId,
                code : $departmentCodeInput.val().trim()
            };

            companyModel.departmentCodeUpdate({
                department : $departmentCorpus,
                label : $($departmentCodeLabelIdTag + $departmentId),
                callbackError : _errorModal.paintErrorModal
            });
        });
    };

    initEvents();
    
})();