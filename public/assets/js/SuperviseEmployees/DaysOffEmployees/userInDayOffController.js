var userInDayOffController = (function () {

    var $userInDayOffFiltered = $(".user-in-dayOff-filtered");
    var $calendarContainer = $("#calendar-container");

    var _daysOffModel = daysOffModel();
    var _userInDayOffRenderTemplate = userInDayOffRenderTemplate();
    var _errorModal = errorModal();

    var initEvent = function () {
        $userInDayOffFiltered.click(function () {
            var $userId = $(this).attr('userId');
            console.log($userId);
            _daysOffModel.getCalendarWithUserInDayOffByCurrentYear({
                id: $userId,
                callback: _userInDayOffRenderTemplate.paintCalendarForUserInDayOffByCurrentYear,
                container: $calendarContainer,
                callbackError: _errorModal.paintErrorModal
            });
        });
    };

    return {
        initEventUserInDayOff: initEvent
    }
});