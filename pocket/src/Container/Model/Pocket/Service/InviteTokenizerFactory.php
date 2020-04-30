<?php


namespace App\Container\Model\Pocket\Service;


use Model\Pocket\Service\InviteTokenizer;

class InviteTokenizerFactory
{
    public function create(string $interval): InviteTokenizer
    {
        return new InviteTokenizer(new \DateInterval($interval));
    }
}