<?php

namespace HistoricalMeteorological\Service;

use JMS\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Response;

class ResponseService
{
    const RESPONSE_FORMAT = 'json';

    /** @var Serializer */
    private $serializer;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function createPluralResponse(array $items):Response
    {
        return new Response(
            $this->serializer->serialize($items, self::RESPONSE_FORMAT),
            200,
            ['Content-Type' => 'application/json']
        );
    }
}
