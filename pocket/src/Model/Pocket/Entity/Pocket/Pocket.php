<?php


namespace App\Model\Pocket\Entity\Pocket;


class Pocket
{
    private Id $id;
    private ClientId $clientId;
    private string $network;
    private string $pocketId;
    private string $inviteToken;

    public function __construct(Id $id, ClientId $clientId)
    {
        $this->id = $id;
    }
}