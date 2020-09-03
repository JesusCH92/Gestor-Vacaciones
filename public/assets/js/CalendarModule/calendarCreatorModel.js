var calendarCreatorModel = (function () {
    var createCalendar = function ({calendar, callback = console.log}) {
        $.ajax({
            type: 'POST',
            url: '/calendar/management/create/calendar',
            async: true,
            data: {calendar},
            success: function(data){
                callback(data);
            },
            error: function(data){
                console.log(JSON.parse(data.responseText));
            }
        });
    };

    return { 
        createCalendar : createCalendar
    }
});