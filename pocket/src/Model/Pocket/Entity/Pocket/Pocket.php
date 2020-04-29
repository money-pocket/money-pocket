<?php


namespace App\Model\Pocket\Entity\Pocket;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="pockets", uniqueConstraints={
        @ORM\UniqueConstraint(columns={"client_id"}
        @ORM\UniqueConstraint(columns={"invite_token"}
 * })
 */
class Pocket
{
    /**
     * @ORM\Column(type="pocket_id")
     * @ORM\Id
     */
    private Id $id;
    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private \DateTimeImmutable $date;
    /**
     * @ORM\Column(type="pocket_client_id")
     */
    private ClientId $clientId;
    /**
     * @ORM\Column(type="pocket_network")
     */
    private Network $network;
    /**
     * @ORM\Column(type="pocket_pocket_id")
     */
    private PocketId $pocketId;
    /**
     * @ORM\Embedded(class="InviteToken", columnPrefix="invite_token_")
     */
    private ?InviteToken $inviteToken;

    public function __construct(
        Id $id,
        \DateTimeImmutable $date,
        ClientId $clientId,
        Network $network,
        PocketId $pocketId,
        InviteToken $inviteToken = null
    ) {
        $this->id = $id;
        $this->date = $date;
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
     * @param InviteToken $inviteToken
     * @param \DateTimeImmutable $date
     */
    public function changePocketIdByInviteToken(
        PocketId $pocketId,
        InviteToken $inviteToken,
        \DateTimeImmutable $date
    ): void {
        if ($inviteToken->isExpiredTo($date)) {
            throw new \DomainException('Expired or invalid token');
        }

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
     * @return \DateTimeImmutable
     */
    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
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
    public function getInviteToken(): ?InviteToken
    {
        return $this->inviteToken;
    }

    /**
     * @ORM\PostLoad
     */
    public function checkEmbeds(): void
    {
        if (!$this->inviteToken->getToken()) {
            $this->inviteToken = null;
        }
    }
}