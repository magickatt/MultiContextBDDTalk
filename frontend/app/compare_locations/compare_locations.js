'use strict';

angular.module('myApp.compare_locations', ['ngRoute'])

.config(['$routeProvider', function($routeProvider) {
  $routeProvider.when('/compare_locations', {
    templateUrl: 'compare_locations/compare_locations.html',
    controller: 'CompareLocationsCtrl'
  });
}])

.controller('CompareLocationsCtrl', ['$scope', 'LocationList', 'LocationYearList', 'EntryList', function($scope, LocationList, LocationYearList, EntryList) {

    // $scope.locationList = [{"id":"heathrow","name":"Heathrow Airport","latitude":51.479,"longitude":-0.449,"amsl":25}];
    $scope.locationList = [];

    var locations = LocationList.get({}, function() {
        console.log(locations);
        $scope.locationList = locations.data;
    });

    var updateGrid = function() {
        var entries = EntryList.get({ id: $scope.selectedLocation, yearFrom: $scope.selectedYearFrom, yearTo: $scope.selectedYearTo}, function() {
            console.log(entries);
        });
    }

    $scope.onLocationChange = function () {
        var years = LocationYearList.get({ id: $scope.selectedLocation }, function() {
            console.log(years);
            $scope.yearList = years.data;
        });
    }

    $scope.onYearChange = function() {
        var entries = EntryList.get({ id: $scope.selectedLocation, yearFrom: $scope.selectedYearFrom, yearTo: $scope.selectedYearTo}, function() {
            $scope.entries = entries;
        });
    }

}]);

