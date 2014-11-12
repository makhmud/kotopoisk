app.controller('MapCtrl', function($scope, $resource, Cat) {

    console.log('In Map Controller');

    $scope.page.title = 'Map';
    $scope.page.bodyClasses = 'page--map';
    $scope.page.isMain = false;

    var currentPosition = 0;

    $scope.ids.first = null;
    $scope.ids.last = null;
    $scope.data.cats = [];
    $scope.settings.lockDelayLoad = false;
    $scope.settings.popupState.showControls = false;

    $scope.catsLoad(currentPosition);

    $scope.parseCatToMarker = function(cat) {
        return '<div class="map-info '+(($scope.settings.map.zoom<7)?'ng-hide':'')+'" > \
                <div class="image"><img src="/user/small_'+cat.path+'" alt=""/></div> \
                <div class="info"> \
                    <div class="name">'+cat.full_name+'</div> \
                    <div class="line"> \
                        <time>'+cat.created_at+'</time> \
                        <div class="refresh"><span class="gallery-item-icon-gray-2"></span><span class="text">'+cat.count_likes+'</span></div> \
                        <div class="likes"><span class="gallery-item-icon-gray-1"></span><span class="text">17</span></div> \
                    </div> \
                </div> \
            </div>';
    }

    $scope.catsLoad(0);
});