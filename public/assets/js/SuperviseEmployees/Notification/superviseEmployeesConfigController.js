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
            console.log($(this).attr("dayoff"));
            //console.log($employeeNotification.attr("user"));
            var userId = $(this).attr("dayoff");

            //console.log($employeeNotification.attr("dayoff"));
            var dayOffFormId = $(this).attr("dayoff");

            var _superviseEmployeesModel = superviseEmployeesModel();
            getDayOffFormByUser(

                dayOffFormId,
                paintDayOffConfig,
                $employeeInfo
            );


            //_superviseEmployeesModel.getDayOffFormByUser(userId,dayOffFormId)
        });


        var getDayOffFormByUser = function (dayOffRequest, callback = console.log, container) {
            console.log(dayOffRequest);
            $.ajax({
                type: 'GET',
                url: `/notification/list/employees/dayoff/${dayOffRequest}`,
                async: true,
                success: function(data){
                    callback({employeeInfo : container, dayoffConfig : data.dayoff_config});
                },
                error: function(data){
                    console.log(data);
                }
            });
        };
    };

    initEvent();
})();