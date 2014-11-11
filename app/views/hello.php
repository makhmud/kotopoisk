<!doctype html>
<html lang="en" ng-app="app"  ng-controller="MainCtrl">
<head>
    <base href="/"/>
	<meta charset="UTF-8">
    <link rel="shortcut icon" href="/images/favicon32.png">
	<title ng-bind="page.title"></title>
    <link rel="stylesheet" href="/css/normalize.min.css"/>
    <link rel="stylesheet" href="/js/lib/jquery.formstyler/jquery.formstyler.css"/>
    <link rel="stylesheet" href="/css/style.css"/>
</head>
<body class="{{page.bodyClasses}}">

<div class="main-container wrapper">
    <div class="side-menu {{ (settings.isSideMenuOpened) ? 'open' : '' }}" ng-if="!page.isMain">
        <div class="element-container">
            <form>
                <input type="search" class="search-icon" placeholder="Поиск..."/>
            </form>
            <a href="/add-cat" class="add-cat">+ Добавить котэ</a>

            <nav>
                <a href="/feed" class="icon-feed">Лента</a>
                <a href="/map" class="icon-map">Карта</a>
                <a href="/profile" class="icon-profile">Профиль</a>
                <a href="/about" class="icon-about">О проекте</a>
            </nav>

            <a href="/" class="signin">Войти</a>
        </div>
    </div>

    <header class="clearfix" ng-if="page.isMain">
        <div class="member-counter"><span>{{page.userCount}} участников</span></div>
        <nav class="language-switch">
            <ul>
                <li><a ng-click="changeLocale('ru')" ng-class="{active : isLocale('ru') }">Рус</a></li>
                <li><a ng-click="changeLocale('en')" ng-class="{active : isLocale('en') }">Eng</a></li>
            </ul>
        </nav>
        <a href="/about" class="about-nav">О проекте</a>
    </header>

    <header class="wrapper clearfix" ng-if="!page.isMain">
        <a href="#" class="menu-button" ng-click="methods.toggleSideMenu()">Меню</a>

        <div class="member-counter ta-right"><span>{{page.userCount}}</span></div>
    </header>

    <div class="main wrapper clearfix">
        <h1 ng-bind="page.title"  ng-if="!page.isMain"></h1>

            <div ng-view></div>

    </div>


    </div>

    <script src="//maps.googleapis.com/maps/api/js?sensor=false"></script>

    <script src="/js/lib/jquery/jquery.js"></script>
    <script src="/js/lib/jquery.formstyler/jquery.formstyler.js"></script>

    <!--Angular primary libs-->
    <script src="/js/lib/angular/angular.min.js"></script>
    <script src="/js/lib/angular-route/angular-route.min.js"></script>
    <script src="/js/lib/angular-resource/angular-resource.min.js"></script>
    <script src="/js/lib/angular-cookies/angular-cookies.min.js"></script>
    <!--End Angular primary libs-->

    <!--Angular secondary libs-->
    <script src="/js/lib/ng-infinite-scroller-origin/build/ng-infinite-scroll.min.js"></script>
    <script src="/js/lib/flow.js/dist/flow.min.js"></script>
    <script src="/js/lib/ng-flow/dist/ng-flow.min.js"></script>
    <script src="/js/lib/angular-translate/angular-translate.min.js"></script>
    <script src="/js/lib/angular-translate-loader-static-files/angular-translate-loader-static-files.min.js"></script>
    <!--End Angular secondary libs-->

    <!--GMap Directive with dependencies-->
    <script src="/js/lib/lodash/dist/lodash.min.js"></script>
    <script src="/js/lib/bluebird/js/browser/bluebird.js"></script>
    <script src="/js/lib/angular-google-maps/dist/angular-google-maps.min.js"></script>
    <!--End GMap-->

    <script src="/js/start.js"></script>

    <!--Services-->
    <script src="/js/services/AddressService.js"></script>
    <script src="/js/services/AuthService.js"></script>
    <!--End Services-->

    <!--Main Application-->
    <script src="/js/app.js"></script>

    <!--Models-->
    <script src="/js/models/Cat.js"></script>
    <script src="/js/models/User.js"></script>
    <!--End Models-->

    <!--Directives-->
    <script src="/js/directives/feed_item.js"></script>
    <!--End Directives-->

    <!--Controllers-->
    <script src="/js/controllers/MainController.js"></script>
    <script src="/js/controllers/page/IndexController.js"></script>
    <script src="/js/controllers/page/FeedController.js"></script>
    <script src="/js/controllers/page/MapController.js"></script>
    <script src="/js/controllers/page/AboutController.js"></script>
    <script src="/js/controllers/page/LoginController.js"></script>
    <script src="/js/controllers/page/ProfileController.js"></script>
    <script src="/js/controllers/page/AddCatController.js"></script>
    <!--End Controllers-->

</body>
</html>
