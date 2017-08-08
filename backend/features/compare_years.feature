Feature: Compare a date range of historical metereological data for a given location

  Scenario Outline: Check the dropdown contains the expected locations
    Given I am on the "year comparison" page
    When I look in the list of locations
    Then I should find "<location>" in the those locations

    Examples:
    | location           |
    |  Heathrow Airport  |
    |  Oxford            |
    |  Durham            |
    |  Sheffield         |

  Scenario Outline: Compare the average data of a location within a date range
    Given I am on the "year comparison" page
    When I want to compare data for "<location>" between "<yearFrom>" and "<yearTo>"
    Then I will know that the average rain volume is "<avgRain>" millimetres
    And I will know that the average sun duration is "<avgSun>" days
    And I will know that the average minimum temperature is "<avgTempMin>" degrees
    And I will know that the average maximum temperature is "<avgTempMax>" degrees

  Examples:
  | location           | yearFrom   | yearTo   | avgRain  | avgSun  | avgTempMin  | avgTempMax  |
  |  Heathrow Airport  | 1974       | 1977     | 50.24    | 129.34  | 6.96        | 14.74       |
