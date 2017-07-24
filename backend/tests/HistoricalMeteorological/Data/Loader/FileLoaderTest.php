<?php

namespace HistoricalMeteorological\Data\Parser;

use Generator;
use SplFileInfo;
use PHPUnit\Framework\TestCase;
use HistoricalMeteorological\Data\Loader\FileLoader;

class FileLoaderTest extends TestCase
{
    /** @var string */
    private $filename;

    /** @var SplFileInfo */
    private $file;

    /** @var FileLoader */
    private $loader;

    public function setUp()
    {
        $this->filename = sys_get_temp_dir().'/fileloadertest_'.md5(rand(1, 1000));
        $this->file = new SplFileInfo($this->filename);
        file_put_contents($this->filename, 'Test Data');

        $this->loader = new FileLoader();
    }

    public function testRowsWillBeLoadedAsGenerator()
    {
        $this->assertInstanceOf(Generator::class, $this->loader->getRows($this->file));
    }
}