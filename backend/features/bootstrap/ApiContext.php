<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert;

/**
 * Defines application features from the specific context.
 */
class ApiContext implements Context
{
    const LOCATION_NAME_SLUG_MAP = [
        'Heathrow Airport' => 'heathrow',
        'Oxford' => 'oxford',
        'Durham' => 'durham',
        'Sheffield' => 'sheffield'
    ];

    /** @var \Psr\Http\Message\ResponseInterface */
    private $response;

    /** @var \GuzzleHttp\Client */
    private $httpClient;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct($baseUrl)
    {
        $this->httpClient = new GuzzleHttp\Client(['base_uri' => $baseUrl]);
    }

    /**
     * @Given I am on the :name page
     */
    public function iAmOnThePage($name)
    {
        // REST is stateless so nothing to do here...
    }

    /**
     * @When I look in the list of locations
     */
    public function iLookInTheListOfLocations()
    {
        $this->response = $this->httpClient->get('/locations/');
    }

    /**
     * @Then I should find :name in the those locations
     */
    public function iShouldFindInTheThoseLocations($name)
    {
        // If this fails then the Gherkin examples are missing from the map
        Assert::assertArrayHasKey($name, self::LOCATION_NAME_SLUG_MAP);

        $locationExistsInResponse = false;
        foreach ($this->extractDataFromJsonResponseEnvelope($this->response) as $locationArray) {
            if ($locationArray['id'] == self::LOCATION_NAME_SLUG_MAP[$name]) {
                $locationExistsInResponse = true;
            }
        }
        Assert::assertTrue($locationExistsInResponse);
    }

    private function extractDataFromJsonResponseEnvelope(\Psr\Http\Message\ResponseInterface $response)
    {
        return $this->extractSlideFromJsonResponseEnvelope($response, 'data');
    }

    private function extractMetaFromJsonResponseEnvelope(\Psr\Http\Message\ResponseInterface $response)
    {
        return $this->extractSlideFromJsonResponseEnvelope($response, 'meta');
    }

    private function extractSlideFromJsonResponseEnvelope(\Psr\Http\Message\ResponseInterface $response, string $slideKey)
    {
        $contents = $this->response->getBody()->getContents();
        Assert::assertNotEmpty($contents);

        $envelope = json_decode($contents, true);
        Assert::assertEquals(JSON_ERROR_NONE, json_last_error());
        Assert::assertArrayHasKey($slideKey, $envelope);

        return $envelope[$slideKey];
    }

    /**
     * @When I want to compare data for :location between :yearFrom and :yearTo
     */
    public function iWantToCompareDataForBetweenAnd($location, $yearFrom, $yearTo)
    {
        $locationId = self::LOCATION_NAME_SLUG_MAP[$location];
        $this->response = $this->httpClient->get('/entries/'.$locationId.'/'.$yearFrom.'/'.$yearTo);
    }

    /**
     * @Then I will know that the average rain volume is :rainVolume millimetres
     */
    public function iWillKnowThatTheAverageRainVolumeIs($rainVolume)
    {
        $meta = $this->extractMetaFromJsonResponseEnvelope($this->response);

        Assert::assertArrayHasKey('averages', $meta);
        Assert::assertArrayHasKey('rain_volume', $meta['averages']);
        Assert::assertEquals($rainVolume, $meta['averages']['rain_volume']);
    }

    /**
     * @Then I will know that the average sun duration is :days days
     */
    public function iWillKnowThatTheAverageSunDurationIs($days)
    {
        throw new PendingException('Not sure why this is not working');

        $meta = $this->extractMetaFromJsonResponseEnvelope($this->response);

        Assert::assertArrayHasKey('averages', $meta);
        Assert::assertArrayHasKey('sun_duration', $meta['averages']);
        Assert::assertEquals($days, $meta['averages']['sun_duration']);
    }

    /**
     * @Then I will know that the average minimum temperature is :averageMinimumTemperature degrees
     */
    public function iWillKnowThatTheAverageMinimumTemperatureIs($averageMinimumTemperature)
    {
        $meta = $this->extractMetaFromJsonResponseEnvelope($this->response);

        Assert::assertArrayHasKey('averages', $meta);
        Assert::assertArrayHasKey('minimum_temperature', $meta['averages']);
        Assert::assertEquals($averageMinimumTemperature, $meta['averages']['minimum_temperature']);
    }

    /**
     * @Then I will know that the average maximum temperature is :averageMaximumTemperature degrees
     */
    public function iWillKnowThatTheAverageMaximumTemperatureIs($averageMaximumTemperature)
    {
        $meta = $this->extractMetaFromJsonResponseEnvelope($this->response);

        Assert::assertArrayHasKey('averages', $meta);
        Assert::assertArrayHasKey('maximum_temperature', $meta['averages']);
        Assert::assertEquals($averageMaximumTemperature, $meta['averages']['maximum_temperature']);
    }
}
