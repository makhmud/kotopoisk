app.controller('AboutCtrl', function($scope, $filter, $sce, $translate) {

    console.log('In About Controller');

    $scope.page.isMain = false;
    $scope.page.bodyClasses = 'page--about';
    $scope.page.title = 'page.about.title';
    $scope.notification = '';
    $scope.settings.isSideMenuOpened = false;

    $scope.content = '';

    $translate('page.about.content')
        .then(function (translatedValue) {
            $scope.content = $sce.trustAsHtml(translatedValue);
        });


});