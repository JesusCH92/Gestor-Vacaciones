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
    
    var _editCalendarModel = editCalendarModel();
    var _errorModal = errorModal();

    var isValidDate = function ($dateString) {
        var $date = new Date($dateString);
        return $date instanceof Date && !isNaN($date) && ($date >= new Date('2019-01-01'));
    };

    var paintFeastDayInFeastDayContainer = function ({ feastday, container }) {
        var feastDayItem = `
            <li class="list-group-item d-flex justify-content-between feastday-item" feastday-date="${feastday}">
                <p class="m-auto">${feastday}</p>
                <a class="btn btn-link feastday-reset-btn my-auto">
                    <span class="oi oi-circle-x" title="Quit feast day selected" aria-hidden="true"></span>
                </a>
                <a class="btn btn-link feastday-add-btn my-auto">
                    <span class="oi oi-circle-check" title="Add feast day selected" aria-hidden="true"></span>
                </a>
            </li>
        `;
        container.append(feastDayItem);
        var _feastdayController = feastdayController(calendarId);
        _feastdayController.initEventFeastday();
    };

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
                },
                callbackError : _errorModal.paintErrorModal
            });
        });

        $updateWorkingDaysBtn.click( function() {
            var $workDays = $workDaysSelect.val() === [] ? "" : $workDaysSelect.val();
            var $workDaysCorpus = {
                calendarId : calendarId,
                workDays : $workDays
            };
            console.log($workDaysCorpus);
            _editCalendarModel.updateWorkDays({ workDays : $workDaysCorpus, callbackError : _errorModal.paintErrorModal });
        });

        $updateHolidayNumberBtn.click( function() {
            var $holidayNumberDays = $holidaysNumberInput.val();
            var $holidayCorpus = {
                calendarId : calendarId,
                number : $holidayNumberDays,
                type : 'Holiday'
            };
            console.log($holidayCorpus);
            _editCalendarModel.updateTypeDayOffNumber({ typeDayOff : $holidayCorpus, callbackError : _errorModal.paintErrorModal });
        });

        $updatePersonalDayOffNumberBtn.click( function() {
            var $personalDayOffNumberDays = $personalDaysNumberInput.val();
            var $personalDayOffCorpus = {
                calendarId : calendarId,
                number : $personalDayOffNumberDays,
                type : 'Personal'
            };
            console.log($personalDayOffCorpus);
            _editCalendarModel.updateTypeDayOffNumber({ typeDayOff : $personalDayOffCorpus, callbackError: _errorModal.paintErrorModal });
        });

        $feastdayInput.change(function(){
            var $feastdaySelected = $feastdayInput.val();
            if (isValidDate($feastdaySelected) !== true ) {
                console.log('no es valida la fecha');
                return;
            }
            console.log('la fecha es valida');
            console.log($feastdaySelected);

            paintFeastDayInFeastDayContainer({
                feastday : $feastdaySelected,
                container : $feastdaySelectedContiner
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
            console.log($feastdayItemToDelete.attr("feastday-date"));
            _editCalendarModel.deleteFeastday({ feastday : $feastdayCorpus, deleteItem : $feastdayItemToDelete, callbackError : _errorModal.paintErrorModal});
        });


    };

    return{
        initEventCalendarConfig : initEventCalendarConfig
    }
});