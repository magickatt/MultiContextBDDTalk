'use strict';

// Hostname of the REST API
var hostname = 'backend:9999';

// Declare application-level module which depends on views, and components
angular.module('bddTalk', [
  'ngRoute',
  'ngResource',
  'bddTalk.compare_years',
  'bddTalk.compare_locations',
  'bddTalk.version'
]).

// Default routing
config(['$locationProvider', '$routeProvider', function($locationProvider, $routeProvider) {
  $locationProvider.hashPrefix('!');
  $routeProvider.otherwise({redirectTo: '/compare_years'});
}])

// Ensure trailing slashes are not stripped from URI
.config(function($resourceProvider) {
    $resourceProvider.defaults.stripTrailingSlashes = false;
})

// Information about a specific location
.factory("Location", function($resource) {
    return $resource("http://" + hostname + "/locations/:id");
})

// List of all locations
.factory("LocationList", function($resource) {
    return $resource("http://" + hostname + "/locations/");
})

// Years that a location will have entries available for
.factory("LocationYearList", function($resource) {
    return $resource("http://" + hostname + "/locations/:id/years-available");
})

// Year that a pair of locations will be have entries available for
.factory("LocationPairYearList", function($resource) {
    return $resource("http://" + hostname + "/locations/:id1/:id2/years-both-available");
})

// List of entries for a specific location between a date range
.factory("EntryList", function($resource) {
    return $resource("http://" + hostname + "/entries/:id/:yearFrom/:yearTo");
})

// List of entries for a pair of locations for a specific year
.factory("LocationPairEntryList", function($resource) {
    return $resource("http://" + hostname + "/entries/:id1/:id2/:year/compare");
})

// https://stackoverflow.com/a/21482265
.filter('month', [function() {
    return function (month) {
        var months = ['January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'];
        return months[month - 1];
    }
}]);
