<?php

namespace PauloRLima9\LaravelBitgo\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static all()
 * @method static getByCoin(string $string)
 */
class ExchangeRate extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \PauloRLima9\LaravelBitgo\ExchangeRate::class;
    }
}
