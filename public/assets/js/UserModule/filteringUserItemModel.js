var filteringUserItemModel = (function () {
    var getUserById = function ({ id, callback = console.log, container, callbackError = console.log}) {
        $.ajax({
            type: 'GET',
            url: `/user/management/filter/id/${id}`,
            async: true,
            dataType: "json",
            success: function(data){
                // callback(data);
                callback({ container : container, template : data.user_form_template, id : id });
            },
            error: function(data){
                callbackError({message_error: JSON.parse(data.responseText).message});
            }
        });
    };

    return {
        getUserById : getUserById
    }
});