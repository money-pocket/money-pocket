<?php


namespace App\Model\Pocket\Entity\Pocket;


interface PocketRepository
{
    public function hasByClientId(ClientId $clientId): bool;

    public function add(Pocket $pocket): void;
}