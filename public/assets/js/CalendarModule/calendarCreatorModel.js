var calendarCreatorModel = (function () {
    var createCalendar = function ({calendar, callback = console.log, callbackError = console.log}) {
        $.ajax({
            type: 'POST',
            url: '/calendar/management/create/calendar',
            async: true,
            data: {calendar},
            success: function(data){
                callback();
            },
            error: function(data){
                callbackError({message_error: data.responseText});
            }
        });
    };

    return { 
        createCalendar : createCalendar
    }
});