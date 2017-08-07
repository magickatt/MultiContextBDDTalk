'use strict';

angular.module('bddTalk.compare_locations', ['ngRoute'])

.config(['$routeProvider', function($routeProvider) {
  $routeProvider.when('/compare_locations', {
    templateUrl: 'compare_locations/compare_locations.html',
    controller: 'CompareLocationsCtrl'
  });
}])

.controller('CompareLocationsCtrl', ['$scope', 'LocationList', 'LocationPairYearList', 'LocationPairEntryList', function($scope, LocationList, LocationPairYearList, LocationPairEntryList) {

    $scope.locationList = [];

    var locations = LocationList.get({}, function() {
        $scope.locationList = locations.data;
    });

    $scope.onLocationChange = function () {
        if ($scope.selectedLocation1 !== null && $scope.selectedLocation2 !== null) {
            var years = LocationPairYearList.get({ id1: $scope.selectedLocation1, id2: $scope.selectedLocation2 }, function() {
                $scope.yearList = years.data;
            });
        } else {
            $scope.yearList = [];
        }
    };

    $scope.onYearChange = function() {
        if ($scope.selectedLocation1 !== null && $scope.selectedLocation2 !== null) {
            var entries = LocationPairEntryList.get({ id1: $scope.selectedLocation1, id2: $scope.selectedLocation2, year: $scope.selectedYear}, function() {
                $scope.entries = entries;
            });
        }
    }

}]);

