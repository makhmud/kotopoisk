<!doctype html>
<html lang="en" ng-app="app"  ng-controller="MainCtrl">
<head>
    <base href="/"/>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="/images/favicon32.png">
    <link rel="stylesheet" href="/js/lib/bootstrap/dist/css/bootstrap.css"/>
    <title ng-bind="page.title"></title>
</head>
<body>
<div class="container">

    <ul class="nav nav-tabs">
        <li><a href="/admin">Переводы</a></li>
        <li><a href="/admin/user">Пользователи</a></li>
        <li><a href="/admin/cat">Объявления</a></li>
        <li><a href="/admin/general">Администрация</a></li>
    </ul>
    
    {{ $content }}

</div>

</div>
</body>
</html>
