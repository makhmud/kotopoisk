
app.config(['$locationProvider', '$routeProvider', '$httpProvider', '$translateProvider', function($locationProvider, $routeProvider, $httpProvider, $translateProvider) {

    $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
    $httpProvider.defaults.withCredentials = true;
    $locationProvider.html5Mode(true);

    $translateProvider.useStaticFilesLoader({
        prefix: '/api/language/',
        suffix: ''
    });
    //$translateProvider.useLocalStorage();

    $routeProvider.when('/', {
        templateUrl: '/pages/main',
        controller: 'IndexCtrl',
        resolve: {
            social_auth : ['Auth', function(Auth){ return Auth.checkSocial() || Auth.check() }]
        }
    });
    $routeProvider.when(window.pages.feed.alias + '/:id', {templateUrl: '/pages/feed', controller: 'FeedCtrl'});
    $routeProvider.when(window.pages.feed.alias, {templateUrl: '/pages/feed', controller: 'FeedCtrl'});
    $routeProvider.when(window.pages.search.alias + '/:find', {templateUrl: '/pages/feed', controller: 'SearchCtrl'});
    $routeProvider.when(window.pages.map.alias, {templateUrl: '/pages/map', controller: 'MapCtrl'});
    $routeProvider.when(window.pages.add_cat.alias, {
        templateUrl: '/pages/add-cat',
        controller: 'AddCatCtrl',
        resolve: {
            auth : ['Auth', function(Auth){ return Auth.check() }]
        }
    });
    $routeProvider.when(window.pages.profile.alias, {
        templateUrl: '/pages/profile',
        controller: 'ProfileCtrl',
        resolve: {
            auth : ['Auth', function(Auth){ return Auth.check() }]
        }
    });
    $routeProvider.when(window.pages.about.alias, {templateUrl: '/pages/about', controller: 'AboutCtrl'});
    $routeProvider.when('/:path', {templateUrl: '/pages/static', controller: 'StaticCtrl'});

    $routeProvider.otherwise({redirectTo: '/'});

}]);