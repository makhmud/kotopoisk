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
            <button type="button" class="text-center" id="add-more-photo" flow-btn flow-attrs="{accept:'image/*'}" ng-show="newCat.photos.length > 0" ng-bind="'page.add.more_photo' | translate"></button>
        </div>
        <textarea placeholder="{{'page.add.comment' | translate}}" ng-model="newCat.comment" required="required"></textarea>
        <textarea placeholder="{{'page.add.contacts' | translate}}" ng-model="newCat.contacts" required="required"></textarea>
        <a id="location-selector" ng-click="showCurrentMap()" ng-bind="page.mapButtonText | translate"></a>
        <input type="hidden" ng-model="newCat.position" />
        <input type="submit" value="Добавить" ng-disabled="AddCatForm.$invalid" ng-click="saveCat()"/>
    </form>
</main>
<div id="map-wrap" ng-if="settings.showChooseMapPosition">
    <button ng-click="settings.showChooseMapPosition = false" id="map-location-selector" ng-bind="'page.add.map_save' | translate"></button>
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