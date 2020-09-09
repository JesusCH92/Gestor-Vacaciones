var userFormModel = ( function () {
    var updateRolUser = function ({ userCorpus, callback = console.log}) {
        $.ajax({
            type: 'PUT',
            url: '/user/management/rol',
            async: true,
            data: {userCorpus},
            success: function(data){
                callback(data);
            },
            error: function(data){
                console.log(data);
            }
        });
    };

    var deleteUser = function ({ id, callback = console.log }) {
        $.ajax({
            type: 'DELETE',
            url: `/user/management/delete/${id}`,
            async: true,
            dataType: "json",
            success: function(data){
                callback(data);
                // callback({calendarConfigContainer : container, calendarConfig : data.calendar_config, calendarId: id});
            },
            error: function(data){
                console.log(data);
            }
        });
    };

    return {
        updateRolUser : updateRolUser,
        deleteUser : deleteUser
    }
});