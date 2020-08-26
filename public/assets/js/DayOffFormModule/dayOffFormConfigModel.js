var dayOffFormConfigModel = (function() {
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
        getCalendarConfigByWorkingYear : getCalendarConfigByWorkingYear
    }
});