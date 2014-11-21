app.controller('ProfileCtrl', function($scope, User, $cookies, $http, $filter) {

    $('select').styler({
        selectSmartPositioning : false
    });

    $('#web').inputmask({
        mask: "http://*{2,20}.*{2,5}[*{2,80}]",
        greedy: false,
        definitions: {
            '*': {
                validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
                cardinality: 1,
                casing: "lower"
            }
        }
    });
    $('#phone').inputmask({
        mask: "+79 999 99 99"
    });

    console.log('In Profile Controller');

    $scope.ngFlowParams = {
        target: '/api/upload?auth_token=' + $cookies.auth_token + '&isUserPic=1' ,
        testChunks:false
    }

    $scope.page.title = $filter('translate')('page.profile.title');
    $scope.page.bodyClasses = 'page--profile';
    $scope.page.isMain = false;
    $scope.notification = '';
    $scope.settings.isSideMenuOpened = false;

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
        { id:$cookies.auth_id, 'auth_token' : $cookies.auth_token },
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
        User.update(
            {id:$cookies.auth_id},
            $scope.user.data,
            function(response){
                if (!response.success) {
                    $scope.notificate($filter('translate')('notification.register.already_exists'))
                }
            }
        );
    }

    $scope.isFull = function() {

        return $scope.user.data.contacts.name.length>0
            && $scope.user.data.contacts.surname.length>0
            && $scope.user.data.contacts.city.length>0
            && $scope.user.data.email.length>0
            && $scope.user.data.contacts.phone.length>0
            && $scope.user.data.contacts.web.length>0
            && $scope.user.data.contacts.cats_amount>0

    }

    $scope.$watch(function() {
        $('select').trigger('refresh');
    })
});