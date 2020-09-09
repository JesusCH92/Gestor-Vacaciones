var daysOffConfigController = (function(){
    $daysOffFilterUserBtn = $('#days-off-filter-user');
    $filterNameSelect = $('#name-filter');
    $departmentSelect = $('#filter-department');
    $filterUserDayOffContainer = $('.filter-user-day-off-container');

    var _daysOffModel = daysOffModel();
    var _userInDayOffRenderTemplate = userInDayOffRenderTemplate();

    var initEvent = function () {

        $daysOffFilterUserBtn.click(function (){
            $departmentId = $departmentSelect.val();
            $userName = $filterNameSelect.val().trim();

            var $userInDayOffCorpus = {
                department: $departmentId,
                user: $userName
            };
            console.log($userInDayOffCorpus);
            _daysOffModel.getDayOffFormByDepartment({
                filterEmployeesCorpus : $userInDayOffCorpus,
                callback : _userInDayOffRenderTemplate.paintFilterDayOff,
                container : $filterUserDayOffContainer
            });

        });


    }

    initEvent();
})();