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

    var _calendarCreatorModel = calendarCreatorModel();
    var _calendarCreatorRenderTemplate = calendarCreatorRenderTemplate();

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
            console.log($feastdaySelected);

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
            console.log($feastdayRowToDelete);
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

            _calendarCreatorModel.createCalendar({ 
                calendar : {
                    workingYear : $workingYear,
                    initDateRequest : $initDateRequest,
                    endDateRequest : $endDateRequest,
                    holidaysNumber : $holidaysNumber,
                    personalDaysNumber : $personalDaysNumber,
                    workDays : $workDays.length === 0 ? '' : $workDays,
                    feastDayCollection : $feastDayCollection.length === 0 ? '' : $feastDayCollection
                }
            });
        });
    };
    
    initEvents();
    
})();