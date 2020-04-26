<?php


namespace App\Model\Pocket\UseCase\Invite\Request;


use App\Model\Flusher;
use App\Model\Pocket\Entity\Pocket\ClientId;
use App\Model\Pocket\Entity\Pocket\PocketRepository;
use Model\Pocket\Service\InviteTokenizer;

class Handler
{
    private PocketRepository $pockets;
    private InviteTokenizer $tokenizer;
    private Flusher $flusher;

    public function __construct(PocketRepository $pockets, InviteTokenizer $tokenizer, Flusher $flusher)
    {
        $this->pockets = $pockets;
        $this->tokenizer = $tokenizer;
        $this->flusher = $flusher;
    }

    public function handle(Command $command): void
    {
        $clientId = new ClientId($command->clientId);
        $pocket = $this->pockets->getByClientId($clientId);

        $pocket->requestInviteToken(
            $this->tokenizer->generate(),
            new \DateTimeImmutable()
        );

        $this->flusher->flush();
    }
}