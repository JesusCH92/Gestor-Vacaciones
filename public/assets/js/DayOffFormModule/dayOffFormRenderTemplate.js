var dayOffFormRenderTemplate = ( function () {
    var $datesSelectedCalendar = $(".dates-selected-calendar");
    var $countDaysSelected = $(".count-days-selected");
    var $remainingDayInputClassTag = ".remaining-day-";
    var $initRange = $(".init-range");
    var $endRange = $(".end-range");
    var $datesSelectedCalendar = $(".dates-selected-calendar");

    var paintDayOffConfig = function( { dayoffConfigContainer, dayoffConfig, calendarId } ) {
        dayoffConfigContainer.html(dayoffConfig);
        var _dayOffController = dayOffFormController(calendarId);
        _dayOffController.initEventDayOffConfig();
    };

    var printDates = function ( {date} ) {
        var dateList =   document.createElement("li");
        dateList.className = "list-group-item date-selected d-flex justify-content-center";
        dateList.innerText = date;
        $datesSelectedCalendar.append(dateList);

        var countDaysSelected = $countDaysSelected.html();
        var countdays =countDaysSelected.split(":");
        var count =parseInt(countdays[1])+1;
        $countDaysSelected.html("Días seleccionados: "+ count);
    };

    var resetDayOffRequestForm = function ({ dayoff_type, dayoff_count }) {
        $initRange.val("");
        $endRange.val("");
        $datesSelectedCalendar.empty();
        $countDaysSelected.text("Días seleccionados: 0");

        if ( dayoff_type === 'work_off') {
            return;
        }

        var $remainingDayTotal = ($($remainingDayInputClassTag + dayoff_type).text() * 1) - (dayoff_count * 1);
        $($remainingDayInputClassTag + dayoff_type).text($remainingDayTotal);
    };

    var addActiveToCarousel = function ( carouselId ) {
        if (carouselId.find('.active').length !== 0) {
            return;
        }
        $($('.carousel-item ')[0]).addClass('active');
    };

    return {
        paintDayOffConfig : paintDayOffConfig,
        printDates : printDates,
        resetDayOffRequestForm : resetDayOffRequestForm,
        addActiveToCarousel : addActiveToCarousel
    }
});