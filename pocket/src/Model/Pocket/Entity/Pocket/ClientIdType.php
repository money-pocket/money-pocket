<?php


namespace App\Model\Pocket\Entity\Pocket;


use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class ClientIdType extends StringType
{
    public const NAME = 'pocket_client_id';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof ClientId ? $value->getValue() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return !empty($value) ? new ClientId($value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}