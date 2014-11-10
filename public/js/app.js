
app.config(['$locationProvider', '$routeProvider', '$httpProvider', function($locationProvider, $routeProvider, $httpProvider) {
        $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
        $locationProvider.html5Mode(true);

        $routeProvider.when('/', {templateUrl: '/pages/main', controller: 'IndexCtrl'});
        $routeProvider.when('/feed', {templateUrl: '/pages/feed', controller: 'FeedCtrl'});
        $routeProvider.when('/map', {templateUrl: '/pages/map', controller: 'MapCtrl'});
        $routeProvider.when('/add-cat', {
            templateUrl: '/pages/add-cat',
            controller: 'AddCatCtrl',
            resolve: {
                auth : ['Auth', function(Auth){ return Auth.check() }]
            }
        });
        $routeProvider.when('/profile', {
            templateUrl: '/pages/profile',
            controller: 'ProfileCtrl',
            resolve: {
                auth : ['Auth', function(Auth){ return Auth.check() }]
            }
        });
        $routeProvider.when('/about', {templateUrl: '/pages/about', controller: 'AboutCtrl'});
        $routeProvider.when('/login', {templateUrl: '/pages/login', controller: 'LoginCtrl'});

        $routeProvider.otherwise({redirectTo: '/'});

    }]);