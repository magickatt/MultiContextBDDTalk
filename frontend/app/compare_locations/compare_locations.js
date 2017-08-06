'use strict';

angular.module('myApp.compare_locations', ['ngRoute'])

.config(['$routeProvider', function($routeProvider) {
  $routeProvider.when('/compare_locations', {
    templateUrl: 'compare_locations/compare_locations.html',
    controller: 'CompareLocationsCtrl'
  });
}])

.controller('CompareLocationsCtrl', ['$scope', 'LocationList', function($scope, LocationList) {

    $scope.selectedLocation = null;
    $scope.locationList = [];

    var locations = LocationList.get({}, function() {
        console.log(locations);
        $scope.locationList = locations.data;
    });

}]);

