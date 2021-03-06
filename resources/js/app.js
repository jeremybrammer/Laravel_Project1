const { reject, map } = require('lodash');

require('./bootstrap');

window.HouseListingApp = angular.module('HouseListingApp', [], function($interpolateProvider){
    //Set the interpolate operators so they don't conflict with Laravel.
    // $interpolateProvider.startSymbol('<%');
    // $interpolateProvider.endSymbol('%>');
});

HouseListingApp.controller("HouseListingController", ['$scope', '$http', '$timeout', '$houseListingsAjaxService', function ($scope, $http, $timeout, $houseListingsAjaxService) {

    $scope.init = function(){
        console.log('Angular.js is working!');
        $scope.isLoading = false;
        //Initialize the page data listings.
        $scope.pageListings = null;
        $scope.searchListings(0); //This sets pageListings.
    };

    angular.element(document).ready(function(){
        //Wait for document to load to stop page flicker.
        document.getElementById("allListingsContainer").style.visibility = "visible";
    });

    $scope.consoleLog = function(value){
        console.log(value);
    };

    //Get all listings without a search term.
    $scope.getAllListings = function(){
        $scope.isLoading = true;
        $houseListingsAjaxService.getAllListings().then((response) => {
            if(!response.error){
                // console.log(response.data);
                $scope.pageListings = response.data;
            } else {
                console.log(response.data + ', ' + error);
            }
            $scope.isLoading = false;
            $scope.$apply();
        });
    };

    $scope.getListingsByZipCode = function(zipCode){
        $scope.isLoading = true;
        $houseListingsAjaxService.getListingsByZipCode(zipCode).then((response) => {
            if(!response.error){
                // console.log(response.data);
                $scope.pageListings = response.data;
            } else {
                console.log(response.data + ', ' + error);
            }
            $scope.isLoading = false;
            $scope.$apply();
        });
    };

    $scope.getListingsByState = function(twoLetterState){
        $scope.isLoading = true;
        $houseListingsAjaxService.getListingsByState(twoLetterState).then((response) => {
            if(!response.error){
                // console.log(response.data);
                $scope.pageListings = response.data;
            } else {
                console.log(response.data + ', ' + error);
            }
            $scope.isLoading = false;
            $scope.$apply();
        });
    };

    $scope.searchListings = function(searchTypeKey, searchTerm = 'none'){
        // console.log(searchTypeKey + ', ' + searchTerm);
        switch(searchTypeKey){
            case 0: $scope.getAllListings(); break;
            case 1: $scope.getListingsByZipCode(searchTerm); break;
            case 2: $scope.getListingsByState(searchTerm); break;
            default: $scope.getAllListings(); break;
        }
    };

}]);

HouseListingApp.controller("HouseListingSearchBarController", ['$scope', '$http', function ($scope, $http) {

    $scope.initSearchBar = function(){
        console.log('House listing search bar initializing...');
        $scope.houseListingSearchBarOptions = [
            'All Listings',
            'Search by Zip Code',
            'Search by State Abbreviation'
        ];
        $scope.houseListingSearchBarSelectedOptionKey = 0;
        $scope.searchInputFieldEnabled = false;
        $scope.searchValue = '';
        $scope.houseListingSearchBarSelectedOption = $scope.houseListingSearchBarOptions[$scope.houseListingSearchBarSelectedOptionKey];
    };

    $scope.setHouseListingSearchBarSelectedOption = function(key){
        $scope.houseListingSearchBarSelectedOptionKey = key;
        $scope.houseListingSearchBarSelectedOption = $scope.houseListingSearchBarOptions[key];
        if(key == 0){
            $scope.searchInputFieldEnabled = false;
        } else {
            $scope.searchInputFieldEnabled = true;
        }
        $scope.searchValue = '';
        $scope.searchListings(key); //From parent controller.
    };

}]);

