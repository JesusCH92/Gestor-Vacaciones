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
    var $feastdayInput = $("#feastday-date");
    var $feastdaySelectedContiner = $("#feastday-list-container");
    var $feastdayInCalendarContainer = $("#feastday-selected-container");
    var $initDateErrorSpan = $("#init-date-request-error");
    var $endDateErrorSpan = $("#end-date-request-error");
    var $holidayErrorSpan = $("#holidays-number-error");
    var $personalDayErrorSpan = $("#personal-days-number-error");
    var $feastDayErrorSpan = $("#feastday-date-error");
    
    var _validator = validator();
    var _calendarConfigRenderTemplate = calendarConfigRenderTemplate();
    var _editCalendarModel = editCalendarModel();
    var _errorModal = errorModal();

    var initEventCalendarConfig = function() {
        $updateDayOffRequestBtn.click( function() {
            var $initDateRequest = $initDateRequestInput.val();
            var $endDateRequest = $endDateRequestInput.val();

            if ( !_validator.isValidDate($initDateRequest) ) {
                _calendarConfigRenderTemplate.paintErrorMessage({
                    errorId : $initDateErrorSpan,
                    errorMessage : 'Init date is not valid. Must be greater than 01-01-2019.'
                });
                return;
            }

            if ( !_validator.isValidDate($endDateRequest) ) {
                _calendarConfigRenderTemplate.paintErrorMessage({
                    errorId : $endDateErrorSpan,
                    errorMessage : 'End date is not valid. Must be greater than 01-01-2019.'
                });
                return;
            }

            if ( !_validator.endDateIsGreaterThanInitDate($initDateRequest, $endDateRequest) ) {
                _calendarConfigRenderTemplate.paintErrorMessage({
                    errorId : $initDateErrorSpan,
                    errorMessage : 'End date must be greater than init date.'
                });
                _calendarConfigRenderTemplate.paintErrorMessage({
                    errorId : $endDateErrorSpan,
                    errorMessage : 'End date must be greater than init date.'
                });
                return;
            }

            _calendarConfigRenderTemplate.removeErrorMessage({ errorId : $initDateErrorSpan });
            _calendarConfigRenderTemplate.removeErrorMessage({ errorId : $endDateErrorSpan });

            _editCalendarModel.updateDayOffRequest({
                dayOffRequest : {
                    calendarId : calendarId,
                    initDateRequest : $initDateRequest,
                    endDateRequest : $endDateRequest
                },
                callbackError : _errorModal.paintErrorModal
            });
        });

        $updateWorkingDaysBtn.click( function() {
            var $workDays = $workDaysSelect.val();
            var $workDaysCorpus = {
                calendarId : calendarId,
                workDays : $workDays.length === 0 ? "" : $workDays
            };

            _editCalendarModel.updateWorkDays({ workDays : $workDaysCorpus, callbackError : _errorModal.paintErrorModal });
        });

        $updateHolidayNumberBtn.click( function() {
            var $holidayNumberDays = $holidaysNumberInput.val();

            if ( _validator.isIntegerPositive($holidayNumberDays) ) {
                _calendarConfigRenderTemplate.paintErrorMessage({
                    errorId : $holidayErrorSpan,
                    errorMessage : 'A type day off count could not be negative.'
                });
                return;
            }

            _calendarConfigRenderTemplate.removeErrorMessage({ errorId : $holidayErrorSpan });

            var $holidayCorpus = {
                calendarId : calendarId,
                number : $holidayNumberDays,
                type : 'Holiday'
            };

            _editCalendarModel.updateTypeDayOffNumber({ typeDayOff : $holidayCorpus, callbackError : _errorModal.paintErrorModal });
        });

        $updatePersonalDayOffNumberBtn.click( function() {
            var $personalDayOffNumberDays = $personalDaysNumberInput.val();

            if ( _validator.isIntegerPositive($personalDayOffNumberDays) ) {
                _calendarConfigRenderTemplate.paintErrorMessage({
                    errorId : $personalDayErrorSpan,
                    errorMessage : 'A type day off count could not be negative.'
                });
                return;
            }

            _calendarConfigRenderTemplate.removeErrorMessage({ errorId : $personalDayErrorSpan });

            var $personalDayOffCorpus = {
                calendarId : calendarId,
                number : $personalDayOffNumberDays,
                type : 'Personal'
            };

            _editCalendarModel.updateTypeDayOffNumber({ typeDayOff : $personalDayOffCorpus, callbackError: _errorModal.paintErrorModal });
        });

        $feastdayInput.change(function(){
            var $feastdaySelected = $feastdayInput.val();

            if ( !_validator.isValidDate($feastdaySelected) ) {
                _calendarConfigRenderTemplate.paintErrorMessage({
                    errorId : $feastDayErrorSpan,
                    errorMessage : 'Date is not valid. Must be greater than 01-01-2019.'
                });
                return;
            }

            _calendarConfigRenderTemplate.removeErrorMessage({ errorId : $feastDayErrorSpan});

            _calendarConfigRenderTemplate.paintFeastDayInFeastDayContainer({
                feastday : $feastdaySelected,
                container : $feastdaySelectedContiner,
                calendarId : calendarId
            });
        });

        $feastdayInCalendarContainer.click(function() {
            if ( !$(event.target).hasClass('feastday-delete-btn') ) {
                return;
            }
            var $feastdayItemToDelete = $(event.target).closest("li.feastday-item-calendar");
            var $feastdayCorpus = {
                calendarId : calendarId,
                date : $feastdayItemToDelete.attr("feastday-date")
            };
            
            _editCalendarModel.deleteFeastday({ feastday : $feastdayCorpus, deleteItem : $feastdayItemToDelete, callbackError : _errorModal.paintErrorModal});
        });


    };

    return{
        initEventCalendarConfig : initEventCalendarConfig
    }
});