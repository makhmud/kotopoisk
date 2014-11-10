
app.factory('Auth', function($http, $q, $cookies, $location) {

    return {
        /**
         * Return promise with responsed data from Google
         * @param address
         * @returns {*}
         */
        check : function() {
            var defer = $q.defer();
            $http({
                url: '/api/auth/check',
                method: "GET",
                params: {
                    auth_token : $cookies.auth_token
                },
                headers: {'Content-Type': 'application/json'},
                responseType:'JSON'
            })
                .success(function(data){
                    if (data.success) {
                        defer.resolve(data)
                    } else {
                        $location.path('/')
                        defer.reject(data);
                    }
                })
                .error(function(data){
                    defer.reject(data)
                });

            return defer.promise;
        }

    };

})