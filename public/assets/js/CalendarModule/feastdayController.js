var feastdayController = (function (calendarId) {
    var _calendarId = calendarId;
    var $feastdayResetBtn = $(".feastday-reset-btn");
    var $feastdayAddBtn = $(".feastday-add-btn");
    var $feastdayInCalendarContainer = $("#feastday-selected-container");

    var _editCalendarModel = editCalendarModel();
    var _errorModal = errorModal();
    var paintFeastDayAdded = function ({ feastdayContainer, feastday }) {
        feastdayContainer.append(feastday);
    };

    var initEvent = function () {
        $feastdayResetBtn.unbind().click(function () {
            var $feastdayItem = $(event.target).closest("li.feastday-item");
            console.log('se debe eliminar este feastday');
            console.log($feastdayItem);
            $feastdayItem.remove();
        });
    
        $feastdayAddBtn.unbind().click(function () {
            console.log('se debe añadir este feastday');
            var $feastdayItem = $(event.target).closest("li.feastday-item");
            var $feastdayDate = $feastdayItem.attr('feastday-date');
            var $feastdayCorpus = {
                calendarId : _calendarId,
                date : $feastdayDate
            };
            console.log($feastdayCorpus);
            _editCalendarModel.addFeastday({ feastday : $feastdayCorpus, callback: paintFeastDayAdded, container : $feastdayInCalendarContainer, deleteItem: $feastdayItem , callbackError : _errorModal.paintErrorModal});
        });
    };

    return {
        initEventFeastday : initEvent
    }
});