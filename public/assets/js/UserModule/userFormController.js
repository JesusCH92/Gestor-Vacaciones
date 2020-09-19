var userFormController = ( function (id) {
    var _userId = id;
    var $removeUserBtn = $(".form--btn-remove");
    var $editUserBtn = $(".form--btn-edit");
    var $editAndRemoveformBtn = $(".form--btn")
    var $userRolSelectForm = $("#form--rol-select"); 

    var _userFormRenderTemplate = userFormRenderTemplate();
    var _userFormModel = userFormModel();
    var _errorModal = errorModal();

    var initEvent = function () {
        $editAndRemoveformBtn.click( function () {
            event.preventDefault();
        });

        $removeUserBtn.click( function () {
            console.log(_userId);
            _userFormModel.deleteUser({
                id : _userId,
                callback : _userFormRenderTemplate.removeUserItem,
                callbackError : _errorModal.paintErrorModal
            });
        });

        $editUserBtn.click( function () {
            var $editUserCorpus = {
                id : _userId,
                rol : $userRolSelectForm.val()
            }
            console.log($editUserCorpus);
            _userFormModel.updateRolUser({
                userCorpus : $editUserCorpus,
                callbackError : _errorModal.paintErrorModal
            });
        });

    }

    return {
        initEventUserFormController : initEvent
    }
});