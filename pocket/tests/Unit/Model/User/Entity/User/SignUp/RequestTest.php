<?php


namespace App\Tests\Unit\Model\User\Entity\User\SignUp;


use App\Model\User\Entity\User\User;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class RequestTest extends TestCase
{
    public function testSuccess(): void
    {
        $user = new User(
            $uuid = Uuid::uuid4()->toString(),
            $date = new \DateTimeImmutable(),
            $email = 'app@app.test',
            $hash = 'hash'
        );

        self::assertEquals($uuid, $user->getId());
        self::assertEquals($date, $user->getDate());
        self::assertEquals($email, $user->getEmail());
        self::assertEquals($hash, $user->getPasswordHash());
    }
}