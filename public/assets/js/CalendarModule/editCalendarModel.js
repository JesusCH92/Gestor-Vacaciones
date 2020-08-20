var editCalendarModel = (function() {
    var getCalendarConfigByWorkingYear = function ({id, callback = console.log, container}) {
        $.ajax({
            type: 'GET',
            url: `/calendar/management/config/${id}`,
            async: true,
            dataType: "json",
            success: function(data){
                callback({calendarConfigContainer : container, calendarConfig : data.calendar_config, calendarId: id});
            },
            error: function(data){
                console.log(data);
            }
        });
    };

    var updateDayOffRequest = function ({dayOffRequest, callback = console.log}) {
        $.ajax({
            type: 'PUT',
            url: '/calendar/management/dayoffrequest',
            async: true,
            data: {dayOffRequest},
            success: function(data){
                callback(data);
            },
            error: function(data){
                console.log(data);
            }
        });
    };

    return {
        getCalendarConfigByWorkingYear : getCalendarConfigByWorkingYear,
        updateDayOffRequest : updateDayOffRequest
    }
});