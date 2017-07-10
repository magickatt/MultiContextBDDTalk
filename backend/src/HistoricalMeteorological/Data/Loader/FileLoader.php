<?php

namespace HistoricalMeteorological\Data\Loader;

use Generator;

class FileLoader implements LoaderInterface
{
    /** @var string */
    private $filename;

    /**
     * @param string $filename
     */
    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    /**
     * Get rows from local file resource
     * @return Generator
     */
    public function getRows()
    {
        $file = fopen($this->filename, 'r');
        while (($line = fgets($file)) !== false) {
            yield $line;
        }
        fclose($file);
    }
}
