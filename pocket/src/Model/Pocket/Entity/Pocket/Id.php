<?php


namespace App\Model\Pocket\Entity\Pocket;


use Ramsey\Uuid\Uuid;

class Id
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function next()
    {
        return new self(Uuid::uuid4()->toString());
    }

    public function getValue()
    {
        return $this->value;
    }
}