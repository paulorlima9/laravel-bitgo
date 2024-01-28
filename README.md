# Laravel Bitgo Package Documentation

O Laravel Bitgo SDK é uma biblioteca que facilita a integração do Laravel com a API da Bitgo para operações em carteiras e transferências de criptomoedas. Abaixo está uma documentação detalhada dos recursos fornecidos por este pacote.

## Instalação

Você pode instalar o pacote via Composer:

```bash
composer require paulorlima9/laravel-bitgo
```

Após a instalação, você pode publicar o arquivo de configuração com o seguinte comando:

```bash
php artisan vendor:publish --provider="PauloRLima9\LaravelBitgo\BitgoServiceProvider"
```

Este é o conteúdo do arquivo de configuração publicado (`config/bitgo.php`):

### Configuração

Configure suas credenciais da API Bitgo no arquivo `.env`:

```env
BITGO_API_KEY=your-api-key
BITGO_WEBHOOK_CALLBACK_URL=https://your-domain.com/bitgo/callback
BITGO_MAINNET_API_URL=https://www.bitgo.com/api/v2/
BITGO_TESTNET_API_URL=https://test.bitgo.com/api/v2/
BITGO_EXPRESS_API_URL=https://express.bitgo.com/api/v2/
```

### Uso

#### Gerar uma Carteira com Webhooks

```php
use PauloRLima9\LaravelBitgo\Facades\Wallet;

$wallet = Wallet::init(coin: 'tbtc')
    ->generate(label: 'Minha Carteira', passphrase: 'senha_segura')
    ->addWebhook(numConfirmations: 0)
    ->addWebhook(numConfirmations: 1);

return $wallet;
```

#### Adicionar um Webhook a uma Carteira com URL de Retorno Personalizada

```php
use PauloRLima9\LaravelBitgo\Facades\Wallet;

$wallet = Wallet::init(coin: 'tbtc', id: 'id-da-carteira')
    ->addWebhook(
        numConfirmations: 3,
        callbackUrl: 'https://seu-domínio.com/bitgo/callback'
    );

return $wallet;
```

#### Gerar um Endereço em uma Carteira Existente

```php
use PauloRLima9\LaravelBitgo\Facades\Wallet;

$wallet = Wallet::init(coin: 'tbtc', id: 'id-da-sua-carteira')
    ->generateAddress(label: 'etiqueta-do-endereço');

return $wallet->address;
```

#### Verificar o Valor Máximo Gastável em uma Carteira

```php
use PauloRLima9\LaravelBitgo\Facades\Wallet;

$maxSpendable = Wallet::init(coin: 'tbtc', id: 'id-da-sua-carteira')
    ->getMaximumSpendable();

return $maxSpendable;
```

#### Obter Todas as Transações em uma Carteira

```php
use PauloRLima9\LaravelBitgo\Facades\Wallet;

$transfers = Wallet::init(coin: 'tbtc', id: 'id-da-sua-carteira')
    ->getTransfers();

return $transfers;
```

#### Obter Transferência por ID de Transferência

```php
use PauloRLima9\LaravelBitgo\Facades\Wallet;

$transfer = Wallet::init(coin: 'tbtc', id: 'id-da-sua-carteira')
    ->getTransfer(transferId: 'id-da-transferência');

return $transfer;
```

#### Enviar Transferência de uma Carteira

```php
use PauloRLima9\LaravelBitgo\Data\Requests\TransferData;
use PauloRLima9\LaravelBitgo\Data\Requests\TransferRecipientData;
use PauloRLima9\LaravelBitgo\Facades\Wallet;

// Você pode adicionar quantos destinatários precisar :)

$recipient = TransferRecipientData::fromArray([
    'amount' => 4934,
    'address' => 'carteira'
]);

$recipientTwo = TransferRecipientData::fromArray([
    'amount' => 4934,
    'address' => 'carteira'
]);

$transferData = TransferData::fromArray([
    'walletPassphrase' => 'teste',
    'recipients' => [$recipient, $recipientTwo]
]);

$result = Wallet::init('tbtc', 'id-da-sua-carteira')->sendTransfer($transferData);

return $result;
```

### Integração com a API Bitgo Diretamente

Você também pode usar a classe `BitgoAdapter` diretamente para acessar outros recursos da API Bitgo. Abaixo estão alguns exemplos:

