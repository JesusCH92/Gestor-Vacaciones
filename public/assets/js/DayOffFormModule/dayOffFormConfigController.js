var dayOffFormConfigController = (function(){
    var $workingYearFilterBtn = $("#working-year-filter-btn");
    var $workingYearSelect = $("#working-year-select");
    var $dayoffConfigContainer = $("#dayoff-config-container");

    var _errorModal = errorModal();

    var initEvent = function () {
        var _dayOffFormRenderTemplate= dayOffFormRenderTemplate();

        $workingYearFilterBtn.click(function() {
            var $workingYear = $workingYearSelect.val();
            console.log('working year selected: ' + $workingYear);
            if ($workingYear === "") {
                return;
            }
            var _dayoffFormConfigModel = dayOffFormConfigModel();
            _dayoffFormConfigModel.getCalendarConfigByWorkingYear({
                id : $workingYear,
                callback : _dayOffFormRenderTemplate.paintDayOffConfig,
                container : $dayoffConfigContainer,
                callbackError : _errorModal.paintErrorModal
            });
        });
    };

    initEvent();
})();