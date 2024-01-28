<?php

namespace PauloRLima9\LaravelBitgo;

use Illuminate\Support\Collection;
use PauloRLima9\LaravelBitgo\Data\Responses\Address;
use PauloRLima9\LaravelBitgo\Data\Responses\Webhook;
use PauloRLima9\LaravelBitgo\Data\Responses\Transfer;
use PauloRLima9\LaravelBitgo\Contracts\WalletContract;
use PauloRLima9\LaravelBitgo\Data\Requests\TransferData;
use PauloRLima9\LaravelBitgo\Data\Requests\GenerateWallet;
use PauloRLima9\LaravelBitgo\Contracts\BitgoAdapterContract;
use PauloRLima9\LaravelBitgo\Data\Responses\Wallet as WalletData;

class Wallet extends WalletData implements WalletContract
{
    public ?string $id;

    /**
     * Ids dos usuários com acesso à carteira
     */
    public array $users;

    /**
     * Nome da blockchain na qual a carteira está localizada
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
     * Tags atribuídas à carteira
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
     * Saldo gastável da carteira como número
     */
    public int $spendableBalance;

    /**
     * Saldo gastável da carteira como string
     */
    public string $spendableBalanceString;

    /**
     * Indica se a carteira foi excluída
     */
    public bool $deleted;

    /**
     * Identificação de carteiras frias
     */
    public bool $isCold;

    /**
     * Estado de congelamento (usado para impedir a carteira de gastar)
     */
    public array $freezy;

    /**
     * Indicador para desativar notificações de transações da carteira
     */
    public bool $disableTransactionNotifications;

    /**
     * Dados de administração (políticas da carteira)
     */
    public array $admin;

    /**
     * Indicador para permitir assinatura com chave de backup
     */
    public int $approvalsRequired;

    /**
     * Aprovações pendentes na carteira
     */
    public array $pendingApprovals;

    /**
     * Indicador para permitir assinatura com chave de backup
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
     * Indica se a chave do usuário desta carteira é recuperável com a frase de acesso mantida pelo usuário.
     */
    public bool $recoverable;

    /**
     * Data e hora de criação desta carteira
     *
     * @var string date-time
     */
    public string $startDate;

    /**
     * Indica que esta carteira é grande (mais de 100.000 endereços).
     * Se isso estiver definido, algumas APIs podem omitir propriedades que são caras de calcular
     * para carteiras com muitos endereços (por exemplo, a contagem total de endereços retornada pela API de Listagem de Endereços).
     */
    public bool $hasLargeNumberOfAddresses;

    /**
     * Opções de configuração personalizadas para esta carteira
     */
    public array $config;

    protected BitgoAdapterContract $adapter;

    public function __construct(BitgoAdapterContract $adapter)
    {
        $this->adapter = $adapter;
        $this->coin = config('bitgo.default_coin');
    }

    private function setProperties(array $propertyList)
    {
        foreach ($propertyList as $key => $value) {
            $this->$key = $value;
        }
    }

    public function init(string $coin, string $id = null): self
    {
        $this->coin = $coin;
        $this->id = $id;

        return $this;
    }

    public function generate(string $label, string $passphrase, array $options = []): self
    {
        $options = array_merge([
            'label' => $label,
            'passphrase' => $passphrase,
        ], $options);

        $generateWalletData = GenerateWallet::fromArray($options);

        $wallet = $this->adapter->generateWallet($this->coin, $generateWalletData);
        $this->setProperties($wallet);

        return $this;
    }

    public function get(): self
    {
        $wallet = $this->adapter->getWallet($this->coin, $this->id);
        $this->setProperties($wallet);

        return $this;
    }

    public function addWebhook(int $numConfirmations = 0, string $callbackUrl = null): Webhook
    {
        $webhook = $this->adapter->addWalletWebhook($this->coin, $this->id, $numConfirmations, $callbackUrl);

        return Webhook::fromArray($webhook);
    }

    public function generateAddress(string $label = null): Address
    {
        $address = $this->adapter->generateAddressOnWallet($this->coin, $this->id, $label);

        return Address::fromArray($address);
    }

    public function getTransfer(string $transferId): Transfer
    {
        $transfer = $this->adapter->getWalletTransfer($this->coin, $this->id, $transferId);

        return Transfer::fromArray($transfer);
    }

    public function listAll(string $coin = null, ?array $params = []): Collection
    {
        $wallets = collect($this->adapter->getAllWallets($coin, $params)['wallets'] ?? []);

        return $wallets->map(callback: function ($element) {
            $wallet = app('Wallet');
            $wallet->setProperties($element);

            return $wallet;
        });
    }

    public function sendTransfer(TransferData $transfer): ?array
    {
        return $this->adapter->sendTransactionToMany(
            $this->coin,
            $this->id,
            $transfer
        );
    }

    public function getMaximumSpendable(): ?array
    {
        return $this->adapter->getMaximumSpendable($this->coin, $this->id);
    }

    public function getTransfers(?array $params = []): ?array
    {
        $walletTransfers = $this->adapter->getWalletTransfers($this->coin, $this->id, $params);

        return array_map(function ($item) {
            return Transfer::fromArray($item);
        }, $walletTransfers['transfers']);
    }
}
