<?php


namespace App\Model\Pocket\Entity\Pocket;


class Pocket
{
    private Id $id;
    private string $clientId;
    private string $network;
    private string $pocketId;
    private string $inviteToken;

    public function __construct(Id $id)
    {
        $this->id = $id;
    }
}