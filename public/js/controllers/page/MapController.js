app.controller('MapCtrl', function($scope, $resource, Cat, $filter, matchmedia) {

    console.log('In Map Controller');

    $scope.page.title = 'page.map.title';
    $scope.page.bodyClasses = 'page--map';
    $scope.page.isMain = false;
    $scope.notification = '';
    $scope.settings.isSideMenuOpened = false;
    $scope.methods.closePopup();
    $scope.settings.loginForms.active = 'signin';

    $scope.settings.popupState.showControls = false;

    console.log($scope.data.cats.length);

    if ($scope.data.cats.length == 0) {
        $scope.ids.first = null;
        $scope.ids.last = null;
        $scope.settings.lockDelayLoad = false;
        $scope.catsLoad(0);
    }
    //

    $scope.parseCatToMarker = function(cat) {
        return '<div id="map-info-'+cat.id+'" class="map-info '+(($scope.settings.map.zoom<7)?'ng-hide':'')+'" > \
                <div class="image"><img src="/user/small_'+cat.path+'" alt=""/></div> \
                <div class="info"> \
                    <div class="name">'+cat.full_name+'</div> \
                    <div class="line"> \
                        <time>'+cat.created_at+'</time> \
                        <div class="refresh"><span class="gallery-item-gray-3"></span><span class="text">'+cat.shared_count+'</span></div> \
                        <div class="likes"><span class="gallery-item-gray-1"></span><span class="text">'+cat.count_likes+'</span></div> \
                    </div> \
                </div> \
            </div>';
    }

    $scope.settings.map.MarkerOptions = function(cat) {
        return {
            labelContent:$scope.parseCatToMarker(cat),
                labelAnchor: '-25 70',
                mouseover : function(mapModel, eventName, originalEventArgs) {
                    console.log(123);
                }
        }
    }

    $scope.markerEvents = {
        markerOver : function(id) {
            return function(obj, event, some) {
                $('#map-info-'+id).addClass('hovered');
            }
        },
        markerOut : function(id) {
            return function(obj, event, some) {
                $('#map-info-'+id).removeClass('hovered');
            }
        }
    }

    if(matchmedia.isPhone()){
        adaptMapHeight(true);
    }
});