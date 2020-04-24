<?php


namespace App\Model\User\UseCase\SignUp\Confirm;


use App\Model\User\Entity\User\UserRepository;

class Handler
{
    private UserRepository $users;
    private Flusher $flusher;

    public function __construct(UserRepository $users, Flusher $flusher)
    {
        $this->users = $users;
        $this->flusher = $flusher;
    }

    public function handle(Command $command)
    {
        if (!$user = $this->users->findByConfirmToken($command->token)) {
            throw new \DomainException('Incorrect or already confirmed token');
        }

        $user->confirmSignUp();

        $this->flusher->flush();
    }
}