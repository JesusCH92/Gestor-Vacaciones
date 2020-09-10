var filteringUserItemController = (function () {
    var $filteringUserCollection = $(".user--item");
    var $userFormContainer = $("#container--user-form");

    var _filteringUserItemRenderTemplate = filteringUserItemRenderTemplate();
    var _filteringUserItemModel = filteringUserItemModel();
    var _errorModal = errorModal();

    var initEvent = function () {
        $filteringUserCollection.click(function(){
            $userSelected = $(this).attr('id');
            console.log($userSelected);
            _filteringUserItemModel.getUserById({
                id : $userSelected,
                callback : _filteringUserItemRenderTemplate.paintUserFormContainer,
                container : $userFormContainer,
                callbackError : _errorModal.paintErrorModal
            });
        });
    };

    return {
        initEventFilteringUserItemController : initEvent
    }
});