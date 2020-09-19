var calendarCreatorModel = (function () {
    var createCalendar = function ({calendar, callback = console.log, callbackError = console.log, successModal = console.log}) {
        $.ajax({
            type: 'POST',
            url: '/calendar/management/create/calendar',
            async: true,
            data: {calendar},
            success: function(data){
                callback();
                successModal({
                    message : `The ${calendar['workingYear']} calendar was created successfully`,
                    message_title : 'Calendar Created'
                });
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