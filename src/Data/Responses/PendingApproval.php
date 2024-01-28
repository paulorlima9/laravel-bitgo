<?php

namespace PauloRLima9\LaravelBitgo\Data\Responses;

use PauloRLima9\LaravelBitgo\Data\Data;

class PendingApproval extends Data
{
    /**
     * Tempo em que a carteira fica congelada
     *
     * @var string (Id) ^[0-9a-f]{32}$
     */
    public string $id;

    /**
     * Um símbolo de ticker de criptomoeda ou token.
     */
    public string $coin;

    /**
     * @var string (Id) ^[0-9a-f]{32}$
     */
    public string $wallet;

    /**
     * @var string (Id) ^[0-9a-f]{32}$
     */
    public string $enterprise;

    /**
     * @var string (Id) ^[0-9a-f]{32}$
     */
    public string $creator;

    /**
     * @var string date-time
     */
    public string $createDate;

    public array $info;

    public array $state;

    /**
     * Tipo de entidade à qual a Aprovação Pendente está vinculada
     */
    public string $scope;

    /**
     * Todos os usuários que devem ver esta Aprovação Pendente
     */
    public string $userIds;

    public int $approvalsRequired;

    public string $walletLabel;
}
