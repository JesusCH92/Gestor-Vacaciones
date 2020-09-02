var daysOffModel = (function() {

    var getDayOffFormByDepartment = function ({filterEmployeesCorpus, callback = console.log, container}) {
        $.ajax({
            type: 'GET',
            url: `/supervise/management/employees`,
            async: true,
            data: {filterEmployeesCorpus},
            success: function(data){
                //callback(data);
                callback({filterUserDayOff : container, dayoffConfig : data.dayoff_config});
            },
            error: function(data){
                console.log(data);
            }
        });
    };

    return {
        getDayOffFormByDepartment : getDayOffFormByDepartment
    }
});