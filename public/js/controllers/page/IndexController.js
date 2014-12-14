app.controller('IndexCtrl', function($scope, $http, $cookies, $location, $route, $filter, social_auth) {

    console.log('In Index Controller');

    $scope.page.isMain = true;
    $scope.page.bodyClasses = 'page--home';
    $scope.notification = '';
    $scope.settings.isSideMenuOpened = false;

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

    $scope.page.title = 'page.index.title';
    $scope.page.bodyClasses = 'page--home';
    //
    //var User = $resource('/api/user', {});
    //var user = User.get().$promise.then(function(data){
    //    console.log(data.data);
    //});
    //console.log(user);
});