'use strict';

angular.module('myApp.compare_locations', ['ngRoute'])

.config(['$routeProvider', function($routeProvider) {
  $routeProvider.when('/compare_locations', {
    templateUrl: 'compare_locations/compare_locations.html',
    controller: 'CompareLocationsCtrl'
  });
}])

.controller('CompareLocationsCtrl', ['$scope', 'LocationList', 'LocationYearList', 'EntryList', function($scope, LocationList, LocationYearList, EntryList) {

    $scope.locationList = [];

    var locations = LocationList.get({}, function() {
        console.log(locations);
        $scope.locationList = locations.data;
    });

    $scope.onLocationChange = function () {
        $scope.selectedYearFrom = null;
        $scope.selectedYearTo = null;
        $scope.entries = [];
        var years = LocationYearList.get({ id: $scope.selectedLocation }, function() {
            console.log(years);
            $scope.yearList = years.data;
        });
    };

    $scope.onYearChange = function() {
        if ($scope.selectedYearFrom !== null || $scope.selectedYearTo !== null && $scope.selectedYearTo >= $scope.selectedYearFrom) {
            var entries = EntryList.get({ id: $scope.selectedLocation, yearFrom: $scope.selectedYearFrom, yearTo: $scope.selectedYearTo}, function() {
                $scope.entries = entries;
            });
        }
    }

}]);

