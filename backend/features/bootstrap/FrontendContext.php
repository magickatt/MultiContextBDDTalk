<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\Assert;

class FrontendContext extends MinkContext
{
    const NAME_TO_URI_MAP = [
        'year comparison' => '#!/compare_locations'
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
     * @Given I am on the :name page
     */
    public function iAmOnThePage($name)
    {
        Assert::assertArrayHasKey($name, self::NAME_TO_URI_MAP);
        $this->visit(self::NAME_TO_URI_MAP[$name]);
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
}
