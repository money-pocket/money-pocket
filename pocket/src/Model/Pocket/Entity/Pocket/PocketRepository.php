<?php


namespace App\Model\Pocket\Entity\Pocket;


use App\Model\User\Entity\User\User;

interface PocketRepository
{
    public function hasByClientId(ClientId $clientId): bool;

    public function getByClientId(ClientId $clientId): User;

    public function add(Pocket $pocket): void;
}