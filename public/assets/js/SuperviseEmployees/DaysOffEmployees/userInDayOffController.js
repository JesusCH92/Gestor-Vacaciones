var userInDayOffController = (function(){

    var $userInDayOffFiltered = $(".user-in-dayOff-filtered");
    var $calendarContainer = $("#calendar-container");

    var _daysOffModel = daysOffModel();
    var _userInDayOffRenderTemplate = userInDayOffRenderTemplate();

    var initEvent = function () {
        $userInDayOffFiltered.click(function() {
            var $userId = $(this).attr('userId');
            console.log($userId);
            _userInDayOffRenderTemplate.paintCalendarForUserInDayOffByCurrentYear({ calendarContainer : $calendarContainer, calendar : `hola: ${$userId}` });
            //_daysOffModel.getCalendarWithUserInDayOffByCurrentYear({id : $userId, callback = console.log, container: $calendarContainer});
        });
    };

    return {
        initEventUserInDayOff : initEvent
    }
});