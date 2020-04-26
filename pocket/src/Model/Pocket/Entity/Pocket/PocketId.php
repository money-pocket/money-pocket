<?php


namespace App\Model\Pocket\Entity\Pocket;


use Ramsey\Uuid\Uuid;
use Webmozart\Assert\Assert;

class PocketId
{
    private string $value;

    public function __construct(string $value)
    {
        Assert::notEmpty($value);
        $this->value = $value;
    }

    /**
     * @return static
     */
    public static function next(): PocketId
    {
        return new self(Uuid::uuid4()->toString());
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}