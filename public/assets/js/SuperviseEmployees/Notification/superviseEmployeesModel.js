var superviseEmployeesModel = (function() {

    var getDayOffFormByUser = function ({dayOffRequest, callback = console.log, container}) {
        console.log({dayOffRequest});
        $.ajax({
            type: 'GET',
            url: `/notification/list/employees/dayoff/${dayOffRequest}`,
            async: true,
            data: {dayOffRequest},
            success: function(data){
                callback({notificationContainer : container, dayoffConfig : data.dayoff_config});
            },
            error: function(data){
                console.log(data);
            }
        });
    };

    /*var getDayOffFormByUser = function (userId, dayOffFormId, callback = console.log) {
        $.ajax({
            type: 'GET',
            url: '/notification/list/employees/dayoff',
            async: true,
            data: {day_off_request : {
                id_user: userId,
                id_day_off_form: dayOffFormId
                }
            },
            success: function(data){
                callback(data);
            },
            error: function(data){
                console.log(data);
            }
        });
    };

     */
    return {
        getDayOffFormByUser : getDayOffFormByUser
    }
});