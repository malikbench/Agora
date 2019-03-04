<?php

namespace AGORA\Game\AugustusBundle\Entity;

abstract class AugustusToken
{
    const SHIELD    = "shield";
    const KNIFE = "knife";
    const CHARIOT = "chariot";
    const DOUBLESWORD = "double sword";
    const CATAPULT = "catapult";
    const JOKER = "joker";
    const TEACHES = "teaches";

    /** @var array user friendly named token */
    protected static $tokenName = [
        self::KNIFE    => 'Poignard',
        self::SHIELD => 'Bouclier',
        self::CHARIOT => 'Char',
        self::DOUBLESWORD => 'Double glaive',
        self::CATAPULT => 'Catapulte',
        self::JOKER => 'Joker',
        self::TEACHES => 'Enseigne',

    ];

    /**
     * @param  string $tokenShortName
     * @return string
     */
    public static function getTokenName($tokenShortName)
    {
        if (!isset(static::$tokenName[$tokenShortName])) {
            return "Unknown token ($tokenShortName)";
        }

        return static::$tokenName[$tokenShortName];
    }

    /**
     * @return array<string>
     */
    public static function getAvailableTokens()
    {
        return [
            self::KNIFE,
            self::SHIELD
        ];
    }
}