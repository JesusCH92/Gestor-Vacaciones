var daysOffConfigController = (function(){
    $daysOffFilterUserBtn = $('#days-off-filter-user');
    $filterNameSelect = $('#name-filter');
    $departmentSelect = $('#filter-department');
    $filterUserDayOffContainer = $('.filter-user-day-off-container');

    var paintFilterDayOff= function(filterUserDayOff, dayoffConfig){
        console.log("hola");
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
            _daysOffModel.getDayOffFormByDepartment({ filterEmployeesCorpus : $userInDayOffCorpus });


           /* if ($department === "Todos los departamentos" && !$filterName.val().trim()){
                console.log("no department and name selected");
                $department = "";
                console.log($department);
                getAllDayOffForm();
                return;
            }
            if ($department !== "Todos los departamentos" && !$filterName.val().trim()){
                console.log("department selected");
                getDayOffFormByDepartment({filter_day_off:{
                        department: $department}});
                return;

            }
            if ($department === "Todos los departamentos" && $filterName.val().trim() !== ""){
                console.log("name selected");
                getDayOffFormByName({filter_day_off:{
                        user_name: $userName
                    }});
                return;
            }
            getDayOffFormByDepartmentByName({
                filter_day_off:{
                    department: $department,
                    user_name: $userName
                },
            });



            */
        });


    }

    initEvent();
})();