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

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return ClientId
     */
    public function getClientId(): ClientId
    {
        return $this->clientId;
    }

    /**
     * @return Network
     */
    public function getNetwork(): Network
    {
        return $this->network;
    }

    /**
     * @return PocketId
     */
    public function getPocketId(): PocketId
    {
        return $this->pocketId;
    }

    /**
     * @return InviteToken
     */
    public function getInviteToken(): InviteToken
    {
        return $this->inviteToken;
    }
}