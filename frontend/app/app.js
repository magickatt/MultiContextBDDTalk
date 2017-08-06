'use strict';

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
    return $resource("http://localhost:9999/locations/:id");
})

.factory("LocationList", function($resource) {
    return $resource("http://localhost:9999/locations/");
});
