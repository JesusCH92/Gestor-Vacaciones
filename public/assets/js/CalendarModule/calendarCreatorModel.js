var calendarCreatorModel = (function () {
    var createCalendar = function ({calendar, callback = console.log, callbackError = console.log}) {
        $.ajax({
            type: 'POST',
            url: '/calendar/management/create/calendar',
            async: true,
            data: {calendar},
            success: function(data){
                callback(data);
            },
            error: function(data){
                callbackError({message_error: JSON.parse(data.responseText).message});
            }
        });
    };

    return { 
        createCalendar : createCalendar
    }
});