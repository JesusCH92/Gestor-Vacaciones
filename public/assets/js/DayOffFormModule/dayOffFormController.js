var dayOffFormController = (function(_calendarId){
    var calendarId = _calendarId;
    var $CarouselDates = $("#datesCarousel");
    var $datesSelectedCalendar = $(".dates-selected-calendar");
    var initEventDayOffConfig = function() {
        $CarouselDates.click( function() {
            if (!$(event.target).hasClass('selectable-day')) {
                return;
            }

            var $dayOfMonth = $(event.target).attr("date");
            var dateList =   document.createElement("li");
            dateList.className = "list-group-item date selected";
            dateList.innerText = $dayOfMonth;
            $datesSelectedCalendar.append(dateList);
            console.log($dayOfMonth);
        });
    };

    return{
        initEventDayOffConfig : initEventDayOffConfig
    }
});