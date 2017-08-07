'use strict';

//var hostname = 'localhost:9999';
var hostname = 'backend';

// Declare app level module which depends on views, and components
angular.module('bddTalk', [
  'ngRoute',
  'ngResource',
  'bddTalk.compare_years',
  'bddTalk.compare_locations',
  'bddTalk.version'
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

.factory("LocationPairYearList", function($resource) {
    return $resource("http://" + hostname + "/locations/:id1/:id2/years-both-available");
})

.factory("EntryList", function($resource) {
    return $resource("http://" + hostname + "/entries/:id/:yearFrom/:yearTo");
})

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
