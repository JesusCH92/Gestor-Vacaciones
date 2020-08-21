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

    var updateWorkDays = function ({workDays, callback = console.log}) {
        $.ajax({
            type: 'PUT',
            url: '/calendar/management/update/workDays',
            async: true,
            data: {workDays},
            success: function(data){
                callback(data);
            },
            error: function(data){
                console.log(data);
            }
        });
    };

    var updateTypeDayOffNumber = function ({typeDayOff, callback = console.log}) {
        $.ajax({
            type: 'PUT',
            url: '/calendar/management/typeDayOff',
            async: true,
            data: {typeDayOff},
            success: function(data){
                callback(data);
            },
            error: function(data){
                console.log(data);
            }
        });
    };

    var addFeastday = function({feastday, callback = console.log, container, deleteItem}) {
        $.ajax({
            type: 'POST',
            url: '/calendar/management/add/feastday',
            async: true,
            data: {feastday},
            success: function(data){
                callback({
                    feastdayContainer : container,
                    feastday : data.feastday_created
                });
                deleteItem.remove();
            },
            error: function(data){
                console.log(data);
            }
        });
    };

    return {
        getCalendarConfigByWorkingYear : getCalendarConfigByWorkingYear,
        updateDayOffRequest : updateDayOffRequest,
        updateWorkDays : updateWorkDays,
        updateTypeDayOffNumber : updateTypeDayOffNumber,
        addFeastday : addFeastday
    }
});