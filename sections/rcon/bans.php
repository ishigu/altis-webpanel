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
require_once("include/bans.php");
/* @var $smarty Smarty */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_REQUEST['act']) && $_REQUEST['act'] == "add") {
    if (!isset($_REQUEST['id']) || !isset($_REQUEST['time']) || !isset($_REQUEST['reason']))
        die("Missing Variables");  

    $time = sanitize_int($_REQUEST['time']);
    
    if (preg_match('/^[a-f0-9]{32}$/', $_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        $type = 0;
    } elseif (preg_match('/^(?:(?:25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9][0-9]|[0-9])\.){3}(?:25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9][0-9]?|[0-9])$/', $_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        $type = 1;
    }
    $reason = str_replace("\n", "", $_REQUEST['reason']);
    
    if ($time == 0)
        $time = -1;
    else
        $time = time() + 3600*$time;

    if (isset($id) && !empty($id) && !empty($time) && !empty($reason)) {
        addBan ($type, $id, $time, $reason);
        ob_end_clean();
        header('Location: index.php?page=rcon&action=bans');
    }
    else
        die("Error: Missing/invalid variables");
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_REQUEST['act']) && $_REQUEST['act'] == "del") {
    if (!isset($_REQUEST['id']))
        die("Missing Variables");
    
    if (preg_match('/^[a-f0-9]{32}$/', $_REQUEST['id']) || preg_match('/^(?:(?:25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9][0-9]|[0-9])\.){3}(?:25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9][0-9]?|[0-9])$/', $_REQUEST['id'])) {
        removeBan($_REQUEST['id']);
        ob_end_clean();
        header('Location: index.php?page=rcon&action=bans');
    }
}
else {
    $banList = readBans();

    $smarty->assign('bans', $banList);
    $smarty->display('rcon/banlist.tpl');
    $smarty->clearAllAssign();
}
?>