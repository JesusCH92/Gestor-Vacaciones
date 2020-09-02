var daysOffConfigController = (function(){
    $daysOffFilterUserBtn = $('#days-off-filter-user');
    $filterNameSelect = $('#name-filter');
    $departmentSelect = $('#filter-department');
    $filterUserDayOffContainer = $('.filter-user-day-off-container');

    var paintFilterDayOff= function({filterUserDayOff, dayoffConfig}){
        console.log("hola");
        filterUserDayOff.html(dayoffConfig);
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
        var _userInDayOffController = userInDayOffController();
        _userInDayOffController.initEventUserInDayOff();
    }

    var _daysOffModel = daysOffModel();
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
                callback : paintFilterDayOff,
                container : $filterUserDayOffContainer
            });

        });


    }

    initEvent();
})();