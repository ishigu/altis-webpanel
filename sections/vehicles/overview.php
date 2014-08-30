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

$pagesize = isset($_REQUEST['pagesize']) ? sanitize_int($_REQUEST['pagesize']) : 50;
$start = ($pagenum - 1)*$pagesize;

// Search
$searchstr = isset($_REQUEST['search']) ? sanitize_sql_string(urldecode($_REQUEST['search'])) : "";
$sortby = isset($_REQUEST['sortby']) ? sanitize_sql_string(urldecode($_REQUEST['sortby'])) : "";
if (!in_array($sortby, array("id", "side", "classname", "type", "pid", "alive", "active", "plate", "color", "impound")))
    $sortby = "id";
$order = isset($_REQUEST['order']) ? sanitize_sql_string(urldecode($_REQUEST['order'])) : "";
if ($order != "ASC")
    $order = "DESC";
$count = -1;
$searchparam = "";
$smarty->assign('search', 0);
if (!empty($searchstr)) {
    $vehicleList = Vehicle::searchVehicle($searchstr, $sortby, $order, $start, $pagesize, $count);
    $searchparam = "&amp;search=".urlencode($searchstr);
    $smarty->assign('searchstring', $searchstr);
    $smarty->assign('search', 1);
}

// Generate Pagination
$pg = new bootPagination();
$pg->pagenumber = $pagenum;
$pg->pagesize = $pagesize;
$pg->totalrecords = $count != -1 ? $count : Vehicle::getVehicleDBCount();
$pg->showfirst = true;
$pg->showlast = true;
$pg->paginationcss = "pagination-large";
$pg->paginationstyle = 1; // 1: advance, 0: normal
$pg->defaultUrl = "index.php?page=vehicles&amp;action=index&amp;sortby=".$sortby."&amp;order=".$order.$searchparam;
$pg->paginationUrl = "index.php?page=vehicles&amp;action=index&amp;sortby=".$sortby."&amp;order=".$order."&amp;pagenum=[p]".$searchparam;

// Get Vehicles (if not a search request)
if (empty($searchparam)) {
    $vehicleList = Vehicle::getVehicles($sortby, $order, $start, $pagesize);
}

$smarty->assign('vehicles', $vehicleList);
$smarty->assign('pagination', $pg->process());
$smarty->assign('sortby', $sortby);
$smarty->assign('order', $order);
$smarty->display('vehicles/overview.tpl');
$smarty->clearAllAssign();
?>