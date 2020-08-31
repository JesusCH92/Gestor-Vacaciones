var superviseEmployeesController = (function(){
    var $approveDayOffFormBtn = $("#approveDayOffFormEmployee");
    var $deniedDayOffFormBtn = $("#deniedDayOffFormEmployee");
    var $superviseComment = $("#supervisor-comment");
    var $dayOffFormId = $("#day-off-form-id");

    var initSuperviseEmployees = function() {
        console.log("holaaa");
        $approveDayOffFormBtn.click(function (){
            console.log($dayOffFormId.attr("value"));
            $comment = $superviseComment.val();
            $dayOffId = $dayOffFormId.attr("value");
            approveDayOffformRequest({day_off: {
                comment: $comment,
                day_off_id: $dayOffId
                }});
        });
        $deniedDayOffFormBtn.click(function (){
            console.log("denied");
            $comment = $superviseComment.val();
            $dayOffId = $dayOffFormId.attr("value");
            denyDayOffformRequest({day_off: {
                    comment: $comment,
                    day_off_id: $dayOffId
                }});
        });

        var approveDayOffformRequest = function (day_off_request, callback = console.log) {
            $.ajax({
                type: 'POST',
                url: '/notification/supervisor/approved',
                async: true,
                data: day_off_request,
                success: function(data){
                    //window.location.replace("http://localhost:8080/notification/list/employees");
                    location.reload();
                    callback(data);
                },
                error: function(data){
                    console.log(data.responseText);
                }
            });
        };

        var denyDayOffformRequest = function (day_off_request, callback = console.log) {
            $.ajax({
                type: 'POST',
                url: '/notification/supervisor/denied',
                async: true,
                data: day_off_request,
                success: function(data){
                    //window.location.replace("http://localhost:8080/notification/list/employees");
                    location.reload();
                    callback(data);
                },
                error: function(data){
                    console.log(data.responseText);
                }
            });
        };
    };

    return{
        initSuperviseEmployees : initSuperviseEmployees
    }
});