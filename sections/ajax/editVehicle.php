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
require_once("include/classes/Vehicle.php");
/* @var $smarty Smarty */
$id = isset($_REQUEST['id']) ? sanitize_int($_REQUEST['id']) : -1;
if ($id < 0)    throwAJAXError("Missing id");

// Get Vehicle
$veh = Vehicle::getVehicleById($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if everythings there and valid.. id, side, classname, type, pid, alive, active, plate, color, impound
    // TODO: validation
    if (!isset($_REQUEST['side']) || !isset($_REQUEST['classname']) || !isset($_REQUEST['type']) || !isset($_REQUEST['pid']) || !isset($_REQUEST['plate']) || !isset($_REQUEST['color']))
        throwAJAXError("Missing Variables");    
    
    $side = sanitize_paranoid_string($_REQUEST['side']);
    $classname = sanitize_sql_string($_REQUEST['classname']);
    $type = sanitize_paranoid_string($_REQUEST['type']);
    $pid = sanitize_paranoid_string($_REQUEST['pid']);
    $plate = sanitize_int($_REQUEST['plate']);
    $color = sanitize_int($_REQUEST['color']);
    
    $alive = (isset($_REQUEST['alive']) && $_REQUEST['alive'] == "on") ? 1 : 0;
    $active = (isset($_REQUEST['active']) && $_REQUEST['active'] == "on") ? 1 : 0;
    $impound = (isset($_REQUEST['impound']) && $_REQUEST['impound'] == "on") ? 1 : 0;
    
    $fields = array("side" => $side, "classname" => $classname, "type" => $type, "pid" => $pid, "alive" => $alive, "active" => $active, "plate" => $plate, "color" => $color, "impound" => $impound);
    
    $count = $veh->updateAndSave($fields);
    if ($count == 0)
        throwAJAXError("No row found");
    print($count);
} else {
    $colors = array();
    if (array_key_exists($veh->getClassname(),$veh_skins))
        $colors = $veh_skins[$veh->getClassname()];

    $smarty->assign('veh', $veh);
    $smarty->assign('sides', $veh_sides);
    $smarty->assign('colors', $colors);
    $smarty->display('ajax/editVehicle.tpl');
    $smarty->clearAllAssign();
}
?>