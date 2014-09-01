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
require("config.inc.php");
require(SMARTY_DIR . "Smarty.class.php");
require("libs/sanitize.lib.php");
require("libs/BootPagination/pagination.php");
require("include/misc.functions.php");

/**
 * Initialize Libraries
 */
$smarty = new Smarty;
$smarty->template_dir = 'templates/' . $theme;
$smarty->compile_dir = 'cache/compiled';
$smarty->cache_dir = 'cache';
$smarty->error_reporting = E_ALL;//  & ~E_NOTICE;
//$smarty->debugging = true;
$smarty->caching = 0;

/**
 * Prepare to show our content
 */
ob_start();
$showTheme = true;
$page = 'index'; //default page
if (isset($_GET['page']))
{
    $file = sanitize_paranoid_string($_GET['page']);
    if (file_exists('sections/'.$file.'/index.php'))
        $page = $file;
}
$username = "ishi"; // TEMP
if ($page == "ajax")
    $showTheme = false;

/**
 * Display header & menu
 */
$smarty->assign('title',$title);
$smarty->assign('theme',$theme);
$smarty->assign('username', $username);
$smarty->assign('page', $page);
if ($showTheme)
    $smarty->display('header.tpl');
$smarty->clearAllAssign();

/**
 * Display content
 */
require('sections/'.$page.'/index.php');

/**
 * Display footer
 */
if ($showTheme)
    $smarty->display('footer.tpl');
$smarty->clearAllAssign();

ob_end_flush();
?>