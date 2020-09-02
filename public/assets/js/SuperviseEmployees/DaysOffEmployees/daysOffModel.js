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

    var getCalendarWithUserInDayOffByCurrentYear = function ( { id, callback = console.log, container} ) {
        $.ajax({
            type: 'GET',
            url: `/supervise/dayoff/user/${id}`,
            async: true,
            dataType: "json",
            success: function(data){
                callback({calendarContainer : container, calendar : data.user_dayoff_calendar});
            },
            error: function(data){
                console.log(data);
            }
        });
    };

    return {
        getDayOffFormByDepartment : getDayOffFormByDepartment,
        getCalendarWithUserInDayOffByCurrentYear : getCalendarWithUserInDayOffByCurrentYear
    }
});