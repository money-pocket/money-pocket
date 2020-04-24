<?php


namespace App\Model\Pocket\Entity\Pocket;


class Pocket
{
    private Id $id;
    private ClientId $clientId;
    private Network $network;
    private PocketId $pocketId;
    private InviteToken $inviteToken;

    public function __construct(
        Id $id,
        ClientId $clientId,
        Network $network,
        PocketId $pocketId,
        InviteToken $inviteToken
    ) {
        $this->id = $id;
        $this->clientId = $clientId;
        $this->network = $network;
        $this->pocketId = $pocketId;
        $this->inviteToken = $inviteToken;
    }
}