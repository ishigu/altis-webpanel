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
require_once("include/classes/Player.php");
/* @var $smarty Smarty */
$uid = isset($_REQUEST['uid']) ? sanitize_int($_REQUEST['uid']) : -1;
if ($uid < 0) throwAJAXError("Missing id");

// Get Player
$plr = Player::getPlayerByUID($uid);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if everythings there and valid.. id, side, classname, type, pid, alive, active, plate, color, impound
    // TODO: validation
    if (!isset($_REQUEST['name']) || !isset($_REQUEST['playerid']) || !isset($_REQUEST['cash']) || !isset($_REQUEST['bankacc']) || !isset($_REQUEST['coplevel'])
        || !isset($_REQUEST['cop_licenses']) || !isset($_REQUEST['civ_licenses']) || !isset($_REQUEST['med_licenses']) || !isset($_REQUEST['cop_gear'])
        || !isset($_REQUEST['mediclevel']) || !isset($_REQUEST['aliases']) || !isset($_REQUEST['adminlevel']) || !isset($_REQUEST['donatorlvl'])
        || !isset($_REQUEST['civ_gear']) || !isset($_REQUEST['reb_gear']) || !isset($_REQUEST['rebellevel']))
        throwAJAXError("Missing Variables");    

    $name = sanitize_sql_string($_REQUEST['name']);
    $playerid = sanitize_paranoid_string($_REQUEST['playerid']);
    $cash = sanitize_int($_REQUEST['cash']);
    $bankacc = sanitize_int($_REQUEST['bankacc']);
    $coplevel = sanitize_paranoid_string($_REQUEST['coplevel']);
    $cop_licenses = '"'.sanitize_sql_string($_REQUEST['cop_licenses']).'"';
    $civ_licenses = '"'.sanitize_sql_string($_REQUEST['civ_licenses']).'"';
    $med_licenses = '"'.sanitize_sql_string($_REQUEST['med_licenses']).'"';
    $cop_gear = '"'.sanitize_sql_string($_REQUEST['cop_gear']).'"';
    $mediclevel = sanitize_paranoid_string($_REQUEST['mediclevel']);
    $aliases = '"'.sanitize_sql_string($_REQUEST['aliases']).'"';
    $adminlevel = sanitize_paranoid_string($_REQUEST['adminlevel']);
    $donatorlvl = sanitize_paranoid_string($_REQUEST['donatorlvl']);
    $civ_gear = '"'.sanitize_sql_string($_REQUEST['civ_gear']).'"';
    $reb_gear = '"'.sanitize_sql_string($_REQUEST['reb_gear']).'"';
    $rebellevel = sanitize_paranoid_string($_REQUEST['rebellevel']);

    $arrested = (isset($_REQUEST['arrested']) && $_REQUEST['arrested'] == "on") ? 1 : 0;
    $blacklist = (isset($_REQUEST['blacklist']) && $_REQUEST['blacklist'] == "on") ? 1 : 0;

    $fields = array("name" => $name, "playerid" => $playerid, "cash" => $cash, "bankacc" => $bankacc, "coplevel" => $coplevel, "cop_licenses" => $cop_licenses,
        "civ_licenses" => $civ_licenses, "med_licenses" => $med_licenses, "cop_gear" => $cop_gear, "mediclevel" => $mediclevel, "arrested" => $arrested,
        "aliases" => $aliases, "adminlevel" => $adminlevel, "donatorlvl" => $donatorlvl, "civ_gear" => $civ_gear, "blacklist" => $blacklist,
        "reb_gear" => $reb_gear, "rebellevel" => $rebellevel);
    
    $count = $plr->updateAndSave($fields);
    if ($count == 0)
        throwAJAXError("No row found");
    print($count);
} else {
    $smarty->assign('player', $plr);
    $smarty->display('ajax/editPlayer.tpl');
    $smarty->clearAllAssign();
}
?>