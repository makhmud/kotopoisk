app.controller('ProfileCtrl', function($scope, User, $cookies, $http, $filter) {

    $('select').styler();

    console.log('In Profile Controller');

    $scope.ngFlowParams = {
        target: '/api/upload?auth_token=' + $cookies.auth_token + '&isUserPic=1' ,
        testChunks:false
    }

    $scope.page.title = $filter('translate')('page.profile.title');
    $scope.page.bodyClasses = 'page--profile';
    $scope.page.isMain = false;

    $scope.changePassForm = {
        data : {
            oldPass:'',
            newPass:'',
            newPassRepeat:''
        },
        submit: function() {
            $scope.changePassForm.data.auth_token = $cookies.auth_token;
            $http.post('/api/auth/change-pass', $scope.changePassForm.data).success(function(response) {
                if(response.success){
                    $scope.notificate($filter('translate')('notification.pass_changed'));
                    $scope.changePassForm.data = {
                        oldPass:'',
                        newPass:'',
                        newPassRepeat:''
                    };
                    $scope.methods.closePopup();
                } else {
                    $scope.notificate($filter('translate')('notification.wrong_pass'));
                }


            }).error(function(response) {
                $scope.notificate($filter('translate')('notification.wrong_pass'));
            });
        }
    }

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