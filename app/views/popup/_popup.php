<div id="overlay" ng-show="methods.isPopupOpened()">
    <div class="close-overlay" ng-click="settings.popupId = null"></div>
    <?php foreach($popupIds as $popuId): ?>
        <?php echo View::make( 'popup.' . $popuId ) ?>
    <?php endforeach ?>
</div>