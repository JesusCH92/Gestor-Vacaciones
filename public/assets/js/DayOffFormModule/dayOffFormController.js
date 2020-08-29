var dayOffFormController = (function(_calendarId){
    var $calendarId = _calendarId;
    var $CarouselDates = $("#datesCarousel");
    var $datesSelectedCalendar = $(".dates-selected-calendar");
    var $countDaysSelected = $(".count-days-selected");
    var $dateRangeSelected = $(".date-range");
    var $initRange = $(".init-range");
    var $endRange = $(".end-range");
    var $initDateDayOff = $("#init-date-day-off");
    var $endDateDayOff = $("#end-date-day-off");
    var $feastDaysCalendarCollection = $("#feast-days-calendar-collection");
    var $workingDaysCalendarCollection = $("#work-days-calendar-collection");
    var $saveDayOffForm = $("#save-day-off-form");
    var $removeDayOffForm = $("#remove-day-off-form");
    var $remainingDayHoliday = $(".remaining-day-holiday");
    var $remainingDayPersonal = $(".remaining-day-personal");

    var initEventDayOffConfig = function() {
        $CarouselDates.click( function() {
            if (!$(event.target).hasClass('selectable-day')) {
                return;
            }

            var $dayOfMonth = $(event.target).attr("date");
            printDates($dayOfMonth);
        });


        $dateRangeSelected.change(function() {

            if ("" === $initRange.val() || "" === $endRange.val()){
                return;
            }
            if (isValidDate($initRange.val()) !== true ) {
                console.log('no es valida la fecha');
                return;
            }
            if ($initRange.val() < $initDateDayOff.html() || $endRange.val() > $endDateDayOff.html() || $endRange.val()<$initRange.val()){
                console.log("La fecha seleccionada es incorrecta");
                //alert("La fecha seleccionada es menor a la permitida");
            }
            $feastDays=JSON.parse($feastDaysCalendarCollection.val());

            $arrayDatesRange = getDatesInRange($initRange.val(),$endRange.val());
            for (let i=0;i<$arrayDatesRange.length;i++){
                printDates($arrayDatesRange[i]);
            }


        });

        $saveDayOffForm.click( function() {
            $datesSelectedArray = getDatesSelected();
            $typeDayOff =$("#type-day-off-form-select").children("option:selected").val();

            if ($datesSelectedArray.length===0){
                console.log("No hay días seleccionados");
                return;
            }

            if ($typeDayOff === 'Holiday' && parseInt($remainingDayHoliday.text()) < $datesSelectedArray.length){
                console.log("No puedes pedir tantos días de vacaciones");
                return;
            }
            if ($typeDayOff === 'Personal' && parseInt($remainingDayPersonal.text()) < $datesSelectedArray.length){
                console.log("No puedes pedir tantos días personales");
                return;
            }
            //var _dayoffFormConfigModel = dayOffFormConfigModel();
            saveDayOffFormRequest({
                day_off_request : {
                    id_calendar : $calendarId,
                    days_off : JSON.stringify($datesSelectedArray),
                    type_of_day : $typeDayOff
                }
            });

        });

        $removeDayOffForm.click(function (){
            $datesSelectedCalendar.empty();
            $countDaysSelected.html("Días seleccionados: 0");
        });

        var saveDayOffFormRequest = function ({day_off_request, callback = console.log}) {
            $.ajax({
                type: 'POST',
                url: '/dayoff/management/add',
                async: true,
                data: {day_off_request},
                success: function(data){
                    callback(data);
                },
                error: function(data){
                    console.log(JSON.parse(data.responseText));
                }
            });
        };


        var printDates= function ($date){
            $datesSelectedArray = getDatesSelected();

            $feastDays=JSON.parse($feastDaysCalendarCollection.val());
            $workingDays = JSON.parse($workingDaysCalendarCollection.val());
            var currentDay = new Date($date).getDay().toString();

            if (!$feastDays.includes($date) && $workingDays.includes(currentDay) && !$datesSelectedArray.includes($date)){
                var dateList =   document.createElement("li");
                dateList.className = "list-group-item date-selected";
                dateList.innerText = $date;
                $datesSelectedCalendar.append(dateList);

                var countDaysSelected = $countDaysSelected.html();
                var countdays =countDaysSelected.split(":");
                var count =parseInt(countdays[1])+1;
                $countDaysSelected.html("Días seleccionados:"+ count);
            }

        };
        var getDatesInRange =function (startDate, stopDate) {
            var dateArray = [];
            var currentDate = new Date(startDate);
            var endDate = new Date(stopDate);
            while (currentDate <= endDate) {
                var month = parseInt(currentDate.getMonth())+1;
                var day = currentDate.getDate();
                if (month.toString().length<2){
                    month="0"+month.toString();
                }
                if (day.toString().length<2){
                    day="0"+day.toString();
                }
                dateArray.push( currentDate.getFullYear()+"-"+month +"-"+day );
                currentDate.setDate(currentDate.getDate() + 1);

            }
            return dateArray;
        };
        var getDatesSelected = function () {
            var dateArray = [];
            $listDatesSelected = $datesSelectedCalendar.find("li");
            for (let i=0; i<$listDatesSelected.length;i++){
                //console.log($listDatesSelected[i].innerText);
                dateArray.push( $listDatesSelected[i].innerText );
            }
            //$dateSelected = $listDatesSelected.html();
            //console.log($listDatesSelected);
            return dateArray;
        }
        var isValidDate = function ($dateString) {
            var $date = new Date($dateString);
            return $date instanceof Date && !isNaN($date);
        };

    };

    return{
        initEventDayOffConfig : initEventDayOffConfig
    }
});