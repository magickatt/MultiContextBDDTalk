<?php

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
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
    const LOCATION_NAME_ID_MAP = [
        'Heathrow Airport' => 'heathrow',
        'Oxford' => 'oxford',
        'Durham' => 'durham',
        'Sheffield' => 'sheffield',
        'Lowestoft' => 'lowestoft',
        'Valley' => 'valley',
        'Eastbourne' => 'eastbourne',
        'Chivenor' => 'chivenor'
    ];

    /** @var array|null */
    private $data;

    /** @var array|null */
    private $metadata;

    /** @var ResponseInterface */
    private $response;

    /** @var Client */
    private $httpClient;

    /**
     * @param string $baseUrl
     */
    public function __construct($baseUrl)
    {
        $this->httpClient = new Client(['base_uri' => $baseUrl]);
    }

    /**
     * @Given I am on the :name page
     */
    public function iAmOnThePage($name)
    {
        // REST is stateless so nothing to do here...
    }

    /**
     * @When I want to compare data for :locationName between :yearFrom and :yearTo
     * @param string $locationName
     * @param int $yearFrom
     * @param int $yearTo
     */
    public function iWantToCompareDataForBetweenAnd($locationName, $yearFrom, $yearTo)
    {
        $locationId = $this->translateLocationNameToId($locationName);
        $this->checkLocationsExists($locationId);

        $this->response = $this->httpClient->get('/entries/'.$locationId.'/'.$yearFrom.'/'.$yearTo);
    }

    /**
     * @Then I will know that the average rain volume is :rainVolume millimetres
     */
    public function iWillKnowThatTheAverageRainVolumeIs($rainVolume)
    {
        $meta = $this->getResponseMetadata($this->response);

        Assert::assertArrayHasKey('averages', $meta);
        Assert::assertArrayHasKey('rain_volume', $meta['averages']);
        Assert::assertEquals($rainVolume, $meta['averages']['rain_volume']);
    }

    /**
     * @Then I will know that the average sun duration is :days days
     */
    public function iWillKnowThatTheAverageSunDurationIs($days)
    {
        $meta = $this->getResponseMetadata($this->response);

        Assert::assertArrayHasKey('averages', $meta);
        Assert::assertArrayHasKey('sun_duration', $meta['averages']);
        Assert::assertEquals($days, $meta['averages']['sun_duration']);
    }

    /**
     * @Then I will know that the average minimum temperature is :averageMinimumTemperature degrees
     */
    public function iWillKnowThatTheAverageMinimumTemperatureIs($averageMinimumTemperature)
    {
        $meta = $this->getResponseMetadata($this->response);

        Assert::assertArrayHasKey('averages', $meta);
        Assert::assertArrayHasKey('temperature_minimum', $meta['averages']);
        Assert::assertEquals($averageMinimumTemperature, $meta['averages']['temperature_minimum']);
    }

    /**
     * @Then I will know that the average maximum temperature is :averageMaximumTemperature degrees
     */
    public function iWillKnowThatTheAverageMaximumTemperatureIs($averageMaximumTemperature)
    {
        $meta = $this->getResponseMetadata($this->response);

        Assert::assertArrayHasKey('averages', $meta);
        Assert::assertArrayHasKey('temperature_maximum', $meta['averages']);
        Assert::assertEquals($averageMaximumTemperature, $meta['averages']['temperature_maximum']);
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
     * @Then I will know that the difference in average sun duration is :diffAverageSunDuration days
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
     * Translate the name of a location to an ID
     * @param string $name
     * @return string
     */
    private function translateLocationNameToId(string $name)
    {
        // If this fails then the name is missing from the map
        Assert::assertArrayHasKey($name, self::LOCATION_NAME_ID_MAP);

        return self::LOCATION_NAME_ID_MAP[$name];
    }

    /**
     * Check that a specific location exists in the list of locations
     * @param string $locationId
     */
    private function checkLocationsExists(string $locationId)
    {
        $response = $this->httpClient->get('/locations/');
        $locationExistsInResponse = false;

        foreach ($this->getResponseData($response) as $locationArray) {
            if ($locationArray['id'] == $locationId) {
                $locationExistsInResponse = true;
            }
        }
        Assert::assertTrue($locationExistsInResponse);
    }

    /**
     * Extract metadata from the JSON response
     * @param ResponseInterface $response
     * @return array
     */
    private function getResponseMetadata(ResponseInterface $response)
    {
        if ($this->metadata === null) {
            $this->metadata = $this->extractSectionFromJsonResponseEnvelope($response, 'meta');
        }
        return $this->metadata;
    }

    /**
     * Extract data from the JSON response
     * @param ResponseInterface $response
     * @return array|null
     */
    private function getResponseData(ResponseInterface $response)
    {
        if ($this->data === null) {
            $this->data = $this->extractSectionFromJsonResponseEnvelope($response, 'data');
        }
        return $this->data;
    }

    /**
     * @param ResponseInterface $response
     * @param string $slideKey
     * @return mixed
     */
    private function extractSectionFromJsonResponseEnvelope(ResponseInterface $response, string $slideKey)
    {
        $contents = $response->getBody()->getContents();
        Assert::assertNotEmpty($contents);

        $envelope = json_decode($contents, true);
        Assert::assertEquals(JSON_ERROR_NONE, json_last_error());
        Assert::assertArrayHasKey($slideKey, $envelope);

        return $envelope[$slideKey];
    }
}
