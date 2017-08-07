'use strict';

angular.module('bddTalk.version', [
  'bddTalk.version.interpolate-filter',
  'bddTalk.version.version-directive'
])

.value('version', '0.1');
