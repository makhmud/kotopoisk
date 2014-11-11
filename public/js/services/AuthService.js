
app.factory('Auth', function($http, $q, $cookies, $location) {

    return {
        /**
         * Return promise with responsed data from Google
         * @param address
         * @returns {*}
         */
        check : function(redirect) {
            if (typeof(redirect) == 'undefined') redirect = true;

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
                        if ($location.path() == '/'){
                            $location.path('/feed')
                        }
                        defer.resolve(true)
                    } else {
                        if (redirect) $location.path('/');
                        defer.resolve(false);
                    }
                })
                .error(function(data){
                    defer.resolve(false)
                });

            return defer.promise;
        }

    };

})