Feature: Compare historical metereological data of a pair of locations for a given year

  Scenario Outline: Compare the average data of a location within a date range
    Given I am on the "location comparison" page
    When I want to compare data for "<location1>" and "<location2>" for "<year>"
    Then I will know that the difference in average rain volume is "<diffAvgRain>" millimetres
    And I will know that the difference in average sun duration is "<diffAvgSun>" days
    And I will know that the difference in average minimum temperature is "<diffAvgTempMin>" degrees
    And I will know that the difference in average maximum temperature is "<diffAvgTempMax>" degrees

    Examples:
      | location1    | location2         | year  | diffAvgRain  | diffAvgSun  | diffAvgTempMin  | diffAvgTempMax  |
      |  Lowestoft   | Heathrow Airport  | 1992  | -1.03        | 11.83       | -0.02           | -1.65           |
      |  Valley      | Oxford            | 1976  | 15.21        | 4.71        | 0.98            | -1.32           |
      |  Eastbourne  | Durham            | 1964  | 26.43        | 39.47       | 3.06            | 0.57            |
      |  Chivenor    | Sheffield         | 1988  | 4.04         | -112.19     | 1.13            | 1.14            |
