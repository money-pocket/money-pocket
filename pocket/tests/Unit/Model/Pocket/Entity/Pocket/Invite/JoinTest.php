<?php


namespace App\Unit\Model\Pocket\Entity\Pocket\Invite;


use App\Tests\Builder\Pocket\PocketBuilder;
use PHPUnit\Framework\TestCase;

class JoinTest extends TestCase
{
    public function testSuccess()
    {
        $pocketBuilder = new PocketBuilder();

        $pocket = $pocketBuilder->build();
        $targetPocket = $pocketBuilder->withInviteToken()->build();

        $targetPocket->getInviteToken()->isExpiredTo(new \DateTimeImmutable());

        $targetPocketId = $targetPocket->getPocketId();

        $pocket->changePocketId($targetPocketId);
        $targetPocket->removeInviteToken();

        self::assertEquals($targetPocketId, $pocket->getPocketId());
        self::assertNull($targetPocket->getInviteToken());
    }
}