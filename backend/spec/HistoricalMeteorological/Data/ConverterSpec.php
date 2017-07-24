<?php

namespace spec\HistoricalMeteorological\Data;

use Doctrine\Common\Persistence\ObjectManager;
use HistoricalMeteorological\Data\Converter;
use HistoricalMeteorological\Data\Loader\LoaderInterface;
use HistoricalMeteorological\Data\Parser\ParserInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConverterSpec extends ObjectBehavior
{
    function let(ObjectManager $objectManager, LoaderInterface $loader, ParserInterface $parser)
    {
        $this->beConstructedWith($objectManager, $loader, $parser);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Converter::class);
    }
}
