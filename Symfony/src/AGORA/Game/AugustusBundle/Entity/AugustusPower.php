<?php

namespace AGORA\Game\AugustusBundle\Entity;

// /!\ /!\ /!\
//Simple copy paste de Resources pour le moment le temps de determiner la liste des Pouvoirs
// /!\ /!\ /!\

abstract class AugustusPower
{
    const WHEAT = "wheat";
    const GOLD = "gold";

    /** @var array user friendly named power */
    protected static $powerName = [
        self::GOLD    => 'Or',
        self::WHEAT => 'Blé',
    ];

    /**
     * @param  string $powerShortName
     * @return string
     */
    public static function getPowerName($powerShortName)
    {
        if (!isset(static::$powerName[$powerShortName])) {
            return "Unknown power ($powerShortName)";
        }

        return static::$powerName[$powerShortName];
    }

    /**
     * @return array<string>
     */
    public static function getAvailablePowers()
    {
        return [
            self::GOLD,
            self::WHEAT
        ];
    }
}