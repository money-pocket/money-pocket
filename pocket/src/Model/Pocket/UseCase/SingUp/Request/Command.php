<?php


namespace App\Model\Pocket\UseCase\SingUp\Request;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @Assert\NotBlank()
     */
    public string $clientId;
    /**
     * @Assert\NotBlank()
     */
    public string $network;
}