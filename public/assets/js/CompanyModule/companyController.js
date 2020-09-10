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

    var _errorModal = errorModal();

    var paintDepartment = function( {containerDepartment, department} ) {
        containerDepartment.append(department);
    };

    var initEvents =  function(){

        $addDepartmentBtn.click( function(){
            var $departmentName = $departmentNameAdded.val().trim();
            var $departmentCode = $codeDepartmentAdded.val().trim();

            console.log($departmentName);
            console.log($departmentCode);

            if ($departmentName === "" || $departmentCode === "") {
                return;
            }

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
            console.log("don't push me!!");

            var $companyRename = $renameCompanyInput.val().trim();
            var $id = '1';  // * debe ser un string
            console.log($companyRename);

            if ($companyRename === "") {
                return;
            }

            companyModel.editCompany({
                company : {
                    name : $companyRename,
                    id : $id
                },
                id : $id,
                label : $companyNameLabel,
                callbackError : _errorModal.paintErrorModal()
            });
        });

        $departmentContainer.click( function () {
            if ( !$(event.target).hasClass($departmentNameBtnClass) ) {
                return;
            }
            var $departmentId = $(event.target).attr('deptId');
            var $departmentNameInput = $($departmentNameInputIdTag + $departmentId);
            if ( $departmentNameInput.val().trim() === "") {
                return;
            }
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
            if ( $departmentCodeInput.val().trim() === "" || $departmentCodeInput.val().trim().length > 10) {
                return;
            }
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