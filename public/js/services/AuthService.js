
app.factory('Auth', function($http, $q, $cookies, $location, $route) {

    var auth = {
        /**
         * Return promise with responsed data from Google
         * @param address
         * @returns {*}
         */
        check : function(redirect, token) {

            if (typeof(redirect) == 'undefined') redirect = true;
            if (typeof(token) == 'undefined') token = $cookies.auth_token;

            var defer = $q.defer();
            $http({
                url: '/api/auth/check',
                method: "GET",
                params: {
                    auth_token : token
                },
                headers: {'Content-Type': 'application/json'},
                responseType:'JSON'
            })
                .success(function(data){
                    if (data.success) {
                        if ($location.path() == '/'){
                            $location.path('/feed');
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
        },
        checkSocial : function() {

            var defer = $q.defer();

            if (typeof(window.socialToken) != 'null') {
                var socialToken = window.socialToken;
                window.socialToken = null;

                $http({
                    url: '/api/auth/social-login',
                    method: "POST",
                    params: {
                        token : socialToken
                    },
                    headers: {'Content-Type': 'application/json'},
                    responseType:'JSON'
                })
                    .success(function(data){
                        if (data.success) {
                            $cookies.auth_token = data.auth_token;
                            $cookies.auth_id = data.auth_id;
                            if ($location.path() == '/'){
                                $location.path('/feed');
                                $route.reload();
                            }
                            defer.resolve(true);

                        } else {
                            defer.resolve(false);
                        }
                    })
                    .error(function(data){
                        defer.resolve(false)
                    });
            } else {
                defer.resolve(false)
            }

            return defer.promise;
        }

    };

    return auth;

})