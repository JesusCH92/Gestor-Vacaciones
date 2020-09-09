var userInDayOffRenderTemplate = (function() {
    var paintCalendarForUserInDayOffByCurrentYear = function ( { calendarContainer, calendar } ) {
        calendarContainer.html(calendar);
        $('[data-toggle="tooltip"]').tooltip();
    };

    var paintFilterDayOff= function({filterUserDayOff, dayoffConfig}){
        filterUserDayOff.html(dayoffConfig);
        $('[data-toggle="tooltip"]').tooltip()
        var _userInDayOffController = userInDayOffController();
        _userInDayOffController.initEventUserInDayOff();
    }

    return {
        paintCalendarForUserInDayOffByCurrentYear : paintCalendarForUserInDayOffByCurrentYear,
        paintFilterDayOff : paintFilterDayOff
    }
});