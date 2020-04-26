<?php


namespace App\Unit\Model\Pocket\Entity\Pocket\Invite;


use App\Model\Pocket\Entity\Pocket\InviteToken;
use App\Tests\Builder\Pocket\PocketBuilder;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function testSuccess()
    {
        $pocketBuilder = new PocketBuilder();
        $pocket = $pocketBuilder->build();

        $now = new \DateTimeImmutable();
        $token = new InviteToken('token', $now->modify('+15 minutes'));

        $pocket->requestInviteToken($token, new \DateTimeImmutable());

        self::assertNotNull($pocket->getInviteToken());
    }
}