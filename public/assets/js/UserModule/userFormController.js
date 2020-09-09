var userFormController = ( function (id) {
    var _userId = id;
    var $removeUserBtn = $(".form--btn-remove");
    var $editUserBtn = $(".form--btn-edit");
    var $editAndRemoveformBtn = $(".form--btn")
    var $userRolSelectForm = $("#form--rol-select"); 

    var _userFormModel = userFormModel();

    var initEvent = function () {
        $editAndRemoveformBtn.click( function () {
            event.preventDefault();
        });

        $removeUserBtn.click( function () {
            console.log(_userId);
            _userFormModel.deleteUser({
                id : _userId
            });
        });

        $editUserBtn.click( function () {
            var $editUserCorpus = {
                id : _userId,
                rol : $userRolSelectForm.val()
            }
            console.log($editUserCorpus);
            _userFormModel.updateRolUser({
                userCorpus : $editUserCorpus
            });
        });

    }

    return {
        initEventUserFormController : initEvent
    }
});