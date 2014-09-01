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
require_once("include/classes/Gang.php");
/* @var $smarty Smarty */
$id = isset($_REQUEST['id']) ? sanitize_int($_REQUEST['id']) : -1;
if ($id < 0) throwAJAXError("Missing id");

// Get Vehicle
$gang = Gang::getGangByID($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if everythings there and valid.. id, side, classname, type, pid, alive, active, plate, color, impound
    // TODO: validation
    if (!isset($_REQUEST['owner']) || !isset($_REQUEST['name']) || !isset($_REQUEST['members']) || !isset($_REQUEST['maxmembers']) || !isset($_REQUEST['bank']))
        throwAJAXError("Missing Variables");    
    
    $owner = sanitize_paranoid_string($_REQUEST['owner']);
    $name = sanitize_sql_string($_REQUEST['name']);
    $members = sanitize_sql_string($_REQUEST['members']);
    $maxmembers = sanitize_int($_REQUEST['maxmembers']);
    $bank = sanitize_int($_REQUEST['bank']);

    $active = (isset($_REQUEST['active']) && $_REQUEST['active'] == "on") ? 1 : 0;
    
    $members = simpleCommaSepListToBISArray($members);

    $fields = array("owner" => $owner, "name" => $name, "members" => $members, "maxmembers" => $maxmembers, "bank" => $bank, "active" => $active);
    
    $count = $gang->updateAndSave($fields);
    if ($count == 0)
        throwAJAXError("No row found");
    print($count);
} else {
    $members = array();

    $smarty->assign('gang', $gang);
    $smarty->display('ajax/editGang.tpl');
    $smarty->clearAllAssign();
}
?>