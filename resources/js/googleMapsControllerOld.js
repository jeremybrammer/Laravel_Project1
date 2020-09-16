HouseListingApp.controller("HouseDetailsGoogleMapsControllerOld", ['$scope', function ($scope) {
    $scope.map = null;
    $scope.geocoder = null;
    $scope.panorama = null;

    $scope.streetViewService = null;

    $scope.initializeGoogleMap = function(){

        //Google Map example.
        $scope.map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: -34.397, lng: 150.644 },
            zoom: 15
        });

        //Geocoding example.
        let location = null; //Temporary...later these will go in $scope variable as array.
        $scope.geocoder = new google.maps.Geocoder();
        $scope.geocoder.geocode({ 'address': '112 East Hazel Street, Clarence MO, 63437'}, function(results, status){
            if(status === google.maps.GeocoderStatus.OK){
                let formatted_address = results[0].formatted_address;
                location = results[0].geometry.location; //only temporary until I get a $scope array of locations.

                console.log(results[0].geometry.location);
                $scope.map.setCenter(results[0].geometry.location);
                let marker = new google.maps.Marker({
                    map: $scope.map,
                    position: results[0].geometry.location,
                    label: formatted_address
                });



                $scope.streetViewService = new google.maps.StreetViewService();

                let panoramaRequest = {
                    location: location,
                    preference: google.maps.StreetViewPreference.NEAREST,
                    radius: 50,
                    source: google.maps.StreetViewSource.OUTDOOR
                };

                let findPanorama = function(radius){
                    panoramaRequest.radius = radius;
                    $scope.streetViewService.getPanorama(panoramaRequest, function(panoramaData, panoramaStatus){
                        if(panoramaStatus == google.maps.StreetViewStatus.OK){
                            $scope.panorama = new google.maps.StreetViewPanorama(document.getElementById('panorama'), {
                                pano: panoramaData.location.pano
                            });
                            $scope.map.setStreetView($scope.panorama);
                        } else {
                            if(radius > 500){
                                console.log('No street view available.');
                            } else {
                                findPanorama(radius + 100);
                            }
                        }
                    });
                };
                findPanorama(100);
            } else {
                console.log('There was a problem locating this point on the map.');
            }

        });

    };

}]);
