<?php


namespace App\Model\Pocket\Entity\Pocket;


use Ramsey\Uuid\Uuid;
use Webmozart\Assert\Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Id
{
    /**
     * @ORM\Column(type="string")
     */
    private string $id;

    public function __construct(string $value)
    {
        Assert::notEmpty($value);
        $this->id = $value;
    }

    /**
     * @return Id
     */
    public static function next(): Id
    {
        return new self(Uuid::uuid4()->toString());
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getValue();
    }
}