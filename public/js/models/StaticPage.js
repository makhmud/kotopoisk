app.factory('StaticPage', function($resource) {

    /**
     * Static page resource
     * @type Promise
     */
    return $resource(
        '/api/static-page/:key',
        { key: "@key" }
    )
})