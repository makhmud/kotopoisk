app.controller('MainCtrl', function($scope, Cat, $filter, $route, $location, $cookies, User, $translate, $http, Auth, $sce, $timeout, matchmedia) {

    console.log('In Main Controller');

    $scope.$host = 'http://'+$location.host();

    if ( typeof($cookies.lng) == 'undefined' ) {
        $cookies.lng = 'ru';
    }

    $translate.use($cookies.lng);


    $scope.changeLocale = function (key) {

        $cookies.lng = key;
        $translate.use(key);

    }

    $scope.isLocale = function(key) {
        return key == $cookies.lng;
    }

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

    Auth.check(false).then( function(response) {
        $scope.settings.auth = response;
    })


    $scope.settings.map = {
        center : {latitude:50,longitude: 35},
        zoom : 4,
        options :{
            scrollwheel: false
        }

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
        bodyClasses : '',
        isMain : false
    };

    $scope.pages = window.pages;

    $scope.searchCount = 0;

    User.getAll({}, function(response){
        if (response.success) {
            $scope.page.userCount = response.data;
        } else {
            $scope.errors = response.errors;
        }
    });

    /**
     * Cats array for feed
     * @type {Array}
     */
    $scope.data.cats = [];
    /**
     * Current cat info for popup
     * @type {{}}
     */
    $scope.data.currentCat = {};
    $scope.currentCatLoaded = false

    /**
     * Cashed full cat`s infos for avoid repeatable requests
     * @type {Array}
     */
    $scope.data.catsFull = [];

    var countShared = function() {
        var total = 0;
        $timeout(function(){
            $('.popup .social-icons .ng-social-counter').each(function(indx, elm){
                total += ($(elm).text().length == 0) ? 0 : parseInt($(elm).text());
            });

            $('.popup .shared .text').text(total);
        }, 500)

    }

    //var countSharedAll = function() {
    //
    //    $('#gallery > li').each(function (indx, elm) {
    //
    //        $timeout(function(){
    //            var total = 0;
    //            $(elm).find('.social-icons .ng-social-counter').each(function(indx, elm1){
    //                total += ($(elm1).text().length == 0) ? 0 : parseInt($(elm1).text());
    //            });
    //
    //            $(elm).find('.refresh .text').text(total);
    //        }, 1000)
    //    })
    //
    //}

    /**
     * Showing popup by given id
     * @param id
     */
    $scope.showCat = function (id, noScroll) {
        if (typeof noScroll == 'undefined') noScroll = false;
        var top = 0;
        if (!noScroll) {
            var mainMargin = parseInt($('.main-container').css('margin-top'));
            top = $(window).scrollTop() - mainMargin;
            console.log($(window).height() + top);
            top = top < 0 ? 0 : top;
            if(mainMargin != 0) { top+=50; }
            $('.popup').css(
                {'margin-top':top + 'px'}
            );
        }

        $timeout(function() {
            $scope.currentCatLoaded = false;
        }, 0);

        var fullItem = $filter('filter')($scope.data.catsFull,{id:id}, true)[0];
        $scope.settings.galleryPreview.position = 0;

        if ( typeof(fullItem) != 'undefined' ) {
            $scope.data.currentCat = fullItem;
            $scope.methods.showPopup('cat-item');
            $timeout(function() {
                $scope.currentCatLoaded = true;
            }, 0);
            countShared();
        } else {
            var cat = Cat.get(
                { id:id, 'auth_token' : $cookies.auth_token },
                function (cat) {
                    if (cat.success) {
                        $scope.data.currentCat = cat.data;
                        $scope.data.currentCat.current_photo = ( typeof( cat.data.photos[0] ) != 'undefined' ) ? cat.data.photos[0].path : 'default.png';
                        $scope.data.currentCat.hasLike = $filter('filter')($scope.data.currentCat.likes,{id_author:$cookies.auth_id}, true)[0];
                        $scope.data.catsFull.push(cat.data);
                        $scope.methods.showPopup('cat-item');
                        $scope.currentCatLoaded = true;
                        countShared();
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
    $scope.catsLoad = function(currentPosition, search) {

        if(typeof(currentPosition) == 'undefined') currentPosition = 1;
        if(typeof(search) == 'undefined') search = '';

        if(!$scope.settings.lockDelayLoad){

            var cats = Cat.getAll(
                { offset:currentPosition, order:$scope.settings.catsOrder, 'auth_token' : $cookies.auth_token, lang: $cookies.lng, search: search },
                function (response, info) {

                    if (response.success) {
                        cats.data.cats.forEach(function(elm){
                            $scope.data.cats.push(elm);
                        });

                        if(cats.data.lock) {
                            $scope.settings.lockDelayLoad = true;
                        }

                        if (typeof(response.data.searchCount) != 'undefined') {
                            $scope.searchCount = response.data.searchCount
                        }

                        if (currentPosition == 0 && typeof($scope.data.cats[0]) != 'undefined') {
                            $scope.ids.first = $scope.data.cats[0].id;
                        }

                        if ($scope.settings.lockDelayLoad && typeof($scope.data.cats[ $scope.data.cats.length-1 ]) != 'undefined') {
                            $scope.ids.last = $scope.data.cats[ $scope.data.cats.length-1 ].id;
                        }
                        //$timeout(function() {
                        //    countSharedAll();
                        //}, 500);
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
        },

        showControls: true
    }

    /**
     * View selected cat on map
     * @param position
     */
    $scope.mapView = function (position) {
        $scope.settings.map.center = position;
        $scope.settings.map.zoom = 10;
        $scope.methods.closePopup();
        $location.path(window.pages.map.alias);
    }

    $scope.like = function (idCat) {
        if ($scope.settings.auth) {
            $http.post('/api/like', {idCat : idCat, idUser : $cookies.auth_id, auth_token : $cookies.auth_token }).then( function (response) {
                if (response.data.success) {
                    $scope.data.currentCat.likes.push(response.data.data);
                    $scope.data.currentCat.hasLike = true;
                    $filter('filter')($scope.data.cats,{id:$scope.data.currentCat.id}, true)[0].count_likes++;
                }
            })
        } else {
            $scope.methods.closePopup();
            $scope.methods.showPopup('login');
        }

    }

    $scope.notification = '';

    $scope.notificate = function(message) {
        $scope.notification = $sce.trustAsHtml(message);
    }

    $scope.logout = function() {
        $http.post('/api/auth/logout', {auth_token:$cookies.auth_token} ).success(function(response) {
            if (response.success) {
                delete $cookies.auth_token;
                delete $cookies.auth_id;
                $scope.settings.auth = false;
                $location.path('/');
            } else {
                $scope.notificate(response.errors);
            }
        }).error(function(response) {
            $scope.notificate(response);
        });
    }

    $scope.find = function(find) {
        $scope.settings.lockDelayLoad = false;
        $location.path(window.pages.search.alias + '/' + find);
    }

    $scope.settings.galleryPreview = {position : 0};

    $scope.galleryBack = function() {
        if ($scope.settings.galleryPreview.position + 126 <= 0) {
            $scope.settings.galleryPreview.position += 126;
        }
    }

    $scope.galleryNext = function(max) {
        if ($scope.settings.galleryPreview.position >= -(max - 516)) {
            $scope.settings.galleryPreview.position -= 126;
        }
    }

    $scope.searchText = '';

    $scope.addCatLink = function() {
        if ($scope.settings.auth) {
            $location.path($scope.pages.add_cat.alias);
        } else {
            $scope.settings.isSideMenuOpened = false;
            $scope.notificate('Чтобы получить возможность делать публикации, вам необходимо <a href="/">зарегистрироваться</a>')
        }
    }

    $scope.swipeLeft = function(){
        if(matchmedia.isPhone()){
            $scope.settings.isSideMenuOpened = false;
        }

    }

    $scope.swipeRight = function(){
        if(matchmedia.isPhone()){
            $scope.settings.isSideMenuOpened = true;
        }
    }

    $scope.activePage = window.pages.index;
    for( var key in window.pages){
        if ($location.path().startsWith( window.pages[key].alias) && key!='index') {
            $scope.activePage = window.pages[key];
        }
    }

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

    $scope.formStates = {
        signinValid : true,
        signupValid : true,
        remindValid : true
    }

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
                    $location.path(window.pages.feed.alias);
                    $route.reload();
                } else {
                    $scope.formStates.signinValid = false;
                    $scope.notificate($filter('translate')('notification.register.wrong_credentials'));
                }
            });
        },

        signup : function() {
            $http.post('/api/auth/register', $.extend({}, $scope.settings.loginForms.signup, {lng: $cookies.lng}) ).success(function(response) {
                $scope.notificate($filter('translate')('notification.register'));
                $scope.settings.loginForms.signup.email = '';
            }).error(function(response) {
                $scope.formStates.signupValid = false;
                $scope.notificate($filter('translate')('notification.register.already_exists'));
            });
        },

        remind : function() {
            $http.post('/api/auth/remind', $.extend({}, $scope.settings.loginForms.remind, {lng: $cookies.lng})).success(function(response) {
                $scope.notificate($filter('translate')('notification.remind'));
                $scope.settings.loginForms.remind.email = '';
            }).error(function(response) {
                $scope.formStates.remindValid = false;
                $scope.notificate($filter('translate')('notification.remind.success'));
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

});
