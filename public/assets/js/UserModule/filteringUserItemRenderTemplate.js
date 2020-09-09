var filteringUserItemRenderTemplate = (function() {

    var paintUserFormContainer = function({ container, template, id }) {
        container.html(template);
        var _userFormController = userFormController(id);
        _userFormController.initEventUserFormController();
    };

    return {
        paintUserFormContainer : paintUserFormContainer
    }
});