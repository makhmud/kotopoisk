<main ng-show="!settings.showChooseMapPosition">
    <form id="add-cat" name="AddCatForm" enctype='multipart/form-data'>
        <div flow-init="ngFlowParams" flow-files-submitted="$flow.upload()" flow-file-success="newCat.photos.push($message)">
            <div id="photos" >
                <ul class="photo-preview">
                    <li ng-repeat="file in $flow.files">
                        <div class="progress progress-striped" ng-class="{active: file.isUploading()}">
                            <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" ng-style="{width: (file.progress() * 100) + '%'}" style="width: 100%;">
                            </div>
                        </div>
                        <img flow-img="file"/>
                    </li>
                </ul>
                <div class="file-button-container-big"  ng-show="newCat.photos.length == 0">
                    <input type="file" multiple class="photo-file-input" flow-btn flow-attrs="{accept:'image/*'}"/>
                    <img src="/images/add-photo-button-icon.png" class="photo-file-preview" alt=""/>
                </div>
            </div>
            <button type="button" class="text-center" id="add-more-photo" flow-btn ng-show="newCat.photos.length > 0">+ добавить еще фото</button>
        </div>
        <textarea placeholder="Комментарий*" ng-model="newCat.comment" required="required"></textarea>
        <textarea placeholder="Контакты*" ng-model="newCat.contacts" required="required"></textarea>
        <input type="text" placeholder="Адрес*" ng-keyup="doSearch()" ng-model="newCat.address"/>
        <span>или</span>
        <a id="location-selector" ng-click="showCurrentMap()">Указать место на карте</a>
        <input type="hidden" ng-model="newCat.position" />
        <input type="submit" value="Добавить" ng-disabled="AddCatForm.$invalid" ng-click="saveCat()"/>
    </form>
</main>
<div id="map-wrap" ng-if="settings.showChooseMapPosition">
    <button ng-click="settings.showChooseMapPosition = false" id="map-location-selector">Сохранить</button>
    <ui-gmap-google-map id="map"
                        center="settings.map.positionMap.center"
                        zoom="settings.map.positionMap.zoom"
                        options="settings.map.options">
            <ui-gmap-marker idKey='choose-position'
                            options="{ draggable : true }"
                            coords='newCat.position'
                            icon="$host + '/images/map-marker.png'"></ui-gmap-marker>

    </ui-gmap-google-map>
</div>