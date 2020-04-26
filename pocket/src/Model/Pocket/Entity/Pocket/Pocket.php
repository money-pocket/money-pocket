<?php


namespace App\Model\Pocket\Entity\Pocket;


class Pocket
{
    private Id $id;
    private ClientId $clientId;
    private Network $network;
    private PocketId $pocketId;
    private ?InviteToken $inviteToken;

    public function __construct(
        Id $id,
        ClientId $clientId,
        Network $network,
        PocketId $pocketId,
        InviteToken $inviteToken = null
    ) {
        $this->id = $id;
        $this->clientId = $clientId;
        $this->network = $network;
        $this->pocketId = $pocketId;
        $this->inviteToken = $inviteToken;
    }

    /**
     * @param InviteToken $inviteToken
     * @param \DateTimeImmutable $date
     */
    public function requestInviteToken(InviteToken $inviteToken, \DateTimeImmutable $date): void
    {
        if ($this->inviteToken && !$this->inviteToken->isExpiredTo($date)) {
            throw new \DomainException('Invite token is already created');
        }

        $this->inviteToken = $inviteToken;
    }

    /**
     * @param PocketId $pocketId
     */
    public function changePocketId(PocketId $pocketId): void
    {
        $this->pocketId = $pocketId;
    }


    public function removeInviteToken(): void
    {
        $this->inviteToken = null;
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