var calendarConfigRenderTemplate = ( function () {
    var paintErrorMessage = function ({ errorId, errorMessage = 'Is not valid' }) {
        errorId.find(".form-error-message").text(errorMessage);
        errorId.fadeIn();
    };

    var removeErrorMessage = function ({ errorId }) {
        errorId.fadeOut();
    };

    var paintFeastDayInFeastDayContainer = function ({ feastday, container, calendarId }) {
        var feastDayItem = `
            <li class="list-group-item d-flex justify-content-between feastday-item" feastday-date="${feastday}">
                <p class="m-auto">${feastday}</p>
                <a class="btn btn-link feastday-reset-btn my-auto">
                    <span class="oi oi-circle-x" title="Quit feast day selected" aria-hidden="true"></span>
                </a>
                <a class="btn btn-link feastday-add-btn my-auto">
                    <span class="oi oi-circle-check" title="Add feast day selected" aria-hidden="true"></span>
                </a>
            </li>
        `;
        container.append(feastDayItem);
        var _feastdayController = feastdayController(calendarId);
        _feastdayController.initEventFeastday();
    };

    return {
        paintErrorMessage : paintErrorMessage,
        removeErrorMessage : removeErrorMessage,
        paintFeastDayInFeastDayContainer : paintFeastDayInFeastDayContainer
    }
});