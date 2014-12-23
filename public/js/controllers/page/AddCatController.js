app.controller('AddCatCtrl', function($scope, Cat, User, AddressService, $timeout, $cookies, $location, $filter, matchmedia) {

    console.log('In AddCat Controller');

    $scope.page.title = 'page.add_cat.title';
    $scope.page.isMain = false;
    $scope.page.bodyClasses = 'page--add-cat';
    $scope.notification = '';
    $scope.settings.isSideMenuOpened = false;

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
        contacts : '',
        address : '',
        position : {latitude:50,longitude: 35},
        auth_token : $cookies.auth_token
    });

    $scope.user = {};

    $scope.user = User.get(
        { id:$cookies.auth_id, 'auth_token' : $cookies.auth_token },
        function (user) {
            if (user.success) {
                $scope.user = user;
                if ($scope.user.data.contacts.phone.length == 0
                    && $scope.user.data.contacts.city.length == 0
                    && $scope.user.data.email == 0
                    && $scope.user.data.contacts.web.length == 0
                    && $scope.user.data.contacts.surname.length == 0
                    && $scope.user.data.contacts.name.length == 0) {
                    $scope.newCat.contacts = '';
                } else {
                    $scope.newCat.contacts = $scope.user.data.email + '\n'
                    + $scope.user.data.contacts.phone + '\n'
                    + $scope.user.data.contacts.city + '\n'
                    + $scope.user.data.contacts.web + '\n'
                    + $scope.user.data.contacts.name + ' ' + $scope.user.data.contacts.surname + '\n';
                }

            } else {
                $scope.errors = user.errors;
            }
        }
    );

    $scope.saveCat = function() {
        $scope.user.auth_token = $cookies.auth_token;
        $scope.newCat.$save().then( function(response){
            if (response.success) {
                $location.path(window.pages.feed.alias);
            }
        });
    }

    var applyPosition = function (coords) {

        $scope.$apply(function () {
            $scope.newCat.position = coords;
        });

        $scope.settings.map.positionMap.zoom = 15;
        $scope.settings.map.positionMap.center = coords;
    }

    $scope.showCurrentMap = function() {
        $scope.settings.showChooseMapPosition = true;
        if(matchmedia.isPhone()){
            adaptMapHeight();
        }

        navigator.geolocation.getCurrentPosition(
            function(pos) {
                applyPosition(pos.coords);
                google.maps.event.trigger('resize');
            },
            function() {
                google.maps.event.trigger('resize');

            });


    }

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