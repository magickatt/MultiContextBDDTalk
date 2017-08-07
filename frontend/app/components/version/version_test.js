'use strict';

describe('bddTalk.version module', function() {
  beforeEach(module('bddTalk.version'));

  describe('version service', function() {
    it('should return current version', inject(function(version) {
      expect(version).toEqual('0.1');
    }));
  });
});
