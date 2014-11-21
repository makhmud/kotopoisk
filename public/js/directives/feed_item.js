/**
 * Feed item directive, contains template
 */
app.directive('feedItem', function() {
    return {
        restrict: 'E',
        replace: true,
        template:
            '<li ng-click="showCat(cat.id)"> \
                <div class="image"><img src="/user/big_{{cat.path}}" alt=""/></div> \
                <div class="info"> \
                    <div class="line"> \
                        <div class="name">{{cat.full_name}}</div> \
                        <div class="like">{{cat.count_likes}}<span class="gallery-item-gray-1"></span></div> \
                    </div> \
                    <div class="line"> \
                        <div class="time">{{cat.created_at}}<span class="gallery-item-gray-2"></span></div> \
                        <div class="refresh"><span class="text"></span><span class="gallery-item-gray-3"></span></div> \
                    </div> \
                </div> \
                <div class="social-icons" ng-social-buttons="{}" ng-show="false" \
                data-url="$host +' + "'/feed/'" + ' + cat.id"\
                data-counter="true"\
                >\
                <a href="#" class="ng-social-vk"><span class="social-icon-1"></span></a>\
                <a href="#" class="ng-social-facebook"><span class="social-icon-2"></span></a>\
                <a href="#" class="ng-social-twitter"><span class="social-icon-3"></span></a>\
                <a href="#" class="ng-social-google-plus"><span class="social-icon-4"></span></a>\
                <a href="#" class="ng-social-odnoklassniki"><span class="social-icon-5"></span></a>\
                </div>\
            </li>'
    }
})