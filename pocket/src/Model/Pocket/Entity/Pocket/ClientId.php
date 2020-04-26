<?php


namespace App\Model\Pocket\Entity\Pocket;


use Webmozart\Assert\Assert;

class ClientId
{
    private string $value;

    public function __construct(string $value)
    {
        Assert::notEmpty($value);
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}