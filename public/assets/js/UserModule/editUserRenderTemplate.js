var editUserRenderTemplate = (function(){
    var paintFilteringUserContainer = function({ container, template }) {
        container.html(template);
        var _filteringUserItemController = filteringUserItemController();
        _filteringUserItemController.initEventFilteringUserItemController();
    };

    return {
        paintFilteringUserContainer : paintFilteringUserContainer
    }
});