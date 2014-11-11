app.controller('AboutCtrl', function($scope, $filter) {

    console.log('In About Controller');

    $scope.page.isMain = false;
    $scope.page.bodyClasses = 'page--about';
    $scope.page.title = $filter('translate')('page.about.title');
});