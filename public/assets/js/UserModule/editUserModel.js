var editUserModel = (function() {
    var getFilteringUser = function ({userSearchedCorpus, callback = console.log, container}) {
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
                console.log(data);
            }
        });
    };

    return {
        getFilteringUser : getFilteringUser
    }
});