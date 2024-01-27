<?php

namespace PauloRLima9\LaravelBitgo\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \PauloRLima9\LaravelBitgo\Wallet init(string $coin, string $id = null)
 * @method static \Illuminate\Support\Collection listAll(string $coin = null, ?array $params = []))
 */
class Wallet extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \PauloRLima9\LaravelBitgo\Wallet::class;
    }
}
