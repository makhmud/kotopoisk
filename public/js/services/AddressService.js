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

            $.ajax({
                type:"GET",
                url: 'http://maps.google.com/maps/api/geocode/json',
                data: $.param({
                    address : address,
                    sensor : false
                }),
                dataType: 'json',
                crossDomain: true
            }).done(function ( data ) {
                defer.resolve(data);
            });

            //$http({
            //    url: 'http://maps.google.com/maps/api/geocode/json',
            //    method: "GET",
            //    params: {
            //        address : address,
            //        sensor : false
            //    },
            //    headers: {'Content-Type': 'application/json', 'Access-Control-Allow-Origin':true},
            //    responseType:'JSON'
            //})
            //    .success(function(data){defer.resolve(data)})
            //    .error(function(data){defer.reject(data)});

            return defer.promise;
        }

    };

})