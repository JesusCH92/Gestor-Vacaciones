var daysOffModel = (function() {

    var getDayOffFormByDepartment = function ({filterEmployeesCorpus, callback = console.log, container, callbackError = console.log}) {
        $.ajax({
            type: 'GET',
            url: `/supervise/management/dayoff/employees/filter`,
            async: true,
            data: {filterEmployeesCorpus},
            success: function(data){
                callback({filterUserDayOff : container, dayoffConfig : data.dayoff_config});
            },
            error: function(data){
                callbackError({message_error: data.responseText});
            }
        });
    };

    var getCalendarWithUserInDayOffByCurrentYear = function ( { id, callback = console.log, container, callbackError = console.log} ) {
        $.ajax({
            type: 'GET',
            url: `/supervise/management/dayoff/user/${id}`,
            async: true,
            dataType: "json",
            success: function(data){
                callback({calendarContainer : container, calendar : data.user_dayoff_calendar});
            },
            error: function(data){
                callbackError({message_error: data.responseText});
            }
        });
    };

    return {
        getDayOffFormByDepartment : getDayOffFormByDepartment,
        getCalendarWithUserInDayOffByCurrentYear : getCalendarWithUserInDayOffByCurrentYear
    }
});