HouseListingApp.controller("AllHousesGoogleMapsController", ['$scope', function ($scope) {

    $scope.initializeGoogleMap = function(targetAddresses = false){

        console.log('Initializing Google Map.');
        console.log(targetAddresses);
        $scope.mapIsReady = false;

        if(targetAddresses.length > 0){
            //Set parameters.
            let mapDivId = 'map'; //This is the div id the map will display in.

            //Set initial Google Map.  The location will change later.
            let map = new google.maps.Map(document.getElementById(mapDivId), {
                center: { lat: -34.397, lng: 150.644 },
                zoom: 8,
                streetViewControl: false,
                mapTypeId: google.maps.MapTypeId.SATELLITE
            });

            let geocoder = new google.maps.Geocoder();

            let markers = [];

            function geoCodeAsPromise(_target, listingNumber){
                return new Promise((resolve, reject) => {
                    geocoder.geocode({ 'address': _target}, function(geocodeResults, geoCodeStatus){
                        if(geoCodeStatus === google.maps.GeocoderStatus.OK){
                            //Address has been located.
                            let location = geocodeResults[0].geometry.location;

                            // let formatted_address = geocodeResults[0].formatted_address;

                            map.setCenter(location); //Center the map on the found location.

                            //Create a marker for the house.
                            let marker = new google.maps.Marker({
                                map: map,
                                position: location,
                                label: { text: listingNumber.toString(), color: 'white' }
                            });
                            markers.push(marker);
                            // resolve();
                        } else {
                            console.log('There was a problem locating this address.');
                            console.log(_target);
                            // reject();
                        }
                        resolve(true); //Just resolve no matter what for now.
                    });
                });
            }

            let promises = [];

            function intervalLoop(loopLimit){
                let loopIteration = 0;
                let interval = setInterval(() => {
                    //Make API calls here...
                    console.log('Firing geocode call (' + Date.now() + ').');
                    let targetAddressFormatted =
                        targetAddresses[loopIteration].address_street + ', ' +
                        targetAddresses[loopIteration].address_city + ' ' +
                        targetAddresses[loopIteration].address_state + ', ' +
                        targetAddresses[loopIteration].address_zip;
                    promises.push(geoCodeAsPromise(targetAddressFormatted, targetAddresses[loopIteration].listingNumber));

                    loopIteration++; //Increment the count.
                    if(loopIteration === loopLimit){
                        clearInterval(interval);
                        //Proceed with the post-api-call code here...
                        $scope.mapIsReady = true;
                        $scope.$apply();
                        //Wait for all promises from geoCoder to return before setting the map boundaries.
                        Promise.all(promises).then((promiseValues) => {
                            //Extend the boundary of the map to encompass all markers.
                            let bounds = new google.maps.LatLngBounds();
                            for(let i = 0; i < markers.length; i++){
                                bounds.extend(new google.maps.LatLng(markers[i].getPosition().lat(), markers[i].getPosition().lng()));
                            }
                            map.fitBounds(bounds);
                            map.setCenter(bounds.getCenter());

                            //Back off the zoom some if needed.
                            let listener = google.maps.event.addListener(map, "idle", function(){
                                if(map.getZoom() > 16){
                                    map.setZoom(16);
                                }
                                google.maps.event.removeListener(listener);
                            });
                        });
                    }
                }, 500); //Fire off one every 0.5 seconds.
            }
            intervalLoop(targetAddresses.length); //Run the intervalLoop this many times.
        } else {
            $scope.mapIsReady = true;
        }

    };
}]);

