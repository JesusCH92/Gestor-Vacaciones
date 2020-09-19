var userFormModel = ( function () {
    var updateRolUser = function ({ userCorpus, callback = console.log, callbackError = console.log}) {
        $.ajax({
            type: 'PUT',
            url: '/user/management/rol',
            async: true,
            data: {userCorpus},
            success: function(data){
                callback({
                    message_title : 'Updated Role',
                    message : `User has the ${userCorpus['rol'].replace("ROLE_", "")} role`
                });
            },
            error: function(data){
                callbackError({ message_error: data.responseText });
            }
        });
    };

    var deleteUser = function ({ id, callback = console.log, callbackError = console.log, successModal = console.log }) {
        $.ajax({
            type: 'DELETE',
            url: `/user/management/delete/${id}`,
            async: true,
            success: function(){
                successModal({
                    message_title : 'User Deleted',
                    message : 'User has been unsubscribed'
                });
                callback({ userId : id });
            },
            error: function(data){
                callbackError({ message_error: data.responseText });
            }
        });
    };

    return {
        updateRolUser : updateRolUser,
        deleteUser : deleteUser
    }
});