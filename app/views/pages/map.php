<div id="map-wrap">
    <ui-gmap-google-map id="map" center="settings.map.center" zoom="settings.map.zoom" options="settings.map.options">
        <div ng-repeat="cat in data.cats">
            <ui-gmap-marker idKey='marker-cat.id'
                            coords='cat.position'
                            icon="$host + '/images/map-marker.png'"
                            options="{
                                labelContent:parseCatToMarker(cat),
                                labelAnchor: '25 70'
                            }"
                            events="{
                                    mouseover : markerEvents.markerOver(cat.id),
                                    mouseout : markerEvents.markerOut(cat.id)
                                }"
                            click="showCat(cat.id, true)"
                            mouseover="markerClicked(1)">
            </ui-gmap-marker>
        </div>

    </ui-gmap-google-map>
</div>

<?php echo View::make('popup._popup')->with( array('popupIds'=> array('cat_item', 'login') ) ) ?>