<?php

namespace PauloRLima9\LaravelBitgo\Data\Responses;

use PauloRLima9\LaravelBitgo\Data\Data;

class Wallet extends Data
{
    /**
     * @var ?string
     */
    public ?string $id;

    /**
     * IDs dos usuários com acesso à carteira
     */
    public array $users;

    /**
     * Nome da blockchain na qual a carteira está inserida
     */
    public string $coin;

    /**
     * Nome atribuído pelo usuário à carteira
     */
    public string $label;

    /**
     * Número de assinaturas necessárias para a carteira enviar
     */
    public int $m;

    /**
     * Número de signatários na carteira
     */
    public int $n;

    /**
     * @var array<string>
     */
    public array $keys;

    public array $keySignatures;

    /**
     * Tags definidas na carteira
     *
     * @var array<string>
     */
    public array $tags;

    public array $receiveAddress;

    /**
     * Saldo da carteira como número
     */
    public int $balance;

    /**
     * Saldo da carteira como string
     */
    public string $balanceString;

    /**
     * Saldo confirmado da carteira como número
     */
    public int $confirmedBalance;

    /**
     * Saldo confirmado da carteira como string
     */
    public string $confirmedBalanceString;

    /**
     * Saldo disponível para gastar da carteira como número
     */
    public int $spendableBalance;

    /**
     * Saldo disponível para gastar da carteira como string
     */
    public string $spendableBalanceString;

    /**
     * Sinalizador que indica se a carteira foi excluída
     */
    public bool $deleted;

    /**
     * Sinalizador para identificar carteiras frias
     */
    public bool $isCold;

    /**
     * Estado de congelamento (usado para impedir que a carteira gaste)
     */
    public array $freezy;

    /**
     * Sinalizador para desativar notificações de transação da carteira
     */
    public bool $disableTransactionNotifications;

    /**
     * Dados de administração (políticas da carteira)
     */
    public array $admin;

    /**
     * Sinalizador para permitir a assinatura com chave de backup
     */
    public int $approvalsRequired;

    /**
     * Aprovações pendentes na carteira
     */
    public array $pendingApprovals;

    /**
     * Sinalizador para permitir a assinatura com chave de backup
     */
    public bool $allowBackupKeySigning;

    /**
     * Dados específicos da moeda
     */
    public array $coinSpecific;

    /**
     * @var array<string>
     */
    public array $clientFlags;

    /**
     * Sinalizador indicando se a chave do usuário desta carteira é recuperável com a frase de acesso mantida pelo usuário.
     */
    public bool $recoverable;

    /**
     * Momento em que esta carteira foi criada
     *
     * @var string data-hora
     */
    public string $startDate;

    /**
     * Sinalizador indicando que esta carteira é grande (mais de 100.000 endereços).
     * Se isso estiver definido, algumas APIs podem omitir propriedades que são caras de calcular
     * para carteiras com muitos endereços (por exemplo, a contagem total de endereços retornada pela API List Addresses).
     */
    public bool $hasLargeNumberOfAddresses;

    /**
     * Opções de configuração personalizadas para esta carteira
     */
    public array $config;
}