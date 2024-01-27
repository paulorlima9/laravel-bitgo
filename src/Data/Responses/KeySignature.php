<?php

namespace PauloRLima9\LaravelBitgo\Data\Responses;

use PauloRLima9\LaravelBitgo\Data\Data;

class KeySignature extends Data
{
    /**
     * Signature for the backup pub
     */
    public string $backupPub;

    /**
     * Signature for the BitGo pub
     */
    public string $bitgoPub;
}
