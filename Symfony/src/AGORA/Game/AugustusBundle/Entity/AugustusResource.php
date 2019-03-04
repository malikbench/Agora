<?php

namespace AGORA\Game\AugustusBundle\Entity;

abstract class AugustusResource
{
    const WHEAT    = "wheat";
    const GOLD = "gold";

    /** @var array user friendly named resource */
    protected static $resourceName = [
        self::GOLD    => 'Or',
        self::WHEAT => 'Blé',
    ];

    /**
     * @param  string $resourceShortName
     * @return string
     */
    public static function getResourceName($resourceShortName)
    {
        if (!isset(static::$resourceName[$resourceShortName])) {
            return "Unknown resource ($resourceShortName)";
        }

        return static::$resourceName[$resourceShortName];
    }

    /**
     * @return array<string>
     */
    public static function getAvailableResources()
    {
        return [
            self::GOLD,
            self::WHEAT
        ];
    }
}