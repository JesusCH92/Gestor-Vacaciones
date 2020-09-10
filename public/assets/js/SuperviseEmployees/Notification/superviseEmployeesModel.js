var superviseEmployeesModel = (function() {

    var getDayOffFormByUser = function ({dayOffFormId, callback = console.log, container, callbackError = console.log}) {
        $.ajax({
            type: 'GET',
            url: `/supervise/management/notification/employees/dayoff/${dayOffFormId}`,
            async: true,
            success: function(data){
                callback({employeeInfo : container, dayoffConfig : data.dayoff_config});
            },
            error: function(data){
                callbackError({message_error: JSON.parse(data.responseText).message});
            }
        });
    };
    var approveDayOffformRequest = function ({day_off, callback = console.log, callbackError = console.log}) {
        $.ajax({
            type: 'POST',
            url: '/supervise/management/notification/approve',
            async: true,
            data: {day_off},
            success: function(data){
                //window.location.replace("http://localhost:8080/notification/list/employees");
                location.reload();
                callback(data);
            },
            error: function(data){
                callbackError({message_error: JSON.parse(data.responseText).message});
            }
        });
    };
    var denyDayOffformRequest = function ({day_off, callback = console.log, callbackError = console.log}) {
        $.ajax({
            type: 'POST',
            url: '/supervise/management/notification/deny',
            async: true,
            data: {day_off},
            success: function(data){
                //window.location.replace("http://localhost:8080/notification/list/employees");
                location.reload();
                callback(data);
            },
            error: function(data){
                callbackError({message_error: JSON.parse(data.responseText).message});
            }
        });
    };

    return {
        getDayOffFormByUser : getDayOffFormByUser,
        approveDayOffformRequest : approveDayOffformRequest,
        denyDayOffformRequest : denyDayOffformRequest
    }
});