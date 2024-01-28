<?php

namespace PauloRLima9\LaravelBitgo\Data\Responses;

use PauloRLima9\LaravelBitgo\Data\Data;

class Freezy extends Data
{
    /**
     * Tempo em que a carteira se torna congelada
     *
     * @var string data e hora
     */
    public string $time;

    /**
     * Tempo em que a carteira é descongelada e permitida para gastar
     *
     * @var string data e hora
     */
    public string $expires;
}
