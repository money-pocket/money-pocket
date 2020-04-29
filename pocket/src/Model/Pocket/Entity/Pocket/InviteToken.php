<?php


namespace App\Model\Pocket\Entity\Pocket;


use Webmozart\Assert\Assert;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Embeddable()
 */
class InviteToken
{
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private string $token;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
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