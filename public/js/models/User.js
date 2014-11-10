app.factory('User', function($resource, $cookies) {

    var token = $cookies.auth_token;

    /**
     * Cats resourse
     * @type Promise
     */
    return $resource(
        '/api/user/:id',
        { id: "@id" },
        {
            paramDefaults : {
                'auth_token' : token
            }
        }
    )
})