app.factory('Cat', function($resource, $cookies) {

    var token = $cookies.auth_token;

    /**
     * Cats resourse
     * @type Promise
     */
    return $resource(
        '/api/cat/:id',
        { id: "@id" },
        {
            paramDefaults : {
                'auth_token' : token
            },
            /**
             * GET request without id
             */
            getAll: {
                method: "GET",
                params: {
                    'auth_token' : token
                }
            }
        }
    )
})