var dayOffFormRenderTemplate = (function() {
    var $datesSelectedCalendar = $(".dates-selected-calendar");
    var $countDaysSelected = $(".count-days-selected");

    var paintDayOffConfig = function( { dayoffConfigContainer, dayoffConfig, calendarId} ) {
        dayoffConfigContainer.html(dayoffConfig);
        var _dayOffController = dayOffFormController(calendarId);
        _dayOffController.initEventDayOffConfig();
    };

    var printDates = function ( {date} ) {

            var dateList =   document.createElement("li");
            dateList.className = "list-group-item date-selected";
            dateList.innerText = date;
            $datesSelectedCalendar.append(dateList);

            var countDaysSelected = $countDaysSelected.html();
            var countdays =countDaysSelected.split(":");
            var count =parseInt(countdays[1])+1;
            $countDaysSelected.html("Días seleccionados:"+ count);

    };

    return {
        paintDayOffConfig : paintDayOffConfig,
        printDates : printDates
    }
});