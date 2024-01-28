<?php

namespace PauloRLima9\LaravelBitgo\Data\Responses;

use PauloRLima9\LaravelBitgo\Data\Data;

class KeySignature extends Data
{
    /**
     * Assinatura para o pub de backup
     */
    public string $backupPub;

    /**
     * Assinatura para o pub do BitGo
     */
    public string $bitgoPub;
}
