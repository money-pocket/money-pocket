<?php


namespace App\Model\User\UseCase\SignUp\Request;


use App\Model\User\Entity\User\User;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use DomainException;
use Ramsey\Uuid\Uuid;

class Handler
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function handle(Command $command): void
    {
        $email = mb_strtolower($command->email);

        if ($this->em->getRepository(User::class)->findOneBy(['email' => $email])) {
            throw new DomainException('User already exists');
        }

        $user = new User(
            Uuid::uuid4()->toString(),
            new DateTimeImmutable(),
            $email,
            password_hash($command->password, PASSWORD_ARGON2I)
        );

        $this->em->persist($user);
        $this->em->flush();
    }
}