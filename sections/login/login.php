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
    if (!isset($_REQUEST['username']) || !isset($_REQUEST['password']))
        die("Error: Missing Values");
    
    $username = sanitize_sql_string($_REQUEST['username']);
    $password = sanitize_sql_string($_REQUEST['password']);
    $user = new PanelUser();
    $user->setUsername($username);

    if ($user->login($password)) {
        //Set Cookie
        $exp = time() + COOKIE_EXPIRATION;
        $cookie = $user->generateCookie($exp);
        if (!setcookie(COOKIE_AUTH, $cookie, $exp, COOKIE_PATH, COOKIE_DOMAIN, false, true))
            die("Error: Could not set cookie");
        redirect("index.php");
    } else
        redirect("index.php?page=login&action=login&err=1");
} else {
    $error = (isset($_REQUEST['err'])) ? sanitize_int($_REQUEST['err']) : 0;
    $smarty->assign('error', $error);
    $smarty->display('login/login.tpl');
    $smarty->clearAllAssign();
}
?>