<!doctype html>
<html lang="en" ng-app="app"  ng-controller="MainCtrl">
<head>
    <base href="/"/>
	<meta charset="UTF-8">
    <link rel="shortcut icon" href="/images/favicon32.png">
    <?php foreach( array(180, 120, 152, 144, 114, 60, 57, 80, 58, 40, 29, 76, 72, 50) as $size ) : ?>
        <link rel="apple-touch-icon" sizes="<?= $size ?>x<?= $size ?>" href="/images/apple-icons/touch-icon-<?= $size ?>.png">
    <?php endforeach; ?>
	<title ng-bind="page.title | translate"></title>
    <link rel="stylesheet" href="/css/normalize.min.css"/>
    <link rel="stylesheet" href="/js/lib/jquery.formstyler/jquery.formstyler.css"/>
    <link rel="stylesheet" href="/css/style.css"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="MobileOptimized" content="320">
    <meta name="HandheldFriendly" content="true">
    <meta name="apple-mobile-web-app-capable" content="yes">
</head>
<body class="{{page.bodyClasses}}" ng-swipe-right="swipeRight()" ng-swipe-left="swipeLeft()">

<div class="main-container wrapper">
    <div class="side-menu {{ (settings.isSideMenuOpened) ? 'open' : '' }}" ng-if="!page.isMain">
        <div class="element-container">
            <form>
                <input type="search" class="search-icon" ng-model="searchText" placeholder="{{'search_placeholder' | translate}}"/>
                <input type="submit" class="search-icon" ng-click="find(searchText)" ng-disabled="searchText.length==0" value=""/>
            </form>
            <a ng-click="addCatLink()" class="add-cat" ng-bind="'menu.add_cat' | translate "></a>

            <nav>
                <a href="/feed" class="icon-feed" ng-bind="'page.feed.title' | translate "></a>
                <a href="/map" class="icon-map" ng-bind="'page.map.title' | translate "></a>
                <a href="/profile" class="icon-profile" ng-if="settings.auth" ng-bind="'page.profile.title' | translate "></a>
                <a href="/about" class="icon-about" ng-bind="'page.about.title' | translate "></a>
            </nav>
            <a href="/" class="signin" ng-if="!settings.auth" ng-bind="'menu.in' | translate"></a>
            <a ng-click="logout()" class="signin" ng-if="settings.auth" ng-bind="'menu.out' | translate"></a>
        </div>
    </div>
    <header class="clearfix" ng-if="page.isMain">
        <div class="member-counter"><span><span ng-bind="page.userCount"></span> <span ng-bind="'page.main.participants' | translate"></span></span></div>
        <nav class="language-switch">
            <ul>
                <li><a ng-click="changeLocale('ru')" ng-class="{active : isLocale('ru') }">Рус</a></li>
                <li><a ng-click="changeLocale('en')" ng-class="{active : isLocale('en') }">Eng</a></li>
            </ul>
        </nav>
        <a href="/about" class="about-nav" ng-bind="'page.about.title' | translate"></a>
    </header>

    <header class="wrapper clearfix" ng-if="!page.isMain">
        <a href="#" class="menu-button" ng-click="methods.toggleSideMenu()" ng-bind="'menu.name' | translate "></a>

        <div class="member-counter ta-right"><span ng-bind="page.userCount"></span></div>
    </header>
    <div class="notification" ng-if="notification!=''"  ng-click="notificate('')">
        <span ng-bind-html="notification"></span>
    </div>

    <div class="main wrapper clearfix"  ng-click="notificate('')">
        <h1 ng-bind="page.title | translate"  ng-if="!page.isMain"></h1>

            <div ng-view></div>

    </div>




    </div>
<div class="banner">
    <img src="/images/iphone.jpg" alt=""/>
</div>

    <script src="//maps.googleapis.com/maps/api/js?sensor=false"></script>

<?=
Minify::javascript([
    "/js/lib/jquery/jquery.js",
    "/js/lib/jquery.formstyler/jquery.formstyler.min.js",
    "/js/lib/jquery.inputmask/dist/inputmask/jquery.inputmask.js",
    "/js/lib/jquery.inputmask/dist/inputmask/jquery.inputmask.extensions.js",
]);
?>
    <!--Angular primary libs-->
<?=
Minify::javascript([
    "/js/lib/angular/angular.min.js",
    "/js/lib/angular-route/angular-route.min.js",
    "/js/lib/angular-resource/angular-resource.min.js",
    "/js/lib/angular-cookies/angular-cookies.min.js",
]);
?>
    <!--End Angular primary libs-->

    <!--Angular secondary libs-->
<?=
Minify::javascript([
    "/js/lib/ng-infinite-scroller-origin/build/ng-infinite-scroll.min.js",
    "/js/lib/flow.js/dist/flow.min.js",
    "/js/lib/ng-flow/dist/ng-flow.min.js",
    "/js/lib/angular-translate/angular-translate.min.js",
    "/js/lib/angular-translate-loader-static-files/angular-translate-loader-static-files.min.js",
    "/js/lib/angular-social/angular-social.src.js",
    "/js/lib/angular-touch/angular-touch.min.js",
    "/js/lib/matchmedia/matchMedia.js",
    "/js/lib/matchmedia-ng/matchmedia-ng.js",
]);
?>

    <!--End Angular secondary libs-->

    <!--GMap Directive with dependencies-->
<?=
    Minify::javascript([
        '/js/lib/lodash/dist/lodash.min.js',
        '/js/lib/bluebird/js/browser/bluebird.js',
        '/js/lib/angular-google-maps/dist/angular-google-maps.min.js',
    ]);
?>
<!--    <script src="/js/lib/lodash/dist/lodash.min.js"></script>-->
<!--    <script src="/js/lib/bluebird/js/browser/bluebird.js"></script>-->
<!--    <script src="/js/lib/angular-google-maps/dist/angular-google-maps.min.js"></script>-->
    <!--End GMap-->

    <script src="/js/start.js"></script>

    <!--Services-->
<?= Minify::javascriptDir('/js/services/') ?>
<!--    <script src="/js/services/AddressService.js"></script>-->
<!--    <script src="/js/services/AuthService.js"></script>-->
    <!--End Services-->

    <!--Main Application-->
<?= Minify::javascript('/js/app.js') ?>
<!--    <script src="/js/app.js"></script>-->

    <!--Models-->
    <script src="/js/models/Cat.js"></script>
    <script src="/js/models/User.js"></script>
    <!--End Models-->

    <!--Directives-->
    <?= Minify::javascriptDir('/js/directives/') ?>
<!--    <script src="/js/directives/feed_item.js"></script>-->
    <!--End Directives-->

    <!--Controllers-->
    <?= Minify::javascriptDir('/js/controllers/') ?>
<!--    <script src="/js/controllers/MainController.js"></script>-->
<!--    <script src="/js/controllers/page/IndexController.js"></script>-->
<!--    <script src="/js/controllers/page/FeedController.js"></script>-->
<!--    <script src="/js/controllers/page/SearchController.js"></script>-->
<!--    <script src="/js/controllers/page/MapController.js"></script>-->
<!--    <script src="/js/controllers/page/AboutController.js"></script>-->
<!--    <script src="/js/controllers/page/LoginController.js"></script>-->
<!--    <script src="/js/controllers/page/ProfileController.js"></script>-->
<!--    <script src="/js/controllers/page/AddCatController.js"></script>-->
    <!--End Controllers-->

</body>
</html>
