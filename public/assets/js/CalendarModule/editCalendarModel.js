var editCalendarModel = (function() {

    var getCalendarConfigByWorkingYear = function ({id, callback = console.log, container, callbackError = console.log}) {
        $.ajax({
            type: 'GET',
            url: `/calendar/management/config/${id}`,
            async: true,
            dataType: "json",
            success: function(data){
                callback({calendarConfigContainer : container, calendarConfig : data.calendar_config, calendarId: id});
            },
            error: function(data){
                //console.log(data.responseJSON.message);
                callbackError({message_error: JSON.parse(data.responseText).message});
                //console.log(data);
            }
        });
    };

    var updateDayOffRequest = function ({dayOffRequest, callback = console.log, callbackError = console.log}) {
        $.ajax({
            type: 'PUT',
            url: '/calendar/management/dayoffrequest',
            async: true,
            data: {dayOffRequest},
            success: function(data){
                callback(data);
            },
            error: function(data){
                callbackError({message_error: JSON.parse(data.responseText).message});
                console.log(JSON.parse(data.responseText).message);
            }
        });
    };

    var updateWorkDays = function ({workDays, callback = console.log, callbackError = console.log}) {
        $.ajax({
            type: 'PUT',
            url: '/calendar/management/update/workDays',
            async: true,
            data: {workDays},
            success: function(data){
                callback(data);
            },
            error: function(data){
                callbackError({message_error: JSON.parse(data.responseText).message});
            }
        });
    };

    var updateTypeDayOffNumber = function ({typeDayOff, callback = console.log, callbackError = console.log}) {
        $.ajax({
            type: 'PUT',
            url: '/calendar/management/typeDayOff',
            async: true,
            data: {typeDayOff},
            success: function(data){
                callback(data);
            },
            error: function(data){
                callbackError({message_error: JSON.parse(data.responseText).message});
            }
        });
    };

    var addFeastday = function ({feastday, callback = console.log, container, deleteItem, callbackError = console.log}) {
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
                callbackError({message_error: JSON.parse(data.responseText).message});
            }
        });
    };

    var deleteFeastday =  function ({feastday, callback = console.log, deleteItem, callbackError = console.log}) {
        $.ajax({
            type: 'DELETE',
            url: '/calendar/management/delete/feastday',
            async: true,
            data: {feastday},
            success: function(data){
                callback(data);
                deleteItem.remove();
            },
            error: function(data){
                callbackError({message_error: JSON.parse(data.responseText).message});
            }
        });
    };

    return {
        getCalendarConfigByWorkingYear : getCalendarConfigByWorkingYear,
        updateDayOffRequest : updateDayOffRequest,
        updateWorkDays : updateWorkDays,
        updateTypeDayOffNumber : updateTypeDayOffNumber,
        addFeastday : addFeastday,
        deleteFeastday : deleteFeastday
    }
});