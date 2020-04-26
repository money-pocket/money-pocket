<?php


namespace App\Tests\Builder\Pocket;


use App\Model\Pocket\Entity\Pocket\ClientId;
use App\Model\Pocket\Entity\Pocket\Id;
use App\Model\Pocket\Entity\Pocket\InviteToken;
use App\Model\Pocket\Entity\Pocket\Network;
use App\Model\Pocket\Entity\Pocket\Pocket;
use App\Model\Pocket\Entity\Pocket\PocketId;

class PocketBuilder
{
    private Id $id;
    private \DateTimeImmutable $date;
    private ClientId $clientId;
    private Network $network;
    private PocketId $pocketId;
    private ?InviteToken $inviteToken;

    public function __construct(
        Id $id = null,
        \DateTimeImmutable $date = null,
        ClientId $clientId = null,
        Network $network = null,
        PocketId $pocketId = null
    ) {
        $this->id = $id ?? Id::next();
        $this->date = $date ?? new \DateTimeImmutable();
        $this->clientId = $clientId ?? new ClientId('clientId');
        $this->network = $network ?? new Network('network');
        $this->pocketId = $pocketId ?? new PocketId('pocketId');
        $this->inviteToken = null;
    }

    public function build(): Pocket
    {
        $pocket = new Pocket(
            $this->id,
            $this->date,
            $this->clientId,
            $this->network,
            $this->pocketId,
        );

        if ($this->inviteToken) {
            $pocket->requestInviteToken($this->inviteToken, new \DateTimeImmutable());
        }

        return $pocket;
    }

    /**
     * @param InviteToken $inviteToken
     * @return $this
     */
    public function withInviteToken(InviteToken $inviteToken = null): self
    {
        $clone = clone $this;
        $clone->inviteToken = $inviteToken ??
            new InviteToken('token', new \DateTimeImmutable('+15 minutes'));

        return $clone;
    }
}