var superviseEmployeesController = (function(){
    var $approveDayOffFormBtn = $("#approveDayOffFormEmployee");
    var $deniedDayOffFormBtn = $("#deniedDayOffFormEmployee");
    var $superviseComment = $("#supervisor-comment");
    var $dayOffFormId = $("#day-off-form-id");

    var _errorModal = errorModal();

    var initSuperviseEmployees = function() {
        _superviseEmployeesModel = superviseEmployeesModel();
        $approveDayOffFormBtn.click(function (){
            console.log($dayOffFormId.attr("value"));
            $comment = $superviseComment.val();
            $dayOffId = $dayOffFormId.attr("value");

            _superviseEmployeesModel.approveDayOffformRequest({
                day_off : {
                    comment : $comment,
                    day_off_id : $dayOffId
                },
                callbackError : _errorModal.paintErrorModal
            });
        });
        $deniedDayOffFormBtn.click(function (){
            console.log("denied");
            $comment = $superviseComment.val();
            $dayOffId = $dayOffFormId.attr("value");
            _superviseEmployeesModel.denyDayOffformRequest({
                day_off: {
                    comment: $comment,
                    day_off_id: $dayOffId
                },
                callbackError : _errorModal.paintErrorModal
            });
        });

    };

    return{
        initSuperviseEmployees : initSuperviseEmployees
    }
});