HouseListingApp.controller("HouseDetailsGoogleMapsController", ['$scope', function ($scope) {

    $scope.initializeGoogleMap = function(targetAddress = '1600 Pennsylvania Avenue NW, Washington, DC 20500'){

        //Set parameters.
        let mapDivId = 'map'; //This is the div id the map will display in.
        let streetViewDivId = 'panorama'; //This is the div id the street view will display in.
        let panoramaSearchRadiusIncrementInMeters = 50; //50 meters is minimum search radius allowed by API.
        let panoramaMaxSearchRadiusAllowed = 500; //The higher this is, the more calls it can make, and the more money it will cost.

        //Set initial Google Map.  The location will change later.
        let map = new google.maps.Map(document.getElementById(mapDivId), {
            center: { lat: -34.397, lng: 150.644 },
            zoom: 16,
            mapTypeId: google.maps.MapTypeId.SATELLITE
        });

        let geocoder = new google.maps.Geocoder();
        geocoder.geocode({ 'address': targetAddress}, function(geocodeResults, geoCodeStatus){
            if(geoCodeStatus === google.maps.GeocoderStatus.OK){
                //Address has been located.
                let location = geocodeResults[0].geometry.location;
                // let formatted_address = geocodeResults[0].formatted_address;

                map.setCenter(location); //Center the map on the found location.

                //Create a marker for the house.
                let marker = new google.maps.Marker({
                    map: map,
                    position: location
                    // label: formatted_address
                });

                let streetViewService = new google.maps.StreetViewService();

                //Recursive function to find nearest street view to given address.
                function findPanorama(radius){
                    let panoramaRequest = {
                        location: location,
                        preference: google.maps.StreetViewPreference.NEAREST,
                        radius: radius,
                        source: google.maps.StreetViewSource.OUTDOOR
                    };
                    streetViewService.getPanorama(panoramaRequest, function(panoramaData, panoramaStatus){
                        if(panoramaStatus == google.maps.StreetViewStatus.OK){
                            let panoramaOptions = {
                                pano: panoramaData.location.pano,
                                addressControl: false,
                                navigationControl: true,
                                navigationControlOptions: {
                                    style: google.maps.NavigationControlStyle.SMALL
                                }
                            };
                            let panorama = new google.maps.StreetViewPanorama(document.getElementById(streetViewDivId), panoramaOptions);
                            map.setStreetView(panorama); //Set little dude icon on map where street view is.
                        } else {
                            if(radius > panoramaMaxSearchRadiusAllowed){
                                console.log('Max radius reached. No street view available.');
                            } else {
                                console.log('Expanding search radius.');
                                findPanorama(radius + panoramaSearchRadiusIncrementInMeters); //Do recursion.
                            }
                        }
                    });
                }

                findPanorama(panoramaSearchRadiusIncrementInMeters); //Run the function with starting radius.

            } else {
                console.log('There was a problem locating this address.');
            }
        });
    };
}]);

HouseListingApp.factory("$houseListingsAjaxService", function($http){
    let service = {};

    service.getAllListings = function(){
        return new Promise((resolve, reject) => {
            $http.get(APP_URL + '/houses/allAsAjax').then(
                (data, status) => {
                    //Success.
                    resolve({ data: data.data, status: status, error: false });
                },
                (data, status) => {
                    //Error.
                    reject({ data: data, status: status, error: true });
                }
            );
        });
    };

    service.getListingsByZipCode = function(zipCode = 'none'){
        zipCode = (zipCode === '') ? 'none' : zipCode;
        return new Promise((resolve, reject) => {
            $http.get(APP_URL + '/houses/getListingsByZipCodeAjax/' + zipCode).then(
                (data, status) => {
                    //Success.
                    resolve({ data: data.data, status: status, error: false });
                },
                (data, status) => {
                    //Error.
                    reject({ data: data, status: status, error: true });
                }
            );
        });
    };

    service.getListingsByState = function(twoLetterState = 'none'){
        twoLetterState = (twoLetterState === '') ? 'none' : twoLetterState;
        return new Promise((resolve, reject) => {
            $http.get(APP_URL + '/houses/getListingsByStateAjax/' + twoLetterState).then(
                (data, status) => {
                    //Success.
                    resolve({ data: data.data, status: status, error: false });
                },
                (data, status) => {
                    //Error.
                    reject({ data: data, status: status, error: true });
                }
            );
        });
    };

    return service;
});
