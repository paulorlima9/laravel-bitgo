<?php

namespace PauloRLima9\LaravelBitgo\Data\Responses;

use PauloRLima9\LaravelBitgo\Data\Data;

class User extends Data
{
    /**
     * ID do usuário
     */
    public string $user;

    /**
     * Array de permissões para o usuário
     *
     * @var array<string>
     */
    public array $permissions;
}