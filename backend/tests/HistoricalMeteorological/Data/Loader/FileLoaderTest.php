<?php

namespace HistoricalMeteorological\Data\Parser;

use Generator;
use HistoricalMeteorological\Data\Loader\FileLoader;
use PHPUnit_Framework_TestCase;

class FileLoaderTest extends PHPUnit_Framework_TestCase
{
    /** @var string */
    private $filename;

    /** @var FileLoader */
    private $loader;

    public function setUp()
    {
        $this->filename = sys_get_temp_dir().'/fileloadertest_'.md5(rand(1, 1000));
        file_put_contents($this->filename, 'Test Data');

        $this->loader = new FileLoader($this->filename);
    }

    public function testRowsWillBeLoadedAsGenerator()
    {
        $this->assertInstanceOf(Generator::class, $this->loader->getRows());
    }
}