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
      |  Lowestoft   | Heathrow Airport  | 1977  | 50.24    | 129.34  | 6.96        | 14.74       |
      |  Valle       | Oxford            | 1977  | 50.24    | 129.34  | 6.96        | 14.74       |
      |  Eastbourne  | Durham            | 1977  | 50.24    | 129.34  | 6.96        | 14.74       |
      |  Chivenor    | Sheffield         | 1977  | 50.24    | 129.34  | 6.96        | 14.74       |
