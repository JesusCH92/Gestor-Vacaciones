var dayOffFormConfigModel = (function() {

    var saveDayOffFormRequest = function ({day_off_request, callback = console.log, callbackError = console.log, successModal = console.log}) {
        $.ajax({
            type: 'POST',
            url: '/dayoff/request/management/add',
            async: true,
            data: {day_off_request},
            success: function(data){
                successModal({
                    message : `${ JSON.parse(day_off_request['days_off']).length } days were request successfully`,
                    message_title : 'Day Off Request'
                });
                callback({
                    dayoff_type : day_off_request['type_of_day'].toLowerCase(), 
                    dayoff_count : JSON.parse(day_off_request['days_off']).length
                });
            },
            error: function(data){
                callbackError({message_error: data.responseText});
            }
        });
    };

    var getCalendarConfigByWorkingYear = function ({id, callback = console.log, container, callbackError = console.log}) {
        $.ajax({
            type: 'GET',
            url: `/dayoff/request/${id}`,
            async: true,
            dataType: "json",
            success: function(data){
                callback({dayoffConfigContainer : container, dayoffConfig : data.dayoff_config, calendarId: id});
            },
            error: function(data){
                callbackError({message_error: data.responseText});
            }
        });
    };

    return {
        getCalendarConfigByWorkingYear : getCalendarConfigByWorkingYear,
        saveDayOffFormRequest : saveDayOffFormRequest
    }
});