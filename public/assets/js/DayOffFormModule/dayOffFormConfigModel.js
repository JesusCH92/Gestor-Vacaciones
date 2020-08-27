var dayOffFormConfigModel = (function() {

    var saveDayOffFormRequest = function ({dayOff, callback = console.log}) {
        $.ajax({
            type: 'POST',
            url: '/dayoff/management/add',
            async: true,
            data: {dayOff},
            success: function(data){
                callback(data);
            },
            error: function(data){
                console.log(JSON.parse(data.responseText));
            }
        });
    };

    var getCalendarConfigByWorkingYear = function ({id, callback = console.log, container}) {
        $.ajax({
            type: 'GET',
            url: `/dayoff/${id}`,
            async: true,
            dataType: "json",
            success: function(data){
                callback({dayoffConfigContainer : container, dayoffConfig : data.dayoff_config, calendarId: id});
            },
            error: function(data){
                console.log(data);
            }
        });
    };

    return {
        getCalendarConfigByWorkingYear : getCalendarConfigByWorkingYear,
        saveDayOffFormRequest : saveDayOffFormRequest
    }
});