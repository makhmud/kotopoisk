app.controller('ProfileCtrl', function($scope, User, $cookies) {

    $('select').styler();

    console.log('In Profile Controller');

    $scope.ngFlowParams = {
        target: '/api/upload?auth_token=' + $cookies.auth_token + '&isUserPic=1' ,
        testChunks:false
    }

    $scope.page.title = 'Profile';
    $scope.page.bodyClasses = 'page--profile';
    $scope.page.isMain = false;

    $scope.user = {};

    $scope.user = User.get(
        { id:1, 'auth_token' : $cookies.auth_token },
        function (user) {
            if (user.success) {
                $scope.user = user;
            } else {
                $scope.errors = user.errors;
            }
        }
    );

    $scope.saveUser = function() {
        $scope.user.auth_token = $cookies.auth_token;
        User.update({id:1}, $scope.user.data);
    }
});