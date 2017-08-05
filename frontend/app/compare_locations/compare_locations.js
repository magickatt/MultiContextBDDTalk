'use strict';

angular.module('myApp.compare_locations', ['ngRoute'])

.config(['$routeProvider', function($routeProvider) {
  $routeProvider.when('/compare_locations', {
    templateUrl: 'compare_locations/compare_locations.html',
    controller: 'CompareLocationsCtrl'
  });
}])

.controller('CompareLocationsCtrl', [function() {

}]);