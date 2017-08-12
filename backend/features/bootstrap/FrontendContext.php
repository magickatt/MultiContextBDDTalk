<?php

use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert;

class FrontendContext extends MinkContext
{
    const FRONTEND_DECIMAL_PLACES = 1;

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
    public function iWantToCompareDataForBetweenAnd($locationName, $yearFrom, $yearTo)
    {
        // Select the location and the date range from the dropdowns on the page
        $this->selectOption('location-dropdown', $locationName);
        $this->selectOption('year-from-dropdown', $yearFrom);

        // Need to replace this with a spin
        sleep(1);

        $this->selectOption('year-to-dropdown', $yearTo);

        // Need to replace this with a spin
        sleep(1);
    }

    /**
     * @Then I will know that the average rain volume is :rainVolume millimetres
     */
    public function iWillKnowThatTheAverageRainVolumeIs($rainVolume)
    {
        $this->assertElementContains(
            '#average-rain-volume',
            $this->roundNumberForFrontend($rainVolume)
        );
    }

    /**
     * @Then I will know that the average sun duration is :days days
     */
    public function iWillKnowThatTheAverageSunDurationIs($days)
    {
        $this->assertElementContains(
            '#average-sun-duration',
            $this->roundNumberForFrontend($days)
        );
    }

    /**
     * @Then I will know that the average minimum temperature is :averageMinimumTemperature degrees
     */
    public function iWillKnowThatTheAverageMinimumTemperatureIs($averageMinimumTemperature)
    {
        $this->assertElementContains(
            '#average-temperature-minimum',
            $this->roundNumberForFrontend($averageMinimumTemperature)
        );
    }

    /**
     * @Then I will know that the average maximum temperature is :averageMaximumTemperature degrees
     */
    public function iWillKnowThatTheAverageMaximumTemperatureIs($averageMaximumTemperature)
    {
        $this->assertElementContains(
            '#average-temperature-maximum',
            $this->roundNumberForFrontend($averageMaximumTemperature)
        );
    }

    /**
     * @When I want to compare data for :locationName1 and :locationName2 for :year
     */
    public function iWantToCompareDataForAndFor($locationName1, $locationName2, $year)
    {
        // Select the location and the date range from the dropdowns on the page
        $this->selectOption('location-dropdown', $locationName1);
        $this->selectOption('additional-location-dropdown', $locationName2);
        $this->selectOption('year-dropdown', $year);

        // Need to replace this with a spin
        sleep(1);
    }

    /**
     * @Then I will know that the difference in average rain volume is :diffAverageRainVolume millimetres
     */
    public function iWillKnowThatTheDifferenceInAverageRainVolumeIsMillimetres($diffAverageRainVolume)
    {
        $this->assertElementContains('#difference-average-rain-volume', $this->roundNumberForFrontend($diffAverageRainVolume));
    }

    /**
     * @Then I will know that the difference in average sun duration is :differenceAverageSunDuration days
     */
    public function iWillKnowThatTheDifferenceInAverageSunDurationIsDays($diffAverageSunDuration)
    {
        $this->assertElementContains('#difference-average-sun-duration', $this->roundNumberForFrontend($diffAverageSunDuration));
    }

    /**
     * @Then I will know that the difference in average minimum temperature is :diffAverageMinimumTemperature degrees
     */
    public function iWillKnowThatTheDifferenceInAverageMinimumTemperatureIsDegrees($diffAverageMinimumTemperature)
    {
        $this->assertElementContains('#difference-average-temperature-minimum', $this->roundNumberForFrontend($diffAverageMinimumTemperature));
    }

    /**
     * @Then I will know that the difference in average maximum temperature is :diffAverageMaximumTemperature degrees
     */
    public function iWillKnowThatTheDifferenceInAverageMaximumTemperatureIsDegrees($diffAverageMaximumTemperature)
    {
        $this->assertElementContains('#difference-average-temperature-maximum', $this->roundNumberForFrontend($diffAverageMaximumTemperature));
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

    /**
     * Round a number the way the front-end will
     * @param float $number
     * @return string
     */
    private function roundNumberForFrontend($number)
    {
        if (round($number, self::FRONTEND_DECIMAL_PLACES) == 0) {
            return number_format(0, self::FRONTEND_DECIMAL_PLACES);
        }
        return number_format($number, self::FRONTEND_DECIMAL_PLACES);
    }
}
