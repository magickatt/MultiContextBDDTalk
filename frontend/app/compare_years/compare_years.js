'use strict';

angular.module('bddTalk.compare_years', ['ngRoute'])

    .config(['$routeProvider', function($routeProvider) {
        $routeProvider.when('/compare_years', {
            templateUrl: 'compare_years/compare_years.html',
            controller: 'CompareYearsCtrl'
        });
    }])

    .controller('CompareYearsCtrl', ['$scope', 'LocationList', 'LocationYearList', 'EntryList', function($scope, LocationList, LocationYearList, EntryList) {

        $scope.entries = [];
        $scope.aggregates = [];
        $scope.locationList = [];
        $scope.yearList = [];

        var locations = LocationList.get({}, function() {
            $scope.locationList = locations.data;
        });

        $scope.onLocationChange = function () {
            $scope.selectedYearFrom = null;
            $scope.selectedYearTo = null;
            $scope.entries = [];
            $scope.aggregates = [];
            var years = LocationYearList.get({ id: $scope.selectedLocation }, function() {
                $scope.yearList = years.data;
            });
        };

        $scope.onYearChange = function() {
            if (($scope.selectedYearFrom !== null || $scope.selectedYearTo !== null) && $scope.selectedYearTo >= $scope.selectedYearFrom) {
                var entries = EntryList.get({ id: $scope.selectedLocation, yearFrom: $scope.selectedYearFrom, yearTo: $scope.selectedYearTo}, function() {
                    $scope.entries = entries.data;
                    $scope.aggregates = entries.meta;
                });
            }
        }

    }]);

