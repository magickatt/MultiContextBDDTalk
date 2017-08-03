<?php

namespace HistoricalMeteorological\Data\Parser;

use Generator;
use DirectoryIterator;
use PHPUnit\Framework\Assert;
use SplFileInfo;
use PHPUnit\Framework\TestCase;
use HistoricalMeteorological\Data\Loader\FileLoader;

class FileLoaderTest extends TestCase
{
    /** @var array */
    private $data;

    /** @var DirectoryIterator */
    private $directory;

    /** @var SplFileInfo[] */
    private $files = [];

    /** @var FileLoader */
    private $loader;

    public function setUp()
    {
        $path = sys_get_temp_dir().'/'.sha1(rand(1, 99999));
        mkdir($path);
        $this->directory = new \DirectoryIterator($path);

        $this->data = [
            $path.'/fileloadertest_'.sha1(rand(1, 1000)) => 'Test Data '.rand(1, 1000),
            $path.'/fileloadertest_'.sha1(rand(1, 1000)) => "Test Data\n".rand(1, 1000),
            $path.'/fileloadertest_'.sha1(rand(1, 1000)) => "Test Data\n".rand(1, 1000)."\n".rand(1, 1000),
        ];

        foreach ($this->data as $filename => $data) {
            $this->files[] = new SplFileInfo($filename);
            file_put_contents($filename, $data);
        }

        $this->loader = new FileLoader();
    }

    public function testRowsWillBeLoadedAsGenerator()
    {
        $this->assertInstanceOf(Generator::class, $this->loader->getRows($this->files[0]));
    }

    public function testCanLoadRowsFromFile()
    {
        $files = $this->loader->getResources($this->directory);
        $this->assertInstanceOf(Generator::class, $files);

        $expectedFilenames = array_map(function ($path) {
            return realpath($path);
        }, array_keys($this->data));

        $i = 0;
        foreach ($files as $file) {
            /** @var SplFileInfo $file */
            $this->assertInstanceOf(SplFileInfo::class, $file);
            $actualFilenames[] = $file->getRealPath();
            $i++;
        }

        /*
         * Cannot guarantee directory listing happens in any given order so you
         * need to get both lists of filenames, sort them then compare them
         */
        $this->assertEquals(sort($expectedFilenames), sort($actualFilenames));
    }
}