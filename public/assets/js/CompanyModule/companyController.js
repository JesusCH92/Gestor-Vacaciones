var companyController = (function(){
    var $addDepartmentBtn = $("#dpt-add-btn");
    var $departmentNameAdded = $("#department-name-added");
    var $codeDepartmentAdded = $("#code-department-added");
    var $departmentContainer = $("#departments-container");

    var paintDepartment = function( {containerDepartment, department} ) {
        containerDepartment.append(department);
    };

    var initEvents =  function(){

        $addDepartmentBtn.click(function(){
            console.log('General Kenobi');
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
                container : $departmentContainer
            });

        });
    };

    initEvents();
    
})();