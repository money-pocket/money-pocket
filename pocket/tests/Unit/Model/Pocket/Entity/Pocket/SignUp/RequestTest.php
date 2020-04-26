<?php


namespace App\Tests\Unit\Model\Pocket\Entity\Pocket\SignUp;


use App\Model\Pocket\Entity\Pocket\ClientId;
use App\Model\Pocket\Entity\Pocket\Id;
use App\Model\Pocket\Entity\Pocket\InviteToken;
use App\Model\Pocket\Entity\Pocket\Network;
use App\Model\Pocket\Entity\Pocket\Pocket;
use App\Model\Pocket\Entity\Pocket\PocketId;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function testSuccess(): void
    {
        $pocket = new Pocket(
            $id = Id::next(),
            $date = new \DateTimeImmutable(),
            $clientId = new ClientId('clientId'),
            $network = new Network('network'),
            $pocketId = PocketId::next(),
            $inviteToken = new InviteToken('token', new \DateTimeImmutable())
        );

        self::assertEquals($id, $pocket->getId());
        self::assertEquals($date, $pocket->getDate());
        self::assertEquals($clientId, $pocket->getClientId());
        self::assertEquals($network, $pocket->getNetwork());
        self::assertEquals($pocketId, $pocket->getPocketId());
        self::assertEquals($inviteToken, $pocket->getInviteToken());
    }
}