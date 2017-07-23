<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class ApiContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * Opens homepage
     * @see
     *
     * @Given /^(?:|I )am on (?:|the )homepage$/
     * @When /^(?:|I )go to (?:|the )homepage$/
     */
    public function iAmOnHomepage()
    {
        throw new PendingException();
    }

    /**
     * Checks, that page contains specified text
     *
     * @Then /^(?:|I )should see "(?P<text>(?:[^"]|\\")*)"$/
     */
    public function assertPageContainsText($text)
    {
        throw new PendingException();
    }
}
