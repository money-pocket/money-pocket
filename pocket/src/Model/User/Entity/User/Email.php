<?php


namespace App\Model\User\Entity\User;


use Webmozart\Assert\Assert;

class Email
{
    private string $value;

    public function __construct(string $value)
    {
        Assert::notEmpty($value);
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Incorrect Email.');
        }

        $this->value = (string)mb_strtolower($value);
    }

    public function getValue(): string
    {
        return $this->value;
    }
}