app.controller('IndexCtrl', function($scope, $http, $cookies, $location, $route, $filter) {

    console.log('In Index Controller');

    $scope.page.isMain = true;
    $scope.page.bodyClasses = 'page--home';

    $scope.settings.loginForms = {
        active:'signup',
        signin : {
            email : '',
            password : ''
        },
        signup : {
            email : ''
        },
        remind : {
            email : ''
        }
    }

    /**
     * Cats array for feed
     * @type {Array}
     */
    $scope.data.cats = [];
    /**
     * Current cat info for popup
     * @type {null}
     */
    $scope.data.currentCat = null;
    /**
     * Cashed full cat`s infos for avoid repeatable requests
     * @type {Array}
     */
    $scope.data.catsFull = [];
    /**
     * First and lasts ids in all cats list, needs for popup controls display
     * @type {{first: null, last: null}}
     */
    $scope.ids = {first:null, last:null};
    /**
     * Forms submit functions
     * @type {{signin: Function}}
     */
    $scope.formSubmits = {

        signin : function() {
            $http.post('/api/auth/login', $scope.settings.loginForms.signin).success(function(response) {
                if (response.success) {
                    $cookies.auth_token = response.auth_token;
                    $cookies.auth_id = response.auth_id;
                    $scope.settings.auth = true;
                    $location.path('/feed');
                    $route.reload();
                } else {
                    $scope.notificate($filter('translate')('notification.register.wrong_credentials'));
                }
            });
        },

        signup : function() {
            $http.post('/api/auth/register', $scope.settings.loginForms.signup).success(function(response) {
                $scope.notificate($filter('translate')('notification.register'));
                $scope.settings.loginForms.signup.email = '';
            }).error(function(response) {
                $scope.notificate($filter('translate')('notification.register.already_exists'));
            });
        },

        remind : function() {
            $http.post('/api/auth/remind', $scope.settings.loginForms.remind).success(function(response) {
                $scope.notificate($filter('translate')('notification.remind'));
                $scope.settings.loginForms.remind.email = '';
            }).error(function(response) {
                $scope.notificate($filter('translate')('notification.register.already_exists'));
            });
        }

    }

    /**
     * Show form by name
     * @param name
     */
    $scope.setActive = function( name ) {
        $scope.settings.loginForms.active = name;
    }

    /**
     * Checks is form with name active
     * @param name
     * @returns {boolean}
     */
    $scope.isActive = function( name ) {
        return $scope.settings.loginForms.active == name;
    }

    $scope.page.title = 'Another title';
    $scope.page.bodyClasses = 'page--home';
    //
    //var User = $resource('/api/user', {});
    //var user = User.get().$promise.then(function(data){
    //    console.log(data.data);
    //});
    //console.log(user);
});