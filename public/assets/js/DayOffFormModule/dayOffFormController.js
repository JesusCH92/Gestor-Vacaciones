var dayOffFormController = (function(_calendarId){
    var $calendarId = _calendarId;
    var $datesInCalendar = $(".selectable-day");
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
    var $typeDayOffFormSelect = $("#type-day-off-form-select");

    var _dayOffFormRenderTemplate= dayOffFormRenderTemplate();
    var _errorModal = errorModal();

    var initEventDayOffConfig = function() {

        $datesInCalendar.click( function() {
            var $dayOfMonth = $(this).attr("date");
            var $typeDayOffSelected = $typeDayOffFormSelect.val();

            if (isValidDate($dayOfMonth) !== true && 'Work_off' !==$typeDayOffSelected) {
                console.log('no es valida la fecha');
                return;
            }
            callprintDatesSelected($dayOfMonth);
        });


        $dateRangeSelected.change(function() {

            if ("" === $initRange.val() || "" === $endRange.val()){
                return;
            }

            var $typeDayOffSelected = $typeDayOffFormSelect.val();

            if (isValidDate($initRange.val()) !== true && 'Work_off' !==$typeDayOffSelected) {
                console.log('no es valida la fecha');
                return;
            }
            if ($initRange.val() < $initDateDayOff.html() || $endRange.val() > $endDateDayOff.html() || $endRange.val()<$initRange.val()){
                console.log("La fecha seleccionada es incorrecta");
            }
            $feastDays=JSON.parse($feastDaysCalendarCollection.val());

            $arrayDatesRange = getDatesInRange($initRange.val(),$endRange.val());
            for (let i=0;i<$arrayDatesRange.length;i++){
                callprintDatesSelected($arrayDatesRange[i]);
            }


        });

        $saveDayOffForm.click( function() {
            var $datesSelectedArray = getDatesSelected();
            var $typeDayOff = $("#type-day-off-form-select").children("option:selected").val();

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
            var _dayoffFormConfigModel = dayOffFormConfigModel();
            _dayoffFormConfigModel.saveDayOffFormRequest({
                day_off_request : {
                    id_calendar : $calendarId,
                    days_off : JSON.stringify($datesSelectedArray),
                    type_of_day : $typeDayOff
                },
                callbackError : _errorModal.paintErrorModal
            });

        });

        $removeDayOffForm.click(function (){
            $datesSelectedCalendar.empty();
            $countDaysSelected.html("Días seleccionados: 0");
        });


    };

    var callprintDatesSelected= function ($date){
        $datesSelectedArray = getDatesSelected();

        $feastDays=JSON.parse($feastDaysCalendarCollection.val());
        $workingDays = JSON.parse($workingDaysCalendarCollection.val());
        var currentDay = new Date($date).getDay().toString();

        if (!$feastDays.includes($date) && $workingDays.includes(currentDay) && !$datesSelectedArray.includes($date)){
            _dayOffFormRenderTemplate.printDates({date : $date})

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
            dateArray.push( $listDatesSelected[i].innerText );
        }

        return dateArray;
    }

    var isValidDate = function ($dateString) {
        var $date = new Date($dateString + ':23:59:59');
        return $date instanceof Date && !isNaN($date) && ($date >= new Date('2019-01-01')) && new Date() <= $date;
    };

    return{
        initEventDayOffConfig : initEventDayOffConfig
    }
});