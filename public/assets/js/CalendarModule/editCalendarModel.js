var editCalendarModel = (function() {
    var getCalendarConfigByWorkingYear = function ({id, callback = console.log, container}) {
        $.ajax({
            type: 'GET',
            url: `/calendar/management/config/${id}`,
            async: true,
            dataType: "json",
            success: function(data){
                callback({calendarConfigContainer : container, calendarConfig : data.calendar_config});
            },
            error: function(data){
                console.log(data);
            }
        });
    };

    return {
        getCalendarConfigByWorkingYear : getCalendarConfigByWorkingYear
    }
})();