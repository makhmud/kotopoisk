app.controller('MainCtrl', function($scope, Cat, $filter, $location, $cookies, User) {

    console.log('In Main Controller');

    $scope.settings = {};

    /**
     * Opened popup id
     * @type {null|string}
     */
    $scope.settings.popupId = null;
    /**
     * Determines side menu state
     * @type {boolean}
     */
    $scope.settings.isSideMenuOpened = false;


    $scope.settings.map = {
        center : {latitude:50,longitude: 35},
        zoom : 4
    };

    /**
     * Global methods
     * @type {{showPopup: Function, closePopup: Function, isPopupOpened: Function}}
     */
    $scope.methods = {
        /**
         * Showing popup
         * @param string popupId - identifier of popup to open
         */
        showPopup : function (popupId) {
            $scope.settings.popupId = popupId;
        },
        /**
         * Closing opened popup
         */
        closePopup : function () {
            $scope.settings.popupId = null;
        },
        /**
         * Checks if popup opened
         * @param string popupId
         * @returns {boolean}
         */
        isPopupOpened : function( popupId ) {

            if ( typeof(popupId) == 'undefined') {
                return $scope.settings.popupId != null;
            }

            return $scope.settings.popupId == popupId;
        },
        /**
         * Toggles side menu state
         */
        toggleSideMenu : function () {
            $scope.settings.isSideMenuOpened = !$scope.settings.isSideMenuOpened;
        }
    }

    /**
     * Global array of errors
     * @type {Array}
     */
    $scope.errors = []

    /**
     * Global array of data
     * @type {{}}
     */
    $scope.data = {};

    /**
     * Page settings
     * @TODO : add metas and getting mechanism
     * @type {{title: string}}
     */
    $scope.page = {
        title : 'Title',
        bodyClasses : ''
    };


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
     * Showing popup by given id
     * @param id
     */
    $scope.showCat = function (id) {

        var fullItem = $filter('filter')($scope.data.catsFull,{id:id}, true)[0];
        var success = true;

        if ( typeof(fullItem) != 'undefined' ) {
            $scope.data.currentCat = fullItem;
            $scope.methods.showPopup('cat-item');
        } else {
            var cat = Cat.get(
                { id:id, 'auth_token' : $cookies.auth_token },
                function (cat) {
                    success = cat.success;
                    if (cat.success) {
                        $scope.data.currentCat = cat.data;
                        $scope.data.currentCat.current_photo = ( typeof( cat.data.photos[0] ) != 'undefined' ) ? cat.data.photos[0].path : 'default.png';
                        $scope.data.catsFull.push(cat.data);
                        $scope.methods.showPopup('cat-item');
                    } else {
                        $scope.errors = cat.errors;
                    }
                }
            );
        }
    }

    /**
     * First and lasts ids in all cats list, needs for popup controls display
     * @type {{first: null, last: null}}
     */
    $scope.ids = {first:null, last:null};

    /**
     * Loads cats list by offset and order criteria
     * @param currentPosition
     * @returns {*}
     */
    $scope.catsLoad = function(currentPosition) {

        if(typeof(currentPosition) == 'undefined') currentPosition = 1;

        if(!$scope.settings.lockDelayLoad){
            //var promise = Cat.getAll().$promise;
            var cats = Cat.getAll(
                { offset:currentPosition, order:$scope.settings.catsOrder, 'auth_token' : $cookies.auth_token },
                function (response) {
                    if (response.success) {
                        cats.data.cats.forEach(function(elm){
                            $scope.data.cats.push(elm);
                        });

                        if(cats.data.lock) {
                            $scope.settings.lockDelayLoad = true;
                        }

                        if (currentPosition == 0) {
                            $scope.ids.first = $scope.data.cats[0].id;
                        }

                        if ($scope.settings.lockDelayLoad) {
                            $scope.ids.last = $scope.data.cats[ $scope.data.cats.length-1 ].id;
                        }
                    } else {
                        $scope.errors = response.errors;
                    }
                }
            );

            return cats;
        } else {
            return false;
        }
    }

    /**
     * Popup functions
     * @type {{isFirst: Function, isLast: Function, next: Function, prev: Function}}
     */
    $scope.settings.popupState = {
        /**
         * Check if current cat info first in list
         * @returns {boolean}
         */
        isFirst : function () {
            if ( $scope.data.currentCat != null ){
                return $scope.data.currentCat.id == $scope.ids.first;
            } else {
                return false;
            }
        },
        /**
         * Check if current cat info last in list
         * @returns {boolean}
         */
        isLast : function () {
            if ( $scope.data.currentCat != null ){
                return $scope.data.currentCat.id == $scope.ids.last;
            } else {
                return false;
            }

        },
        /**
         * Go to the next cat in list
         */
        next : function () {
            var currentCat = $filter('filter')(
                $scope.data.cats,
                {id:$scope.data.currentCat.id},
                true)[0];


            var nextCatId = $scope.data.currentCat.id;
            var currentCatLink = $scope.data.cats[ $scope.data.cats.indexOf(currentCat) + 1 ];

            if ( typeof(currentCatLink) != 'undefined') {
                nextCatId = currentCatLink.id;
                $scope.showCat(nextCatId);
            } else {
                $scope.delayLoad().then( function() {
                    nextCatId = $scope.data.cats[$scope.data.cats.indexOf(currentCat) + 1].id;
                    $scope.showCat(nextCatId);
                });
            }
        },
        /**
         * Go to the previous cat in list
         */
        prev : function () {
            var currentCat = $filter('filter')(
                $scope.data.cats,
                {id:$scope.data.currentCat.id},
                true)[0];

            var prevCatId = $scope.data.cats[$scope.data.cats.indexOf(currentCat) - 1].id;

            $scope.showCat(prevCatId);
        }
    }

    /**
     * View selected cat on map
     * @param position
     */
    $scope.mapView = function (position) {
        $scope.settings.map.center = position;
        $scope.settings.map.zoom = 10;
        $scope.methods.closePopup();
        $location.path('/map');
    }

});