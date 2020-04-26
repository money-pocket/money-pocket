<?php


namespace App\Tests\Builder\Pocket;


use App\Model\Pocket\Entity\Pocket\ClientId;
use App\Model\Pocket\Entity\Pocket\Id;
use App\Model\Pocket\Entity\Pocket\InviteToken;
use App\Model\Pocket\Entity\Pocket\Network;
use App\Model\Pocket\Entity\Pocket\PocketId;

class PocketBuilder
{
    private Id $id;
    private ClientId $clientId;
    private Network $network;
    private PocketId $pocketId;
    private ?InviteToken $inviteToken;

    public function __construct()
    {
        $this->id = Id::next();
        $this->clientId = new ClientId('clientId');
        $this->network = new Network('network');
        $this->pocketId = new PocketId('pocketId');
    }

    public function build(): self
    {
        $clone = clone $this;

        return $clone;
    }

    /**
     * @param InviteToken $inviteToken
     * @return $this
     */
    public function withInviteToken(InviteToken $inviteToken): self
    {
        $clone = clone $this;
        $clone->inviteToken = $inviteToken;

        return $clone;
    }
}