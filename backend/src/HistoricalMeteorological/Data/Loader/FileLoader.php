<?php

namespace HistoricalMeteorological\Data\Loader;

use Generator;
use SplFileInfo;
use SeekableIterator;
use DirectoryIterator;
use InvalidArgumentException;

class FileLoader implements LoaderInterface
{
    /**
     * @inheritdoc
     */
    public function getResources(SeekableIterator $location):Generator
    {
        if (!$location instanceof DirectoryIterator) {
            throw new InvalidArgumentException('FileLoader can only get resources from a DirectoryIterator');
        }
        return $this->getFilesFromDirectory($location);
    }

    /**
     * @inheritdoc
     */
    public function getRows($resource):Generator
    {
        if (!$resource instanceof SplFileInfo) {
            throw new InvalidArgumentException('FileLoader can only get rows from SplFileInfo resources');
        }
        return $this->getRowsFromFile($resource);
    }

    /**
     * @param DirectoryIterator $directory
     * @return Generator
     */
    private function getFilesFromDirectory(DirectoryIterator $directory):Generator
    {
        if (!$directory->isDir() || !$directory->isReadable()) {
            throw new InvalidArgumentException('Directory is either not actually a directory or not accessible');
        }

        foreach ($directory as $file) {
            yield $file;
        }
    }

    /**
     * Get rows from local file resource
     * @param SplFileInfo $file
     * @return Generator
     */
    private function getRowsFromFile(SplFileInfo $file):Generator
    {
        $file = fopen($file->getRealPath(), 'r');
        while (($line = fgets($file)) !== false) {
            yield $line;
        }
        fclose($file);
    }
}
