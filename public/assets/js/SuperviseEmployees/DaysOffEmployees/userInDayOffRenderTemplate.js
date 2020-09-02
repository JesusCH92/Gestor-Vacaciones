var userInDayOffRenderTemplate = (function() {
    var paintCalendarForUserInDayOffByCurrentYear = function ( { calendarContainer, calendar } ) {
        calendarContainer.html(calendar);
    };

    return {
        paintCalendarForUserInDayOffByCurrentYear : paintCalendarForUserInDayOffByCurrentYear
    }
});