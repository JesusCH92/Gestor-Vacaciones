var editCalendarController = (function(){
    var $workingYearFilterBtn = $("#working-year-filter-btn");
    var $workingYearSelect = $("#working-year-select");
    var $dayoffConfigContainer = $("#dayoff-config-container");

    var paintDayOffConfig = function( { dayoffConfigContainer, dayoffConfig, calendarId} ) {
        dayoffConfigContainer.html(dayoffConfig);
        var _dayOffController = dayOffFormController(calendarId);
        _dayOffController.initEventDayOffConfig();
    };

    var initEvent = function () {
        $workingYearFilterBtn.click(function() {
            var $workingYear = $workingYearSelect.val();
            console.log('working year selected: ' + $workingYear);
            if ($workingYear === "") {
                return;
            }
            var _dayoffFormConfigModel = dayOffFormConfigModel();
            _dayoffFormConfigModel.getCalendarConfigByWorkingYear({
                id : $workingYear,
                callback : paintDayOffConfig,
                container : $dayoffConfigContainer
            });
        });
    };

    initEvent();
})();