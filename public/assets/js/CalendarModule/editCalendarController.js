var editCalendarController = (function(){
    var $workingYearFilterBtn = $("#working-year-filter-btn");
    var $workingYearSelect = $("#working-year-select");
    var $calendarConfigContainer = $("#calendar-config-container");

    var paintCalendarConfig = function( {calendarConfigContainer, calendarConfig} ) {
        calendarConfigContainer.html(calendarConfig);
        $("#work-days-select").selectpicker();
    };

    var initEvent = function () {
        $workingYearFilterBtn.click(function() {
            var $workingYear = $workingYearSelect.val();
            console.log('working year selected: ' + $workingYear);
            if ($workingYear === "") {
                return;
            }
            var _editCalendarModel = editCalendarModel();
            _editCalendarModel.getCalendarConfigByWorkingYear({
                id : $workingYear,
                callback : paintCalendarConfig,
                container : $calendarConfigContainer
            });
        });
    };

    initEvent();
})();