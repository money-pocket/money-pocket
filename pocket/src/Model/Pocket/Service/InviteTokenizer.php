<?php


namespace Model\Pocket\Service;


use App\Model\Pocket\Entity\Pocket\InviteToken;
use Ramsey\Uuid\Uuid;

class InviteTokenizer
{
    private \DateInterval $interval;

    public function __construct(\DateInterval $interval)
    {
        $this->interval = $interval;
    }

    /**
     * @return InviteToken
     */
    public function generate(): InviteToken
    {
        return new InviteToken(
            Uuid::uuid4()->toString(),
            (new \DateTimeImmutable())->add($this->interval)
        );
    }
}