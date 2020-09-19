var calendarCreatorRenderTemplate = (function () {
    var $workingYearInput = $("#working-year");
    var $initDateRequestInput = $("#init-date-request");
    var $endDateRequestInput = $("#end-date-request");
    var $holidaysNumberInput = $("#holidays-number");
    var $personalDaysNumberInput = $("#personal-days-number");
    var $workDaysSelected = $("#work-days-select");
    var $feastdayDateInput = $("#feastday-date");
    var $feastdaySelectedContainer = $("#feastday-selected-container");
    var $erroSpan = $(".error--calendar-span");

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

    var paintErrorMessage = function ({ errorId, errorMessage = 'Is not valid' }) {
        errorId.find(".form-error-message").text(errorMessage);
        errorId.fadeIn();
    };

    var cleanCalendarForm = function () {
        $workingYearInput.val("2019");
        $initDateRequestInput.val("");
        $endDateRequestInput.val("");
        $holidaysNumberInput.val("0");
        $personalDaysNumberInput.val("0");
        $workDaysSelected.selectpicker('val','');
        $feastdayDateInput.val("");
        $feastdaySelectedContainer.empty();

        $erroSpan.fadeOut();
    };

    return {
        paintFeastDayInFeastDayContainer : paintFeastDayInFeastDayContainer,
        paintErrorMessage : paintErrorMessage,
        cleanCalendarForm : cleanCalendarForm
    }
});