var superviseEmployeesRenderTemplate = (function() {
    var paintDayOffConfig = function( { employeeInfo, dayoffConfig} ) {
        employeeInfo.html(dayoffConfig);
        var _superviseEmployees = superviseEmployeesController();
        _superviseEmployees.initSuperviseEmployees();
    };

    return {
        paintDayOffConfig : paintDayOffConfig
    }
});