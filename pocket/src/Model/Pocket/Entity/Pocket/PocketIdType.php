<?php


namespace App\Model\Pocket\Entity\Pocket;


use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;
use Doctrine\DBAL\Types\StringType;

class PocketIdType extends GuidType
{
    public const NAME = 'pocket_pocket_id';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof PocketId ? $value->getValue() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return !empty($value) ? new PocketId($value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * @param AbstractPlatform $platform
     * @return bool
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}