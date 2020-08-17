var calendarController = (function(){
    var $createCalendarBtn = $("#create-calendar-btn");
    var $workingYearInput = $("#working-year");
    var $initDateRequestInput = $("#init-date-request");
    var $endDateRequestInput = $("#end-date-request");
    var $holidaysNumberInput = $("#holidays-number");
    var $personalDaysNumberInput = $("#personal-days-number");
    // var $othersNumberInput = $("#others-number");
    var $workDaysSelected = $("#work-days-select");
    var $feastdayDateInput = $("#feastday-date");
    var $feastdaySelectedContainer = $("#feastday-selected-container");


    var createCalendar = function ({calendar, callback = console.log}) {
        $.ajax({
            type: 'POST',
            url: '/calendar/management/create/calendar',
            async: true,
            data: {calendar},
            success: function(data){
                callback(data);
            },
            error: function(data){
                console.log(JSON.parse(data.responseText));
            }
        });
    };

    var paintFeastDayInFeastDayContainer = function ({ feastday, container }) {
        var feastDayRow = `
            <li class="list-group-item d-flex justify-content-between">
                <p class="m-auto">${feastday}</p>
                <a class="btn btn-link">
                    <span class="oi oi-circle-x" title="delete quantity days selected" aria-hidden="true"></span>
                </a>
            </li>
        `;
        container.append(feastDayRow);
    };

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

            paintFeastDayInFeastDayContainer({
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
            console.log('El Rick más Rick');
            var $workingYear = $workingYearInput.val();
            var $initDateRequest = $initDateRequestInput.val();
            var $endDateRequest = $endDateRequestInput.val();
            var $holidaysNumber = $holidaysNumberInput.val();
            var $personalDaysNumber = $personalDaysNumberInput.val();
            // var $othersNumber = $othersNumberInput.val();
            var $workDays = $workDaysSelected.val();
            var $feastDayCollection = getAllFeastdaySelectedInContainer( { feastdaySelected : "#feastday-selected-container p" } );

            
            createCalendar({ 
                calendar : {
                    workingYear : $workingYear,
                    initDateRequest : $initDateRequest,
                    endDateRequest : $endDateRequest,
                    holidaysNumber : $holidaysNumber,
                    personalDaysNumber : $personalDaysNumber,
                    // othersNumber : $othersNumber,
                    workDays : $workDays,
                    feastDayCollection : $feastDayCollection
                }
            });
        });
    };
    
    initEvents();
    
})();