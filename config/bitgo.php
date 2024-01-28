<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Utilizar Mocks
    |--------------------------------------------------------------------------
    |
    | Esta opção determina se a aplicação deve utilizar mocks para chamadas
    | de API do Bitgo. Isso é útil para fins de teste.
    |
    */
    'use_mocks' => env('BITGO_USE_MOCKS', false),

    /*
    |--------------------------------------------------------------------------
    | Testnet
    |--------------------------------------------------------------------------
    |
    | Esta opção determina se a aplicação deve utilizar o testnet do Bitgo
    | em vez do mainnet. Defina como true para testes e desenvolvimento.
    |
    */
    'testnet' => env('BITGO_TESTNET', true),

    /*
    |--------------------------------------------------------------------------
    | Chave da API
    |--------------------------------------------------------------------------
    |
    | Esta opção define a chave da API para a API do Bitgo.
    |
    */
    'api_key' => env('BITGO_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Prefixo da API
    |--------------------------------------------------------------------------
    |
    | Esta opção define o prefixo da API para a API do Bitgo.
    |
    */
    'v2_api_prefix' => 'api/v2/',

    /*
    |--------------------------------------------------------------------------
    | URLs da API para Testnet e Mainnet
    |--------------------------------------------------------------------------
    |
    | Estas opções definem as URLs da API para o testnet e mainnet do Bitgo.
    |
    */
    'testnet_api_url' => 'https://app.bitgo-test.com',
    'mainnet_api_url' => 'https://app.bitgo.com',

    /*
    |--------------------------------------------------------------------------
    | URL da API Express
    |--------------------------------------------------------------------------
    |
    | Esta opção define a URL da API Express para a API do Bitgo.
    |
    */
    'express_api_url' => env('BITGO_EXPRESS_API_URL'),

    /*
    |--------------------------------------------------------------------------
    | Moeda Padrão
    |--------------------------------------------------------------------------
    |
    | Esta opção define a moeda padrão para chamadas de API do Bitgo.
    |
    */
    'default_coin' => env('BITGO_DEFAULT_COIN', 'tbtc'),

    /*
    |--------------------------------------------------------------------------
    | URL de Callback do Webhook
    |--------------------------------------------------------------------------
    |
    | Esta opção define a URL de callback do webhook para a API do Bitgo.
    |
    */
    'webhook_callback_url' => env('BITGO_WEBHOOK_CALLBACK'),
];
