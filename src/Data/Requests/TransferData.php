<?php

namespace PauloRLima9\LaravelBitgo\Data\Requests;

use PauloRLima9\LaravelBitgo\Data\Data;

final class TransferData extends Data
{
    public string $walletPassphrase;

    /**
     * @var array<TransferRecipientData>
     */
    public array $recipients;

    public int $feeRate;
}
