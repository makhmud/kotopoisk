<div class="main-switch">
    <a href="javascript:void()" class="{{(settings.catsOrder==null)?'active':''}}" ng-click="reOrder()">Новое</a>
    <a href="javascript:void()" class="{{(settings.catsOrder!=null)?'active':''}}" ng-click="reOrder('count_likes')">Популярное</a>
</div>
<ul id="gallery" infinite-scroll="delayLoad()">
    <feed-item ng-repeat="cat in data.cats"></feed-item>
</ul>


    <?php echo View::make('popup._popup')->with( array('popupIds'=> array('cat_item') ) ) ?>
