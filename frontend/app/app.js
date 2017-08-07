'use strict';

var hostname = 'localhost:9999';
//var hostname = 'backend';

// Declare app level module which depends on views, and components
angular.module('myApp', [
  'ngRoute',
  'ngResource',
  'myApp.compare_years',
  'myApp.compare_locations',
  'myApp.version'
]).

config(['$locationProvider', '$routeProvider', function($locationProvider, $routeProvider) {
  $locationProvider.hashPrefix('!');
  $routeProvider.otherwise({redirectTo: '/compare_years'});
}])

// Ensure trailing slashes are not stripped from URI
.config(function($resourceProvider) {
    $resourceProvider.defaults.stripTrailingSlashes = false;
})

.factory("Location", function($resource) {
    return $resource("http://" + hostname + "/locations/:id");
})

.factory("LocationList", function($resource) {
    return $resource("http://" + hostname + "/locations/");
})

.factory("LocationYearList", function($resource) {
    return $resource("http://" + hostname + "/locations/:id/years-available");
})

.factory("EntryList", function($resource) {
    return $resource("http://" + hostname + "/entries/:id/:yearFrom/:yearTo");
})

// https://stackoverflow.com/a/21482265
.filter('month', [function() {
    return function (month) {
        var months = ['January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'];
        return months[month - 1];
    }
}]);
