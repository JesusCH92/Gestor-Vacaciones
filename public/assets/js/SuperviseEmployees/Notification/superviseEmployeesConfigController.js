var superviseEmployeesConfigController = (function(){
    var $userNotificationContainer = $(".user-notification-container");
    var $employeeInfo = $(".employee-info");

    var _superviseEmployeesRenderTemplate = superviseEmployeesRenderTemplate();

    /*var paintDayOffConfig = function( { employeeInfo, dayoffConfig} ) {
        employeeInfo.html(dayoffConfig);
        var _superviseEmployees = superviseEmployeesController();
        _superviseEmployees.initSuperviseEmployees();
    };


     */
    var initEvent = function () {
        $userNotificationContainer.click(function() {

            console.log($(this).attr("dayoff"));

            var dayOffFormId = $(this).attr("dayoff");

            var _superviseEmployeesModel = superviseEmployeesModel();
            _superviseEmployeesModel.getDayOffFormByUser({
                dayOffFormId :dayOffFormId,
                callback: _superviseEmployeesRenderTemplate.paintDayOffConfig,
                container: $employeeInfo
                }
            );

        });
    };

    initEvent();
})();