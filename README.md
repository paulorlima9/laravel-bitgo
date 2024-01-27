Você pode instalar o pacote via Composer:

```bash
composer require paulorlima9/laravel-bitgo
```

Você pode publicar o arquivo de configuração com o seguinte comando:

```bash
php artisan vendor:publish --provider="PauloRLima9\LaravelBitgo\BitgoServiceProvider"
```

Este é o conteúdo do arquivo de configuração publicado:

## Uso

### Gerar uma carteira com webhooks

```php
use PauloRLima9\LaravelBitgo\Facades\Wallet;

$wallet = Wallet::init(coin: 'tbtc')
                ->generate(label: 'etiqueta da carteira', passphrase: 'senha')
                ->addWebhook(numConfirmations: 0)
                ->addWebhook(numConfirmations: 1);

return $wallet;
```

### Adicionar um webhook a uma carteira com URL de retorno personalizada

```php
use PauloRLima9\LaravelBitgo\Facades\Wallet;

$wallet = Wallet::init(coin: 'tbtc', id: 'id-da-carteira')
                ->addWebhook(
                    numConfirmations: 3,
                    callbackUrl: 'https://seu-domínio.com/api/callback'
                );

return $wallet;
```

### Gerar um endereço em uma carteira existente

```php
use PauloRLima9\LaravelBitgo\Facades\Wallet;

$wallet = Wallet::init(coin: 'tbtc', id: 'id-da-sua-carteira')
                ->generateAddress(label: 'etiqueta-do-endereço');

return $wallet->address;
```

### Verificar o valor máximo gastável em uma carteira

```php
use PauloRLima9\LaravelBitgo\Facades\Wallet;

$maxSpendable = Wallet::init(coin: 'tbtc', id: 'id-da-sua-carteira')
                ->getMaximumSpendable();

return $maxSpendable;
```

### Obter todas as transações em uma carteira

```php
use PauloRLima9\LaravelBitgo\Facades\Wallet;

$transfers = Wallet::init(coin: 'tbtc', id: 'id-da-sua-carteira')
                ->getTransfers();

return $transfers;
```

### Obter transferência por ID de transferência

```php
use PauloRLima9\LaravelBitgo\Facades\Wallet;

$transfer = Wallet::init(coin: 'tbtc', id: 'id-da-sua-carteira')
                ->getTransfer(transferId: 'id-da-transferência');

return $transfer;
```

### Enviar transferência de uma carteira

```php
use PauloRLima9\LaravelBitgo\Data\Requests\TransferData;
use PauloRLima9\LaravelBitgo\Data\Requests\TransferRecipientData;
use PauloRLima9\LaravelBitgo\Facades\Wallet;

// Você pode adicionar quantos destinatários precisar :)

$destinatario = TransferRecipientData::fromArray([
    'amount' => 4934,
    'address' => 'carteira'
]);

$destinatarioUm = TransferRecipientData::fromArray([
    'amount' => 4934,
    'address' => 'carteira'
]);

$dadosTransferencia = TransferData::fromArray([
    'walletPassphrase' => 'teste',
    'recipients' => [$destinatario, $destinatarioUm]
]);

$resultado = Wallet::init('tbtc', 'id-da-sua-carteira')->sendTransfer($dadosTransferencia);

return $resultado;
```

## Testes

```bash
composer test
```

## Créditos

- [PauloRLima9](https://github.com/paulorlima9)

## Licença

A Licença MIT (MIT). Consulte o [Arquivo de Licença](LICENSE.md) para obter mais informações.