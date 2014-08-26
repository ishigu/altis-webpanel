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
$pagesize = 50; // TODO: Make it dynamic
$start = $pagenum*$pagesize;

// Generate Pagination
$pg = new bootPagination();
$pg->pagenumber = $pagenum;
$pg->pagesize = $pagesize;
$pg->totalrecords = Player::getPlayerDBCount();
$pg->showfirst = true;
$pg->showlast = true;
$pg->paginationcss = "pagination-large";
$pg->paginationstyle = 1; // 1: advance, 0: normal
$pg->defaultUrl = "index.php?page=players&action=index";
$pg->paginationUrl = "index.php?page=players&action=index&pagenum=[p]";

// Get Players
$playerList = Player::getPlayers("uid", "DESC", $start, $pagesize);
//var_dump($playerList);

$smarty->assign('players', $playerList);
$smarty->assign('pagination', $pg->process());
$smarty->display('players/overview.tpl');
$smarty->clearAllAssign();
?>