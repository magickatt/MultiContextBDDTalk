'use strict';

angular.module('myApp.compare_years', ['ngRoute'])

.config(['$routeProvider', function($routeProvider) {
  $routeProvider.when('/compare_years', {
    templateUrl: 'compare_years/compare_years.html',
    controller: 'CompareYearsCtrl'
  });
}])

.controller('CompareYearsCtrl', [function() {

}]);