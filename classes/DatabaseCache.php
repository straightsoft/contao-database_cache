<?php

namespace StraightSoft\DatabaseCache;

use HeimrichHannot\Haste\DateUtil;

class DatabaseCache
{
    const DEFAULT_MAX_CACHE_TIME = ['unit' => 'd', 'value' => 1];

    public static function keyExists($strKey)
    {
        $objResult = \Database::getInstance()->prepare('SELECT * FROM tl_db_cache WHERE cacheKey = ?')->execute($strKey);
        return $objResult->numRows > 0;
    }

    public static function getValue($strKey)
    {
        if (!\Config::get('activateDbCache'))
        {
            return false;
        }

        $objDatabase = \Database::getInstance();

        // clean expired values at first (self-purification)
        $objDatabase->prepare('DELETE FROM tl_db_cache WHERE expiration < ?')->execute(time());

        $objResult = $objDatabase->prepare('SELECT * FROM tl_db_cache WHERE cacheKey = ?')->execute($strKey);

        if ($objResult->numRows > 0)
        {
            return $objResult->cacheValue;
        }

        return false;
    }

    public static function cacheValue($strKey, $strValue)
    {
        if (!\Config::get('activateDbCache'))
        {
            return false;
        }

        if (static::getValue($strKey))
        {
            throw new \Exception('Duplicate entry in tl_db_cache for key ' . $strKey);
        }

        $objDatabase = \Database::getInstance();

        $objDatabase->prepare('INSERT INTO tl_db_cache (tstamp, expiration, cacheKey, cacheValue) VALUES (?, ?, ?, ?)')->execute(
            time(),
            time() + DateUtil::getTimePeriodInSeconds(deserialize(\Config::get('dbCacheMaxTime'), true)),
            $strKey,
            $strValue
        );
    }
}