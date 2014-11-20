<div class="main-switch" ng-if="!page.search">
    <a href="javascript:void()" class="{{(settings.catsOrder==null)?'active':''}}" ng-click="reOrder()" ng-bind="'page.feed.new' | translate">

    </a><a href="javascript:void()" class="{{(settings.catsOrder!=null)?'active':''}}" ng-click="reOrder('count_likes')" ng-bind="'page.feed.popular' | translate">Популярное</a>
</div>
<h2  ng-if="page.search"><span ng-bind="searchString"></span> (<span class="tyellow" ng-bind="searchCount"></span>)</h2>
<ul id="gallery" infinite-scroll="delayLoad()">
    <feed-item ng-repeat="cat in data.cats"></feed-item>
</ul>


    <?php echo View::make('popup._popup')->with( array('popupIds'=> array('cat_item') ) ) ?>
