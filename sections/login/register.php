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
require_once("include/classes/PanelUser.php");
/* @var $smarty Smarty */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_REQUEST['username']) || !isset($_REQUEST['password']) || !isset($_REQUEST['playerid']))
        die("Error: Missing Values");
    
    $username = sanitize_sql_string($_REQUEST['username']);
    $password = sanitize_sql_string($_REQUEST['password']);
    $playerid = sanitize_sql_string($_REQUEST['playerid']);
    
    if (PanelUser::getUserByUsername($username) != null) // Username already exists
        redirect("index.php?page=login&action=register&err=1");
    
    $user = new PanelUser();
    $user->setUsername($username);
    $user->setPassword($password);
    $user->setPlayerID($playerid);
    $user->saveToDB();
    
    redirect("index.php?page=login&action=login");
} else {
    $error = (isset($_REQUEST['err'])) ? sanitize_int($_REQUEST['err']) : 0;
    $smarty->assign('error', $error);
    $smarty->display('login/register.tpl');
    $smarty->clearAllAssign();
}
?>