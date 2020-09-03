var dayOffFormConfigModel = (function() {

    var saveDayOffFormRequest = function ({day_off_request, callback = console.log}) {
        $.ajax({
            type: 'POST',
            url: '/dayoff/request/management/add',
            async: true,
            data: {day_off_request},
            success: function(data){
                callback(data);
                location.reload();
            },
            error: function(data){
                console.error(JSON.parse(data.responseText));
            }
        });
    };

    var getCalendarConfigByWorkingYear = function ({id, callback = console.log, container}) {
        $.ajax({
            type: 'GET',
            url: `/dayoff/request/${id}`,
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