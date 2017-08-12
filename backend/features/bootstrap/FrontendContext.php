<?php

use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert;

class FrontendContext extends MinkContext
{
    const NAME_TO_URI_MAP = [
        'year comparison' => '#!/compare_years',
        'location comparison' => '#!/compare_locations'
    ];

    /**
     * @param string $baseUrl
     */
    public function __construct($baseUrl)
    {
        // Base URL is pre-configured in behat.yml (is required for ApiContext)
    }

    /**
     * @Given I am on the :name page
     */
    public function iAmOnThePage($name)
    {
        $uri = $this->translatePageNameToUri($name);
        $this->visit($uri);
    }

    /**
     * @When I want to compare data for :name between :yearFrom and :yearTo
     */
    public function iWantToCompareDataForBetweenAnd($name, $yearFrom, $yearTo)
    {
        // Select the location and the date range from the dropdowns on the page
        $this->selectOption('location-dropdown', $name);
        $this->selectOption('year-from-dropdown', $yearFrom);
        $this->selectOption('year-to-dropdown', $yearTo);

        // Need to replace this with a spin
        sleep(1);
    }

    /**
     * @Then I will know that the average rain volume is :rainVolume millimetres
     */
    public function iWillKnowThatTheAverageRainVolumeIs($rainVolume)
    {
        $this->assertElementContains('#average-rain-volume', number_format($rainVolume, 1));
    }

    /**
     * @Then I will know that the average sun duration is :days days
     */
    public function iWillKnowThatTheAverageSunDurationIs($days)
    {
        $this->assertElementContains('#average-sun-duration', number_format($days, 1));
    }

    /**
     * @Then I will know that the average minimum temperature is :averageMinimumTemperature degrees
     */
    public function iWillKnowThatTheAverageMinimumTemperatureIs($averageMinimumTemperature)
    {
        $this->assertElementContains('#average-temperature-minimum', number_format($averageMinimumTemperature, 1));
    }

    /**
     * @Then I will know that the average maximum temperature is :averageMaximumTemperature degrees
     */
    public function iWillKnowThatTheAverageMaximumTemperatureIs($averageMaximumTemperature)
    {
        $this->assertElementContains('#average-temperature-maximum', number_format($averageMaximumTemperature, 1));
    }

    /**
     * @When I want to compare data for :locationName1 and :locationName2 for :year
     */
    public function iWantToCompareDataForAndFor($locationName1, $locationName2, $year)
    {
        throw new PendingException();
    }

    /**
     * @Then I will know that the difference in average rain volume is :diffAverageRainVolume millimetres
     */
    public function iWillKnowThatTheDifferenceInAverageRainVolumeIsMillimetres($diffAverageRainVolume)
    {
        throw new PendingException();
    }

    /**
     * @Then I will know that the difference in average sun duration is :differenceAverageSunDuration days
     */
    public function iWillKnowThatTheDifferenceInAverageSunDurationIsDays($diffAverageSunDuration)
    {
        throw new PendingException();
    }

    /**
     * @Then I will know that the difference in average minimum temperature is :diffAverageMinimumTemperature degrees
     */
    public function iWillKnowThatTheDifferenceInAverageMinimumTemperatureIsDegrees($diffAverageMinimumTemperature)
    {
        throw new PendingException();
    }

    /**
     * @Then I will know that the difference in average maximum temperature is :diffAverageMaximumTemperature degrees
     */
    public function iWillKnowThatTheDifferenceInAverageMaximumTemperatureIsDegrees($diffAverageMaximumTemperature)
    {
        throw new PendingException();
    }

    /**
     * @BeforeScenario
     */
    public function resizeViewport(BeforeScenarioScope $scope)
    {
        // Default browser window size is very small, so this will make it bigger
        $this->getSession()->resizeWindow(1024,  768, 'current');
    }

    /**
     * Translate the name of a page to a URI
     * @param string $name
     * @return string
     */
    private function translatePageNameToUri($name)
    {
        // If this fails then the name is missing from the map
        Assert::assertArrayHasKey($name, self::NAME_TO_URI_MAP);

        return self::NAME_TO_URI_MAP[$name];
    }
}
