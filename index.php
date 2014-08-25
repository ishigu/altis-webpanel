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

$theme = "simple";
$title = "Westerland Altis Life Panel";
$site_encoding = "utf-8";

/**
 * Initialize Libraries
 */
$smarty = new Smarty;
$smarty->template_dir = 'templates/' . $theme;
$smarty->compile_dir = 'cache/compiled';
$smarty->cache_dir = 'cache';
$smarty->error_reporting = E_ALL  & ~E_NOTICE;

/**
 * Show our content
 */
ob_start();

/**
 * Display header & menu
 */
$smarty->assign('title',$title);
$smarty->assign('site_encoding',$site_encoding);
$smarty->assign('theme',$theme);
$smarty->display('header.tpl');
$smarty->clearAllAssign();

/**
 * Display content
 *
 * Get page from $_GET and include it
 */
$page = 'index'; //default page
if (isset($_GET['page']))
{
    $file = sanitize_paranoid_string($_GET['page']);
    if (file_exists('sections/'.$file.'/index.php'))
        $page = $file;
}
require('sections/'.$page.'/index.php');

/**
 * Display footer
 */
$smarty->display('footer.tpl');
$smarty->clearAllAssign();

ob_end_flush();
?>