var companyModel = (function(){
    // var $departmentContainer = $("#departments-container");

    var createDepartment = function({department, callback = console.log, container}) {
        $.ajax({
            type: 'POST',
            url: '/company/management/add/department',
            async: true,
            data: {department},
            success: function(data){
                callback({
                    containerDepartment : container,
                    department : data.department_created
                });
            },
            error: function(data){
                console.log(data);
            }
        });
    };

    return{
        createDepartment : createDepartment
    }
})();