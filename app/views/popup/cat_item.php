<div id="cat-item-popup" class="popup" ng-show="methods.isPopupOpened('cat-item')">
    <div class="controls">
        <a href="#" class="close" ng-click="settings.popupId = null"><span class="gallery-controls-close"></span></a>
        <a href="#" class="prev" ng-hide="settings.popupState.isFirst()" ng-if="settings.popupState.showControls" ng-click="settings.popupState.prev()"><span class="gallery-controls-prev"></span></a>
        <a href="#" class="next" ng-hide="settings.popupState.isLast()" ng-if="settings.popupState.showControls" ng-click="settings.popupState.next()"><span class="gallery-controls-next"></span></a>
    </div>
    <div class="content">
        <div class="image-panel">
            <img src="/user/big_{{data.currentCat.current_photo}}" alt=""/>
            <div class="likes"><a ng-click="like(data.currentCat.id)">
                    <span class="like-icon" ng-class="{active : data.currentCat.hasLike}"></span>
                    <span class="text">{{data.currentCat.likes.length}}</span></a></div>
            <div class="line">
                <div class="map">
                    <a href="#" ng-click="mapView(data.currentCat.position)"><span class="gallery-item-white-2"></span><span class="text" >Посмотреть на карте</span></a>
                </div>
                <div class="like">
                    <a ng-click="like(data.currentCat.id)"><span class="like-icon" ng-class="{active : data.currentCat.hasLike}"></span><span class="text">Мне нравится</span></a>
                </div>
            </div>
        </div>
        <div class="text-panel">
            <div class="gallery-preview">
                <ul style="margin-left: {{settings.galleryPreview.position}}px">
                    <li ng-repeat="photo in data.currentCat.photos">
                        <a href="#" ng-click="data.currentCat.current_photo = photo.path"><img src="/user/small_{{photo.path}}" alt=""/></a>
                    </li>
                </ul>
                <div class="preview-controls">
                    <a href="#" ng-mouseover="galleryBack()"></a>
                    <a href="#" ng-mouseover="galleryNext(data.currentCat.photos.length*120)"></a>
                </div>
            </div>
            <time>{{data.currentCat.created_at}}</time>
            <div class="body">
                {{data.currentCat.content}}
            </div>
            <div class="contacts"><span class="tbold">Контакты:</span> {{data.currentCat.author.contacts.phone}}</div>
            <div class="social-icons" ng-social-buttons="{counter:false}"
                 data-url="$host + '/feed'"
                 data-title="'Котопоиск'"
                 data-description="data.currentCat.content"
                 data-image="$host + '/user/big_' + data.currentCat.current_photo"
                 data-counter="false"
                >
                <a href="#" class="ng-social-vk"><span class="social-icon-1"></span></a>
                <a href="#" class="ng-social-facebook"><span class="social-icon-2"></span></a>
                <a href="#" class="ng-social-twitter"><span class="social-icon-3"></span></a>
                <a href="#" class="ng-social-google-plus"><span class="social-icon-4"></span></a>
                <a href="#" class="ng-social-odnoklassniki"><span class="social-icon-5"></span></a>
            </div>
        </div>

    </div>
</div>