app.controller('ProfileCtrl', function($scope, User, $cookies) {

    $('select').styler();

    console.log('In Profile Controller');

    $scope.page.title = 'Profile';
    $scope.page.bodyClasses = 'page--profile';

    var user = User.get(
        { id:1, 'auth_token' : $cookies.auth_token },
        function (user) {
            var success = user.success;
            if (user.success) {
                $scope.data.user = user.data;
            } else {
                $scope.errors = user.errors;
            }
        }
    );
});