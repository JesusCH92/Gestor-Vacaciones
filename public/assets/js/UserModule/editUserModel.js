var editUserModel = (function() {
    var getFilteringUser = function ({userSearchedCorpus, callback = console.log, container, callbackError = console.log}) {
        $.ajax({
            type: 'GET',
            url: `/user/management/filtering`,
            async: true,
            data: { userSearchedCorpus },
            success: function(data){
                // callback(data);
                callback({ container : container, template : data.user_collection_template });
            },
            error: function(data){
                callbackError({message_error: data.responseText});
            }
        });
    };

    return {
        getFilteringUser : getFilteringUser
    }
});