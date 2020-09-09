var companyModel = (function(){

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

    var editCompany = function({company, callback = console.log, id}) {
        $.ajax({
            type: 'POST',
            url: `/company/management/edit/${id}`,
            async: true,
            data: {company},
            success: function(data){
                callback(
                    data
                );
            },
            error: function(data){
                console.log(data);
            }
        });
    };

    return{
        createDepartment : createDepartment,
        editCompany : editCompany
    }
})();