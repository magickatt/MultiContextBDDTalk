<?php

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
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct($baseUrl)
    {

    }

    /**
     * @BeforeScenario
     */
    public function resizeViewport(\Behat\Behat\Hook\Scope\BeforeScenarioScope $scope) {
        $this->getSession()->resizeWindow(1280, 1024, 'current');
    }

    /**
     * @Given I am on the :name page
     */
    public function iAmOnThePage($name)
    {
        Assert::assertArrayHasKey($name, self::NAME_TO_URI_MAP);
        $this->visit(self::NAME_TO_URI_MAP[$name]);
        //$this->pressButton('compare-years-button');
    }

    /**
     * @When I look in the list of locations
     */
    public function iLookInTheListOfLocations()
    {

    }

    /**
     * @Then I should find :name in the those locations
     */
    public function iShouldFindInTheThoseLocations($name)
    {
        // Need to replace this with a spin
        sleep(1);

        $this->selectOption('location-dropdown', $name);
    }

    /**
     * @When I want to compare data for :name between :yearFrom and :yearTo
     */
    public function iWantToCompareDataForBetweenAnd($name, $yearFrom, $yearTo)
    {
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
        $this->assertElementContains('#average-rain-volume', $rainVolume);
    }

    /**
     * @Then I will know that the average sun duration is :days days
     */
    public function iWillKnowThatTheAverageSunDurationIs($days)
    {
        $this->assertElementContains('#average-sun-duration', $days);
    }

    /**
     * @Then I will know that the average minimum temperature is :averageMinimumTemperature degrees
     */
    public function iWillKnowThatTheAverageMinimumTemperatureIs($averageMinimumTemperature)
    {
        $this->assertElementContains('#average-temperature-minimum', $averageMinimumTemperature);
    }

    /**
     * @Then I will know that the average maximum temperature is :averageMaximumTemperature degrees
     */
    public function iWillKnowThatTheAverageMaximumTemperatureIs($averageMaximumTemperature)
    {
        $this->assertElementContains('#average-temperature-maximum', $averageMaximumTemperature);
    }
}
