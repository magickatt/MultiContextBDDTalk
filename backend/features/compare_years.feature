Feature: Compare a date range of historical metereological data for a given location

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
  |  Oxford            | 2001       | 2005     | 54.22    | 133.19  | 7.11        | 15.24       |
  |  Durham            | 1998       | 1999     | 60.11    | 119.19  | 5.80        | 13.15       |
  |  Sheffield         | 1982       | 1986     | 71.28    | 108.59  | 6.07        | 12.87       |
