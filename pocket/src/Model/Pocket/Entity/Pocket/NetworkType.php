<?php


namespace App\Model\Pocket\Entity\Pocket;


use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class NetworkType extends StringType
{
    public const NAME = 'pocket_network';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof Network ? $value->getValue() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return !empty($value) ? new Network($value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}