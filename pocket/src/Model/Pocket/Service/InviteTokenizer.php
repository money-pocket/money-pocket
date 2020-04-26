<?php


namespace Model\Pocket\Service;


use Ramsey\Uuid\Uuid;

class InviteTokenizer
{
    /**
     * @return string
     */
    public function generate(): string
    {
        return Uuid::uuid4()->toString();
    }
}