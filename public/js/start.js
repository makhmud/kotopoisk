
var temp_placeholder = '';

$(document).on('focus', 'form input', function() {
    temp_placeholder = $(this).attr('placeholder');
    $(this).attr('placeholder', '');
});
$(document).on('blur', 'form input', function() {
    $(this).attr('placeholder', temp_placeholder);
    temp_placeholder = '';
});

var app = angular.module('app',
    [
        'ngRoute',
        'ngResource',
        'ngCookies',
        'infinite-scroll',
        'flow',
        'uiGmapgoogle-maps',
        'pascalprecht.translate',
        'ngSocial',
        'ngTouch',
        'matchmedia-ng'
    ]
);