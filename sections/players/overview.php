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

/* @var $smarty Smarty */
/* @var $pg bootPagination */

// Pagination Variables
$pagenum = isset($_REQUEST['pagenum']) ? sanitize_int($_REQUEST['pagenum']) : 1;
if ($pagenum < 0) $pagenum = 0;

$pagesize = 50; // TODO: Make it dynamic
$start = ($pagenum - 1)*$pagesize;

// Search
$searchstr = isset($_REQUEST['search']) ? sanitize_sql_string(urldecode($_REQUEST['search'])) : "";
$sortby = isset($_REQUEST['sortby']) ? sanitize_sql_string(urldecode($_REQUEST['sortby'])) : "";
if (!in_array($sortby, array("uid", "playerid", "name", "cash", "bankacc", "donatorlvl", "coplevel", "mediclevel", "rebellevel","adminlevel")))
    $sortby = "uid";
$order = isset($_REQUEST['order']) ? sanitize_sql_string(urldecode($_REQUEST['order'])) : "";
if ($order != "ASC")
    $order = "DESC";
$count = 0;
$searchparam = "";
$smarty->assign('search', 0);
if (!empty($searchstr)) {
    $playerList = Player::searchPlayer($searchstr, $sortby, $order, $start, $pagesize);
    $count = count($playerList);
    $searchparam = "&amp;search=".urlencode($searchstr);
    $smarty->assign('searchstring', $searchstr);
    $smarty->assign('search', 1);
}

// Generate Pagination
$pg = new bootPagination();
$pg->pagenumber = $pagenum;
$pg->pagesize = $pagesize;
$pg->totalrecords = $count > 0 ? $count : Player::getPlayerDBCount();
$pg->showfirst = true;
$pg->showlast = true;
$pg->paginationcss = "pagination-large";
$pg->paginationstyle = 1; // 1: advance, 0: normal
$pg->defaultUrl = "index.php?page=players&amp;action=index".$searchparam;
$pg->paginationUrl = "index.php?page=players&amp;action=index&amp;pagenum=[p]".$searchparam;

// Get Players (if not a search request)
if (empty($searchparam)) {
    $playerList = Player::getPlayers($sortby, $order, $start, $pagesize);
    //var_dump($playerList);
}

$smarty->assign('players', $playerList);
$smarty->assign('pagination', $pg->process());
$smarty->assign('sortby', $sortby);
$smarty->assign('order', $order);
$smarty->display('players/overview.tpl');
$smarty->clearAllAssign();
?>