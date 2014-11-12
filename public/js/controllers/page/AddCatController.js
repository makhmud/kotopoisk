app.controller('AddCatCtrl', function($scope, Cat, AddressService, $timeout, $cookies, $location) {

    console.log('In AddCat Controller');

    $scope.page.title = 'Add cat';
    $scope.page.isMain = false;
    $scope.page.bodyClasses = 'page--add-cat';

    $scope.ngFlowParams = {
        target: '/api/upload?auth_token=' + $cookies.auth_token ,
        testChunks:false
    }

    $scope.settings.showChooseMapPosition = false;
    $scope.settings.map.positionMap = {
        zoom : 7,
        center : {latitude:50,longitude: 35}
    }

    $scope.newCat = new Cat({
        photos : [],
        comment : '',
        address : '',
        contacts : '',
        position : {latitude:50,longitude: 35},
        auth_token : $cookies.auth_token
    });

    $scope.saveCat = function() {
        $scope.newCat.$save().then( function(response){
            if (response.success) {
                $location.path('/feed');
            }
        });
    }

    var applyPosition = function (coords) {
        $scope.newCat.position = coords;
        $scope.settings.map.positionMap.zoom = 15;
        $scope.settings.map.positionMap.center = coords;
    }

    navigator.geolocation.getCurrentPosition(function(pos) {
        applyPosition(pos.coords);
    });

    var searchTimeout;
    $scope.doSearch = function() {
        $timeout.cancel(searchTimeout);
        searchTimeout = $timeout(function() {
            AddressService.getCoordsByAddress($scope.newCat.address).then(function (response) {
                console.log(response.results[0].geometry);

                applyPosition({
                    latitude : response.results[0].geometry.location.lat,
                    longitude : response.results[0].geometry.location.lng
                });
            });
        }, 500)
    }
});