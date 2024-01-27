<?php

namespace PauloRLima9\LaravelBitgo\Data\Requests;

use PauloRLima9\LaravelBitgo\Data\Data;

final class TransferRecipientData extends Data
{
    public int $amount;

    public string $address;
}
