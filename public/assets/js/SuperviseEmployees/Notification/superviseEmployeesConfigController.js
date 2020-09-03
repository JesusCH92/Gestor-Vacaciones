var superviseEmployeesConfigController = (function(){
    var $userNotification = $(".user-notification");
    var $employeeNotification = $(".employee-notification");
    var $userNotificationContainer = $(".user-notification-container");
    var $notificationContainer = $(".notifications-container");
    var $employeeInfo = $(".employee-info");


    var paintDayOffConfig = function( { employeeInfo, dayoffConfig} ) {
        employeeInfo.html(dayoffConfig);
        var _superviseEmployees = superviseEmployeesController();
        _superviseEmployees.initSuperviseEmployees();
    };

    var initEvent = function () {
        $userNotificationContainer.click(function() {

            console.log($(this).attr("dayoff"));

            var dayOffFormId = $(this).attr("dayoff");

            var _superviseEmployeesModel = superviseEmployeesModel();
            _superviseEmployeesModel.getDayOffFormByUser({
                dayOffFormId :dayOffFormId,
                callback: paintDayOffConfig,
                container: $employeeInfo
                }
            );

        });
    };

    initEvent();
})();