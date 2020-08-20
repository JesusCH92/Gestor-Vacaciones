var calendarConfigController = (function(_calendarId){
    var calendarId = _calendarId;
    var $updateDayOffRequestBtn = $("#update-dayoff-request-btn");
    var $initDateRequestInput = $("#init-date-request");
    var $endDateRequestInput = $("#end-date-request");
    var $updateHolidayNumberBtn = $("#update-hodliday-number-btn");
    var $holidaysNumberInput = $("#holidays-number-input");
    var $updatePersonalDayOffNumberBtn = $("#update-personal-dayoff-number-btn");
    var $personalDaysNumberInput = $("#personal-days-number-input");
    var $updateWorkingDaysBtn = $("#update-working-days-btn");
    var $workDaysSelect = $("#work-days-select");
    
    var _editCalendarModel = editCalendarModel();

    var initEventCalendarConfig = function() {
        $updateDayOffRequestBtn.click( function() {
            var $initDateRquest = $initDateRequestInput.val();
            var $endDateRequest = $endDateRequestInput.val();

            if ($initDateRquest === ""  || $endDateRequest === "") {
                return;
            }
            _editCalendarModel.updateDayOffRequest({
                dayOffRequest : {
                    calendarId : calendarId,
                    initDateRequest : $initDateRquest,
                    endDateRequest : $endDateRequest
                }
            });
        });

        $updateWorkingDaysBtn.click( function() {
            console.log("El Rick más Rick");
            var $workDays = $workDaysSelect.val() === [] ? "" : $workDaysSelect.val();
            var $workDaysCorpus = {
                calendarId : calendarId,
                workDays : $workDays
            };
            console.log($workDaysCorpus);
            _editCalendarModel.updateWorkDays({ workDays : $workDaysCorpus });
        });
    };

    return{
        initEventCalendarConfig : initEventCalendarConfig
    }
});