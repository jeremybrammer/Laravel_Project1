const { reject } = require('lodash');

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
                console.log(response.data);
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
                console.log(response.data);
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
                console.log(response.data);
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

    $scope.init = function(){
        console.log('House listing search bar initializing...');
        $scope.houseListingSearchBarOptions = [
            'All Listings',
            'Search by Zip Code',
            'Search by State'
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
