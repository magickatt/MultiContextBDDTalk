Feature: Compare 2 years of historical metereological data for a given location

  Scenario: Check the dropdown contains the expected locations
    Given I am on the "year comparison" page
    When I look in the list of locations
    Then I should find "Heathrow Airport" in the those locations

#  Scenario: Check the dropdown contains the expected locations
#    Given I am on the "year comparison" page
#    When I want to compare data for "Heathrow Airport" between "1981" and "1993"
#    Then I will know that
