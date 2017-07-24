<?php

namespace HistoricalMeteorological\Data\Parser\Text;

use Generator;
use PHPUnit\Framework\TestCase;
use HistoricalMeteorological\Data\Parser\Strategy\RandomWhitespacePaddingStrategy;

/**
 * Including as an integration test partially because I'm pretty sure this issue never really got solved...
 * @link https://github.com/phpspec/phpspec/issues/379
 */
class TextParserTest extends TestCase
{
    /** @var array */
    private $data = [
        '   2017   1    9.0     3.7       5    91.4    ---    ',
        '   2017   2   10.3     5.2       0    54.0    ---    ',
        '   2017   3   12.6     6.6       1    92.4    ---    '
    ];

    /** @var TextParser */
    private $parser;

    public function setUp()
    {
        $this->parser = new TextParser(new RandomWhitespacePaddingStrategy());
    }

    public function testParserShouldReturnAnArrayFromSpaceDelimitedText()
    {
        $i = 0;
        foreach ($this->parser->getEntries($this->createGenerator()) as $entry) {
            $i++;
            $this->assertCount(7, $entry, 'Entry should have 7 items per row');
            $this->assertEquals($entry[0], '2017', 'All entries should be from 2017');
            $this->assertEquals($entry[1], $i);
        }

        $this->assertEquals(3, $i);
    }

    /**
     * @return Generator
     */
    private function createGenerator()
    {
        foreach ($this->data as $item) {
            yield $item;
        }
    }
}