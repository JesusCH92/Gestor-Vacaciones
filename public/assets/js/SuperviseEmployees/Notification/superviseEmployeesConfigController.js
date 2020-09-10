var superviseEmployeesConfigController = (function(){
    var $userNotificationContainer = $(".user-notification-container");
    var $employeeInfo = $(".employee-info");

    var _superviseEmployeesRenderTemplate = superviseEmployeesRenderTemplate();
    var _errorModal = errorModal();

    var initEvent = function () {
        $userNotificationContainer.click(function() {

            console.log($(this).attr("dayoff"));

            var dayOffFormId = $(this).attr("dayoff");

            var _superviseEmployeesModel = superviseEmployeesModel();
            _superviseEmployeesModel.getDayOffFormByUser({
                dayOffFormId :dayOffFormId,
                callback : _superviseEmployeesRenderTemplate.paintDayOffConfig,
                container : $employeeInfo,
                callbackError : _errorModal.paintErrorModal
                }
            );

        });
    };

    initEvent();
})();