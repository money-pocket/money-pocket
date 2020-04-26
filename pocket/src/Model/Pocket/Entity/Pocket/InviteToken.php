<?php


namespace App\Model\Pocket\Entity\Pocket;


use Webmozart\Assert\Assert;

class InviteToken
{
    private string $token;

    private \DateTimeImmutable $expires;

    public function __construct(string $token, \DateTimeImmutable $expires)
    {
        Assert::notEmpty($token);
        
        $this->token = $token;
        $this->expires = $expires;
    }

    /**
     * @param \DateTimeImmutable $date
     * @return bool
     */
    public function isExpiredTo(\DateTimeImmutable $date): bool
    {
        return $this->expires <= $date;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }
}