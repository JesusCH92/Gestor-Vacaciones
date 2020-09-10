var companyModel = (function(){

    var createDepartment = function({ department, callback = console.log, container }) {
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

    var editCompany = function({ company, callback = console.log, id, label }) {
        $.ajax({
            type: 'POST',
            url: `/company/management/edit/${id}`,
            async: true,
            data: {company},
            success: function(data){
                callback(
                    data
                );
                label.html(company['name']);
            },
            error: function(data){
                console.log(data);
            }
        });
    };

    var departmentNameUpdate = function ({ department, callback = console.log, label }) {
        $.ajax({
            type: 'POST',
            url: `/company/management/edit/department/name`,
            async: true,
            data: { department },
            success: function(data){
                callback(
                    data
                );
                label.text(department['name']);
            },
            error: function(data){
                console.log(data);
            }
        });
    };

    var departmentCodeUpdate = function ({ department, callback = console.log, label }) {
        $.ajax({
            type: 'POST',
            url: `/company/management/edit/department/code`,
            async: true,
            data: { department },
            success: function(data){
                callback(
                    data
                );
                label.text(department['code']);
            },
            error: function(data){
                console.log(data);
            }
        });
    };

    return{
        createDepartment : createDepartment,
        editCompany : editCompany,
        departmentNameUpdate : departmentNameUpdate,
        departmentCodeUpdate : departmentCodeUpdate
    }
})();