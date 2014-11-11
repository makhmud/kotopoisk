app.controller('SearchCtrl', function($scope, $routeParams) {

    console.log('In Search Controller');

    /**
     * Order criteria
     * @type {null}
     */
    $scope.settings.catsOrder = null;

    $scope.page.title = 'Search';
    $scope.page.isMain = false;
    $scope.page.bodyClasses = 'page--search';
    $scope.page.search = true;

    $scope.searchString = $routeParams.find;

    $scope.ids.first = null;
    $scope.ids.last = null;
    $scope.data.cats = [];

    /**
     * Current offset position, depends on scroll position
     * @type {number}
     */
    var currentPosition = 0;
    $scope.catsLoad(currentPosition, $routeParams.find)

    /**
     * Live scroll load
     * @returns {*}
     */
    $scope.delayLoad = function() {
        currentPosition++;
        return $scope.catsLoad(currentPosition, $routeParams.find);
    }
});