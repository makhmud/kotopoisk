<div id="map-wrap">
    <ui-gmap-google-map id="map" center="settings.map.center" zoom="settings.map.zoom">
        <div ng-repeat="cat in data.cats">
            <ui-gmap-marker idKey='marker-cat.id'
                            coords='cat.position'
                            icon="'http://localhost:8000/images/map-marker.png'"
                            options="{
                                labelContent:parseCatToMarker(cat),
                                    labelAnchor: '-25 70'
                            }"
                            click="showCat(cat.id)">
            </ui-gmap-marker>
        </div>

    </ui-gmap-google-map>
</div>

<?php echo View::make('popup._popup')->with( array('popupIds'=> array('cat_item') ) ) ?>