<?php


namespace App\Model\Pocket\UseCase\SingUp\Request;


use App\Model\Flusher;
use App\Model\Pocket\Entity\Pocket\ClientId;
use App\Model\Pocket\Entity\Pocket\Id;
use App\Model\Pocket\Entity\Pocket\Network;
use App\Model\Pocket\Entity\Pocket\Pocket;
use App\Model\Pocket\Entity\Pocket\PocketId;
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
        $network = new Network($command->network);

        if ($this->pockets->hasByClientId($clientId)) {
            throw new \DomainException('User already exists');
        }

        $pocket = new Pocket(
            Id::next(),
            new \DateTimeImmutable(),
            $clientId,
            $network,
            PocketId::next()
        );

        $this->pockets->add($pocket);

        $this->flusher->flush();
    }
}