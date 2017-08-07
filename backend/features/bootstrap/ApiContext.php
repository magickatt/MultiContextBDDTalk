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
        $contents = $this->response->getBody()->getContents();
        Assert::assertNotEmpty($contents);

        $envelope = json_decode($contents, true);
        Assert::assertEquals(JSON_ERROR_NONE, json_last_error());
        Assert::assertArrayHasKey('data', $envelope);

        return $envelope['data'];
    }
}
