var editUserController = (function(){
    console.log("Hello there!");
    var $departmentsSelect = $("#departments-select");
    var $userNameInput = $("#input--user-name");
    var $userNameFilterBtn = $("#btn--user-name-filter");
    var $userResultContainer = $("#container--user-name-filtered");

    var _editUserRenderTemplate = editUserRenderTemplate();
    var _editUserModel = editUserModel();

    var initEvent = function () {
        $userNameFilterBtn.click(function(){
            var $departmentSelected = $departmentsSelect.val();
            var $userName = $userNameInput.val();

            var $userSearchedCorpus = {
                username: $userName,
                department : $departmentSelected
            };

            console.log($userSearchedCorpus);

            _editUserModel.getFilteringUser({ 
                userSearchedCorpus : $userSearchedCorpus, 
                callback : _editUserRenderTemplate.paintFilteringUserContainer,
                container : $userResultContainer
            });
        });
    }

    initEvent();
})();