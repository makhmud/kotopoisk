app.controller('FeedCtrl', function($scope, $filter, Cat) {

    console.log('In Feed Controller');

    $scope.ids.first = null;
    $scope.ids.last = null;
    $scope.data.cats = [];

    /**
     * Sets in true when end of all cats reached
     * @type {boolean}
     */
    $scope.settings.lockDelayLoad = false;
    /**
     * Order criteria
     * @type {null}
     */
    $scope.settings.catsOrder = null;
    $scope.settings.popupState.showControls = true;

    $scope.page.title = $filter('translate')('page.feed.title');
    $scope.page.isMain = false;
    $scope.page.bodyClasses = 'page--feed';
    $scope.page.search = false;
    $scope.notification = '';

    /**
     * Current offset position, depends on scroll position
     * @type {number}
     */
    var currentPosition = -1;

    /**
     * Change order criteria
     * @param order
     */
    $scope.reOrder = function(order) {
        if( typeof(order) == 'undefined' ) order = null;

        currentPosition = -1;
        $scope.ids.first = null;
        $scope.ids.last = null;
        $scope.data.cats = [];
        $scope.settings.catsOrder = order;
        $scope.settings.lockDelayLoad = false;

        $scope.delayLoad();

    }

    /**
     * Live scroll load
     * @returns {*}
     */
    $scope.delayLoad = function() {
        currentPosition++;
        return $scope.catsLoad(currentPosition);
    }
});