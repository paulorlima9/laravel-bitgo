<?php

namespace PauloRLima9\LaravelBitgo\Data\Requests;

use PauloRLima9\LaravelBitgo\Data\Data;

class GenerateWallet extends Data
{
    /**
     * WalletLabel
     */
    public string $label;

    /***
     * Senha a ser usada para criptografar a chave do usuário na carteira
     * @var string
     */
    public string $passphrase;

    /**
     * Chave pública fornecida pelo usuário
     */
    public string $userKey;

    /**
     * Parte pública de um par de chaves
     */
    public string $backupXpub;

    /**
     * Serviço opcional de recuperação de chave para fornecer e armazenar a chave de backup
     */
    public string $backupXpubProvider;

    /**
     *  (Id) ^[0-9a-f]{32}$
     */
    public string $enterprise;

    /**
     * Sinalizador para desativar notificações de transação da carteira
     */
    public bool $disableTransactionNotifications;

    /**
     * A senha usada para descriptografar a chave privada do usuário durante a recuperação da carteira
     */
    public string $passcodeEncryptionCode;

    /**
     * Semente usada para derivar uma chave de usuário estendida para uma carteira fria
     */
    public string $coldDerivationSeed;

    /**
     * Preço do gás a ser usado ao implantar uma carteira Ethereum
     */
    public int $gasPrice;

    /**
     * Sinalizador para evitar que o KRS envie e-mails após criar a chave de backup
     */
    public bool $disableKRSEmail;

    /**
     * (Apenas ETH) Especifique a versão do contrato de criação da carteira usada ao criar um contrato de carteira.
     * Use 0 para a antiga criação de carteira,
     * 1 para a nova criação de carteira, onde ela só é implantada ao receber fundos.
     */
    public int $walletVersion = 1;
}
