var userFormRenderTemplate = ( function () {
    var $formContainerId ="#container--user-form";
    var $userFormId = "#formulario-area";

    var removeUserItem = function ({ userId, formContainerId = $formContainerId, userFormId = $userFormId }) {
        // * Remove user form 
        $(`${formContainerId} > ${userFormId}`).hide('slow', function(){ $(`${formContainerId} > ${userFormId}`).remove(); });
        // * Remove user in list user research
        $(`#${userId}`).hide('slow', function(){ $(`#${userId}`).remove(); });
    };

    return {
        removeUserItem : removeUserItem
    }
});