
if (typeof String.prototype.startsWith != 'function') {
    // see below for better implementation!
    String.prototype.startsWith = function (str){
        return this.indexOf(str) == 0;
    };
}

var temp_placeholder = '';

$(document).on('focus', 'form input', function() {
    temp_placeholder = $(this).attr('placeholder');
    $(this).attr('placeholder', '');
});
$(document).on('blur', 'form input', function() {
    $(this).attr('placeholder', temp_placeholder);
    temp_placeholder = '';
});

var adaptMapHeight = function( isMapPage ) {
    if (typeof isMapPage == 'undefined') { isMapPage == false };

    var fixture = isMapPage ? 93 : 0

    setTimeout(function() {
        console.log($('.main > h1'));
        $('.angular-google-map-container').height(
            $(document).height()
            - $('header').height()
            - 56 - 20
            - $('#map-location-selector').height() - 15
            - $('.banner').height()
            + fixture
        );
    }, 100);
}

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

app.filter('nl2br', function($sce){
    return function(msg,is_xhtml) {
        var is_xhtml = is_xhtml || true;
        var breakTag = (is_xhtml) ? '<br />' : '<br>';
        var msg = (msg + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
        return $sce.trustAsHtml(msg);
    }
});