<?php

namespace PauloRLima9\LaravelBitgo\Data\Responses;

use PauloRLima9\LaravelBitgo\Data\Data;

class Address extends Data
{
    public string $id;

    public string $address;

    public int $chain;

    public int $index;

    public string $wallet;

    public array $coinSpecific;
}
