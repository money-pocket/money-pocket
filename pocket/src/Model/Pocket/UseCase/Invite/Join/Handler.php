<?php


namespace App\Model\Pocket\UseCase\Invite\Join;


use App\Model\Flusher;
use App\Model\Pocket\Entity\Pocket\ClientId;
use App\Model\Pocket\Entity\Pocket\PocketRepository;

class Handler
{
    private PocketRepository $pockets;
    private Flusher $flusher;

    public function __construct(PocketRepository $pockets, Flusher $flusher)
    {
        $this->pockets = $pockets;
        $this->flusher = $flusher;
    }

    public function handle(Command $command): void
    {
        $clientId = new ClientId($command->clientId);

        $pocket = $this->pockets->getByClientId($clientId);
        $targetPocketId = $this->pockets->getPocketIdByInviteToken($command->inviteToken);

        $pocket->changePocketId($targetPocketId);

        $this->pockets->add($pocket);

        $this->flusher->flush();
    }
}