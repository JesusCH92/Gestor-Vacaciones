var calendarController = (function(){
    var $createCalendarBtn = $("#create-calendar-btn");
    var $workingYearInput = $("#working-year");
    var $initDateRequestInput = $("#init-date-request");
    var $endDateRequestInput = $("#end-date-request");
    var $holidaysNumberInput = $("#holidays-number");
    var $personalDaysNumberInput = $("#personal-days-number");
    var $workDaysSelected = $("#work-days-select");
    var $feastdayDateInput = $("#feastday-date");
    var $feastdaySelectedContainer = $("#feastday-selected-container");
    var $initDateErrorSpan = $("#init-date-request-error");
    var $endDateErrorSpan = $("#end-date-request-error");
    var $holidayErrorSpan = $("#holidays-number-error");
    var $personalDayErrorSpan = $("#personal-days-number-error");
    var $feastDayErrorSpan = $("#feastday-date-error");

    var _validator = validator();
    var _calendarCreatorModel = calendarCreatorModel();
    var _calendarCreatorRenderTemplate = calendarCreatorRenderTemplate();
    var _errorModal = errorModal();

    var getAllFeastdaySelectedInContainer = function ( { feastdaySelected } ) {
        var $feastdaySelectedCollection = [];
        $(feastdaySelected).each(function(){
            $feastdaySelectedCollection.push( $(this).text() );
        });

        return $feastdaySelectedCollection;
    };

    var initEvents = function() {
        $feastdayDateInput.change(function(){
            var $feastdaySelected = $feastdayDateInput.val();

            if ( !_validator.isValidDate($feastdaySelected) ) {
                _calendarCreatorRenderTemplate.paintErrorMessage({
                    errorId : $feastDayErrorSpan,
                    errorMessage : 'Date is not valid. Must be 01-01-2019.'
                });
                return;
            }

            _calendarCreatorRenderTemplate.paintFeastDayInFeastDayContainer({
                feastday : $feastdaySelected,
                container : $feastdaySelectedContainer
            });
        });

        $feastdaySelectedContainer.click(function(){
            if ( !$(event.target).hasClass('oi-circle-x') ) {
                return;
            }
            
            var $feastdayRowToDelete = $(event.target).parent().parent();
            $feastdayRowToDelete.remove();
        });

        $createCalendarBtn.click(function(){
            var $workingYear = $workingYearInput.val();
            var $initDateRequest = $initDateRequestInput.val();
            var $endDateRequest = $endDateRequestInput.val();
            var $holidaysNumber = $holidaysNumberInput.val();
            var $personalDaysNumber = $personalDaysNumberInput.val();
            var $workDays = $workDaysSelected.val();
            var $feastDayCollection = getAllFeastdaySelectedInContainer( { feastdaySelected : "#feastday-selected-container p" } );

            if ( !_validator.isValidDate($initDateRequest) ) {
                _calendarCreatorRenderTemplate.paintErrorMessage({
                    errorId : $initDateErrorSpan,
                    errorMessage : 'Init date is not valid. Must be greater than 01-01-2019.'
                });
                return;
            }

            if ( !_validator.isValidDate($endDateRequest) ) {
                _calendarCreatorRenderTemplate.paintErrorMessage({
                    errorId : $endDateErrorSpan,
                    errorMessage : 'End date is not valid. Must be greater than 01-01-2019.'
                });
                return;
            }

            if ( !_validator.endDateIsGreaterThanInitDate($initDateRequest, $endDateRequest) ) {
                _calendarCreatorRenderTemplate.paintErrorMessage({
                    errorId : $initDateErrorSpan,
                    errorMessage : 'End date must be greater than init date.'
                });
                _calendarCreatorRenderTemplate.paintErrorMessage({
                    errorId : $endDateErrorSpan,
                    errorMessage : 'End date must be greater than init date.'
                });
                return;
            }

            if ( _validator.isIntegerPositive($holidaysNumber) ) {
                _calendarCreatorRenderTemplate.paintErrorMessage({
                    errorId : $holidayErrorSpan,
                    errorMessage : 'A type day off count could not be negative.'
                });
                return;
            }

            if ( _validator.isIntegerPositive($personalDaysNumber) ) {
                _calendarCreatorRenderTemplate.paintErrorMessage({
                    errorId : $personalDayErrorSpan,
                    errorMessage : 'A type day off count could not be negative.'
                });
                return;
            }

            _calendarCreatorModel.createCalendar({ 
                calendar : {
                    workingYear : $workingYear,
                    initDateRequest : $initDateRequest,
                    endDateRequest : $endDateRequest,
                    holidaysNumber : $holidaysNumber,
                    personalDaysNumber : $personalDaysNumber,
                    workDays : $workDays.length === 0 ? '' : $workDays,
                    feastDayCollection : $feastDayCollection.length === 0 ? '' : $feastDayCollection
                },
                callback : _calendarCreatorRenderTemplate.cleanCalendarForm,
                callbackError : _errorModal.paintErrorModal
            });
        });
    };
    
    initEvents();
    
})();