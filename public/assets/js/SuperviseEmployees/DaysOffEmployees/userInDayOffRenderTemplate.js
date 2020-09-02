var userInDayOffRenderTemplate = (function() {
    var paintCalendarForUserInDayOffByCurrentYear = function ( { calendarContainer, calendar } ) {
        calendarContainer.html(calendar);
        $('[data-toggle="tooltip"]').tooltip();
    };

    return {
        paintCalendarForUserInDayOffByCurrentYear : paintCalendarForUserInDayOffByCurrentYear
    }
});