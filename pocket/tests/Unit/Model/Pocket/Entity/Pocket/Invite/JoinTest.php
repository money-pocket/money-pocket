<?php


namespace App\Unit\Model\Pocket\Entity\Pocket\Invite;


use App\Tests\Builder\Pocket\PocketBuilder;
use PHPUnit\Framework\TestCase;

class JoinTest extends TestCase
{
    public function testSuccess()
    {
        $pocketBuilder = new PocketBuilder();
        $now = new \DateTimeImmutable();

        $pocket = $pocketBuilder->build();
        $targetPocket = $pocketBuilder->withInviteToken()->build();

        $targetPocketId = $targetPocket->getPocketId();

        $pocket->changePocketIdByInviteToken(
            $targetPocketId,
            $targetPocket->getInviteToken(),
            $now
        );
        $targetPocket->removeInviteToken();

        self::assertEquals($targetPocketId, $pocket->getPocketId());
        self::assertNull($targetPocket->getInviteToken());
    }

    public function testExpired()
    {
        $pocketBuilder = new PocketBuilder();
        $now = new \DateTimeImmutable();

        $pocket = $pocketBuilder->build();
        $targetPocket = $pocketBuilder->withInviteToken()->build();

        $targetPocketId = $targetPocket->getPocketId();

        $this->expectExceptionMessage('Expired or invalid token');

        $pocket->changePocketIdByInviteToken(
            $targetPocketId,
            $targetPocket->getInviteToken(),
            $now->modify('+1 day')
        );
    }
}