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
require_once("include/classes/House.php");
/* @var $smarty Smarty */
$id = isset($_REQUEST['id']) ? sanitize_int($_REQUEST['id']) : -1;
if ($id < 0) throwAJAXError("Missing id");

// Get House
$house = House::getHouseById($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if everythings there and valid.. id, side, classname, type, pid, alive, active, plate, color, impound
    // TODO: validation
    if (!isset($_REQUEST['pid']) || !isset($_REQUEST['pos']) || !isset($_REQUEST['inventory']) || !isset($_REQUEST['containers']))
        throwAJAXError("Missing Variables");    
    
    $pid = sanitize_paranoid_string($_REQUEST['pid']);
    $pos = sanitize_sql_string($_REQUEST['pos']);
    $inventory = '"'.sanitize_sql_string($_REQUEST['inventory']).'"';
    $containers = '"'.sanitize_sql_string($_REQUEST['containers']).'"';

    $owned = (isset($_REQUEST['owned']) && $_REQUEST['owned'] == "on") ? 1 : 0;

    $fields = array("pid" => $pid, "pos" => $pos, "inventory" => $inventory, "containers" => $containers, "owned" => $owned);
    
    $count = $house->updateAndSave($fields);
    if ($count == 0)
        throwAJAXError("No row found");
    print($count);
} else {
    $smarty->assign('house', $house);
    $smarty->display('ajax/editHouse.tpl');
    $smarty->clearAllAssign();
}
?>