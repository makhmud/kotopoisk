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
                        <div class="refresh"><span class="text">{{cat.shared_count}}</span><span class="gallery-item-gray-3"></span></div> \
                    </div> \
                </div> \
            </li>'
    }
})