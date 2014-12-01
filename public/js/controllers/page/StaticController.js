app.controller('StaticCtrl', function($scope, StaticPage, $routeParams, $location, $sce) {

    console.log('In Static Controller');

    StaticPage.get({key : $routeParams.path}, function(page) {

        if (page.success) {
            $scope.page.title = page.data.title;
            $scope.page.content = $sce.trustAsHtml(page.data.content);
        } else {
            $location.path('/')
        }

    });

    $scope.page.title = '';
    $scope.page.isMain = false;
    $scope.page.bodyClasses = 'page--static';
    $scope.notification = '';
    $scope.settings.isSideMenuOpened = false;
});