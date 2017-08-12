<?php

namespace spec\HistoricalMeteorological\Command;

use DirectoryIterator;
use Knp\Command\Command;
use PhpSpec\ObjectBehavior;
use HistoricalMeteorological\Data\Converter;
use Prophecy\Argument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportDataCommandSpec extends ObjectBehavior
{
    private $converter;

    private $directoryIterator;

    function let(Converter $converter, DirectoryIterator $directoryIterator)
    {
        $this->converter = $converter;
        $this->directoryIterator = $directoryIterator;

        $this->beConstructedWith($converter, $directoryIterator);
    }

    function it_has_the_correct_inheritance()
    {
        $this->shouldHaveType(Command::class);
    }

    function it_can_run(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(Argument::type('string'))->shouldBeCalled();
        $this->converter->convert($this->directoryIterator)->shouldBeCalled();

        $this->run($input, $output);
    }
}
