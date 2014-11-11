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

function readBans() {
    $rawData = file_get_contents(BANS_PATH);
    $rows = explode("\n", $rawData);
    $bans = array();
    for ($i = 0; $i < count($rows); $i++) {
        if (empty(trim(str_replace("\n", "", $rows[$i]))))
            continue;
        
        // Split row (GUID/IP TIME REASON)
        $lData = explode(" ", $rows[$i]);
        $reason = "";
        for ($j = 2; $j < count($lData); $j++)
            $reason .= $lData[$j] . " ";
        $reason = trim($reason);
        
        if (preg_match('/^[a-f0-9]{32}$/', $lData[0]))
            $type = 0;
        else
            $type = 1;
        
        $bans[] = array("type" => $type, "identifier" => $lData[0], "time" => $lData[1], "reason" => $reason);
    }
    
    return $bans;
}

function addBan($type, $id, $time, $reason) {
    $curBans = readBans();
    $newBans = array();
    $inserted = false;

    for ($i = 0; $i < count($curBans); $i++) {
        if ($type == 0 && $curBans[$i]['type'] == 1 && !$inserted) {
            $newBans[] = array("type" => $type, "identifier" => $id, "time" => $time, "reason" => $reason);
            $inserted = true;
        }
        $newBans[] = $curBans[$i];
    }
    
    if ($type == 1) // Add IP Ban
        $newBans[] = array("type" => $type, "identifier" => $id, "time" => $time, "reason" => $reason);
    
    $output = "";

    foreach ($newBans as $nb)
        $output .= sprintf("%s %s %s\n", $nb['identifier'], $nb['time'], str_replace("\n","",$nb['reason']));
    
    // Write to disk
    file_put_contents(BANS_PATH, $output, LOCK_EX);
}

function removeBan($id) {
    $curBans = readBans();
    $newBans = array();
    
    for ($i = 0; $i < count($curBans); $i++) {
        if ($curBans[$i]['identifier'] != $id)
            $newBans[] = $curBans[$i];
    }
    
    $output = "";
    foreach ($newBans as $nb)
        $output .= sprintf("%s %s %s\n", $nb['identifier'], $nb['time'], str_replace("\n","",$nb['reason']));
    
    // Write to disk
    file_put_contents(BANS_PATH, $output, LOCK_EX);
}

?>