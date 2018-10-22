<?php
/**
 * Created by PhpStorm.
 * User: guillaume
 * Date: 23/04/2018
 * Time: 15:24
 */

namespace AGORA\Game\AveCesarBundle\Model;


class Util {

    public function createMap() {
        $boardMap = Array();

        $boardMap["0a"] = array("1a");

        $boardMap["0b"] = array("2b", "2c");
        $boardMap["0c"] = array("2b", "2c", "2d");
        $boardMap["0d"] = array("2c", "2d", "2e");
        $boardMap["0e"] = array("2d", "2e", "2f");
        $boardMap["0f"] = array("2e", "2f", "2g");
        $boardMap["0g"] = array("2f", "2g");

        $boardMap["1a"] = array("2a");

        $boardMap["2a"] = array("3a");
        $boardMap["2b"] = array("3a", "3b");
        $boardMap["2c"] = array("3a", "3b", "3c");
        $boardMap["2d"] = array("3b", "3c", "3d");
        $boardMap["2e"] = array("3c", "3d", "3e");
        $boardMap["2f"] = array("3d", "3e");
        $boardMap["2g"] = array("3e");

        $boardMap["3a"] = array("4a");
        $boardMap["3b"] = array("4a", "4b");
        $boardMap["3c"] = array("4a", "4b", "4c");
        $boardMap["3d"] = array("4b", "4c", "4d");
        $boardMap["3e"] = array("4c", "4d");

        $boardMap["4a"] = array("5a");
        $boardMap["4b"] = array("5a", "5b");
        $boardMap["4c"] = array("5a", "5b", "5c");
        $boardMap["4d"] = array("5b", "5c");

        $boardMap["5a"] = array("6a");
        $boardMap["5b"] = array("6b");
        $boardMap["5c"] = array("6b");

        $boardMap["6a"] = array("7a");
        $boardMap["6b"] = array("7a");

        $boardMap["7a"] = array("8a", "8b");

        $boardMap["8a"] = array("9a", "10b");
        $boardMap["8b"] = array("9a", "10b");

        $boardMap["9a"] = array("10a");
        $boardMap["10a"] = array("11a", "11b");
        $boardMap["10b"] = array("11a", "11b");

        $boardMap["11a"] = array("12a", "12b");
        $boardMap["11b"] = array("12a", "12b");

        $boardMap["12a"] = array("13a", "15b");
        $boardMap["12b"] = array("13a", "15b");

        $boardMap["13a"] = array("14a");
        $boardMap["14a"] = array("15a");

        $boardMap["15a"] = array("16a");
        $boardMap["15b"] = array("16b");

        $boardMap["16a"] = array("17a");
        $boardMap["16b"] = array("17a");

        $boardMap["17a"] = array("18a", "18b");

        $boardMap["18a"] = array("19a", "21b");
        $boardMap["18b"] = array("19a", "21b");

        $boardMap["19a"] = array("20a");
        $boardMap["21b"] = array("22a", "22b");

        $boardMap["20a"] = array("21a");

        $boardMap["21a"] = array("22a", "22b");

        $boardMap["22a"] = array("23a", "24b");
        $boardMap["22b"] = array("23a", "24b");

        $boardMap["23a"] = array("24a");
        $boardMap["24b"] = array("25a");

        $boardMap["24a"] = array("25a");

        $boardMap["25a"] = array("26a", "26b");

        $boardMap["26a"] = array("27a");
        $boardMap["26b"] = array("27b");

        $boardMap["27a"] = array("28a", "28b", "28c");
        $boardMap["27b"] = array("28b", "28c");

        $boardMap["28a"] = array("29a", "29b", "29c");
        $boardMap["28b"] = array("29b", "29c", "29d");
        $boardMap["28c"] = array("29c", "29d", "29e");

        $boardMap["29a"] = array("30a", "0b", "0c");
        $boardMap["29b"] = array("0b", "0c", "0d");
        $boardMap["29c"] = array("0c", "0d", "0e");
        $boardMap["29d"] = array("0d", "0e", "0f");
        $boardMap["29e"] = array("0e", "0f", "0g");

        $boardMap["30a"] = array("31a");

        $boardMap["31a"] = array("0a");

        return $boardMap;
    }
}