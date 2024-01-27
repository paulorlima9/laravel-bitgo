<?php

namespace PauloRLima9\LaravelBitgo\Data\Responses;

use PauloRLima9\LaravelBitgo\Data\Data;

class User extends Data
{
    /**
     * id of the user
     */
    public string $user;

    /**
     * Array of permissions for the user
     *
     * @var array<string>
     */
    public array $permissions;
}