#### Obter Informações do Usuário Autenticado

```php
use PauloRLima9\LaravelBitgo\Adapters\BitgoAdapter;

$response = (new BitgoAdapter())->me();

// $response agora contém informações sobre o usuário autenticado
return $response->json();
```

#### Obter Taxas de Câmbio

```php
use PauloRLima9\LaravelBitgo\Adapters\BitgoAdapter;

$coin = 'tbtc'; // Substitua pelo código da moeda desejada, por exemplo, 'btc'

$response = (new BitgoAdapter())->getExchangeRates($coin);

// $response agora contém informações sobre as taxas de câmbio da moeda especificada
return $response->json();
```

#### Ping na API Express da Bitgo

```php
use PauloRLima9\LaravelBitgo\Adapters\BitgoAdapter;

$response = (new BitgoAdapter())->pingExpress();

// $response agora contém a resposta do ping na API Express
return $response->json();
```

#### Ping na API Principal da Bitgo

```php
use PauloRLima9\LaravelBitgo\Adapters\BitgoAdapter;

$response = (new BitgoAdapter())->ping();

// $response agora contém a resposta do ping na API principal
return $response->json();
```

#### Gerar uma Nova Carteira

```php
use PauloRLima9\LaravelBitgo\Adapters\BitgoAdapter;
use PauloRLima9\LaravelBitgo\Data\Requests\GenerateWallet;

$coin = 'tbtc'; // Substitua pelo código da moeda desejada, por exemplo, 'btc'
$generateWalletData = GenerateWallet::fromArray([
    'label' => 'Minha Carteira',
    'passphrase' => 'senha_segura',
]);

$response = (new BitgoAdapter())->generateWallet($coin, $generateWalletData);

// $response agora contém informações sobre a carteira recém-criada
return $response->json();
```

Estes são apenas exemplos para ilustrar como usar os métodos da classe `BitgoAdapter`. Certifique-se de adaptar os parâmetros conforme necessário para atender aos requisitos específicos da sua aplicação.

## Recebendo Notificações Instantâneas (IPN) via Webhook

Ao configurar um webhook na sua carteira, você pode receber notificações instantâneas sobre transações. Aqui está um exemplo de como lidar com essas notificações no seu controlador Laravel:

```php
use Illuminate\Http

\Request;
use PauloRLima9\LaravelBitgo\Facades\Wallet;
use PauloRLima9\LaravelBitgo\Data\Responses\Webhook;

class BitgoWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // Verifique a autenticidade da solicitação, garantindo que ela venha da Bitgo
        if ($this->isValidBitgoRequest($request)) {
            // Processar a notificação recebida
            $webhookData = Webhook::fromArray($request->all());

            // Aqui você pode acessar os dados da transação
            $transactionId = $webhookData->id;
            $transactionStatus = $webhookData->state;

            // Agora, você pode processar os dados conforme necessário
            // ...

            // Responda à solicitação Bitgo com sucesso
            return response()->json(['status' => 'success']);
        }

        // Responda à solicitação Bitgo com erro se a autenticidade falhar
        return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
    }

    private function isValidBitgoRequest(Request $request): bool
    {
        // Implemente a lógica para verificar se a solicitação é autêntica
        // Utilize as informações fornecidas pela Bitgo no cabeçalho da solicitação
        // Certifique-se de configurar a chave de API corretamente nas configurações Bitgo

        return true; // Retorne verdadeiro se a solicitação for autêntica
    }
}
```

Certifique-se de rotear as solicitações do webhook para esse controlador no arquivo `routes/web.php`:

```php
use App\Http\Controllers\BitgoWebhookController;

Route::post('/bitgo/webhook', [BitgoWebhookController::class, 'handleWebhook']);
```

Agora, quando uma transação ocorre na sua carteira Bitgo, a notificação é enviada para a URL configurada e processada pelo controlador. Certifique-se de ajustar a lógica de manipulação conforme necessário para atender aos requisitos específicos do seu aplicativo.

## Testes

```bash
composer test
```

## Créditos

- [PauloRLima9](https://github.com/paulorlima9)

## Licença

A Licença MIT (MIT). Consulte o [Arquivo de Licença](LICENSE.md) para obter mais informações.