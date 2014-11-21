app.controller('LoginCtrl', function($scope) {

    console.log('In Login Controller');

    $scope.page.title = 'Login';
    $scope.page.isMain = false;
    $scope.page.bodyClasses = 'page--login';
    $scope.notification = '';
    $scope.settings.isSideMenuOpened = false;
});