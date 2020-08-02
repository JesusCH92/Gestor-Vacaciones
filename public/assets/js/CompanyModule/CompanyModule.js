var companyModule = (function(){
    var $addDepartmentBtn = $("#dpt-add-btn");
    var $departmentNameAdded = $("#department-name-added");
    var $codeDepartmentAdded = $("#code-department-added");

    var createDepartment = function({department, callback = console.log}) {
        $.ajax({
            type: 'POST',
            url: '/company/management/add/department',
            async: true,
            data: {department},
            success: function(data){
                // callback({departmentAdded: data.department_format});
                callback(data);
            }
        });
    };

    var initEvents =  function(){

        $addDepartmentBtn.click(function(){
            console.log('General Kenobi');
            var $departmentName = $departmentNameAdded.val().trim();
            var $departmentCode = $codeDepartmentAdded.val().trim();
            console.log($departmentName);
            console.log($departmentCode);

            createDepartment({
                department : {
                    name : $departmentName,
                    code : $departmentCode
                }
            })

        });
    }

    initEvents();
    
})();