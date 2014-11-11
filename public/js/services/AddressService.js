/**
 * $http.get('http://maps.google.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&sensor=false').success(function(mapData) {
      angular.extend($scope, mapData);
    });
 */
app.factory('AddressService', function($http, $q) {

    return {
        /**
         * Return promise with responsed data from Google
         * @param address
         * @returns {*}
         */
        getCoordsByAddress : function(address) {
            var defer = $q.defer();
            $http({
                url: 'http://maps.google.com/maps/api/geocode/json',
                method: "GET",
                params: {
                    address : address,
                    sensor : false
                },
                headers: {'Content-Type': 'application/json', 'Access-Control-Allow-Origin':true},
                responseType:'JSON'
            })
                .success(function(data){defer.resolve(data)})
                .error(function(data){defer.reject(data)});

            return defer.promise;
        }

    };

})