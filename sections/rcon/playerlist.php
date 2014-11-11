<?php

/*
 * Copyright (C) 2014 ishi
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
require_once("libs/ArmaRcon/RconClient.php");
require_once("include/classes/Player.php");
/* @var $smarty Smarty */

$rcon = new RconClient("gameserver.westerland-altis.de", 2302, "trikitakei_2014!!0815");
//$rcon = new RconClient("localhost", 2302, "xyz");
$rcon->connect();
$playerListRaw = $rcon->sendCommand("players");
$rcon->disconnect();

$playerListRawL = explode("\n", $playerListRaw);
$playerList = array();
$skip = true;
$count = 0;
foreach ($playerListRawL as $row) {
    if (strpos($row, '-----------------------------------') !== false || strpos($row, 'in total)') !== false)
        $skip = !$skip;
    else if (!$skip) {
        $plr = preg_replace("/[[:blank:]]+/", " ", $row); // trim additional spaces to be able to cut into substrings
        // with ' ' as delim
        $plr = explode(" ", $plr); // 0 -> #, 1 -> ip:port, 2 -> ping, 3 -> guid, 4+ -> playername
        $name = "";
        for ($i = 4; $i < count($plr); $i++)
            $name .= " ".$plr[$i];
        $ipport = explode(":", $plr[1]); // 0 -> ip, 1 -> port
        $playerList[] = array("num" => $plr[0], "ip" => $ipport[0], "port" => $ipport[1], "ping" => $plr[2], "guid" => str_replace(array("(OK)", "(?)"), array("", ""), $plr[3]), "name" => trim($name));
    }
    $count++;
}
/*print "<pre>";
//print_r($playerList);
//print_r($playerListRawL);
print $playerListRaw;
print "</pre>";*/

$smarty->assign('players', $playerList);
$smarty->display('rcon/playerlist.tpl');
$smarty->clearAllAssign();
?>