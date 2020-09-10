var calendarCreatorRenderTemplate = (function () {
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

    return {
        paintFeastDayInFeastDayContainer : paintFeastDayInFeastDayContainer
    }
});