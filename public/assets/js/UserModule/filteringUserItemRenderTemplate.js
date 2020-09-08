var filteringUserItemRenderTemplate = (function() {

    var paintUserFormContainer = function({ container, template, id }) {
        container.html(template);
        // var _filteringUserItemController = filteringUserItemController();
        // _filteringUserItemController.initEventFilteringUserItemController();
    };

    return {
        paintUserFormContainer : paintUserFormContainer
    }
});