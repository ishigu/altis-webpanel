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

function getUpdateLogDBCount() {
    global $db;
    /* @var $db PDO */

    $count = $db->query('SELECT COUNT(*) FROM view_players_log')->fetchColumn();
    if (!isset($count))
        return 0;
    else
        return $count;
}

function getUpdateLogEntries($sortby = "updatetime", $order = "DESC", $start = 0, $count = 100) {
    global $db;
    /* @var $db PDO */
    if ($order != "DESC") $order = "ASC";
    $sortby = sanitize_sql_string($sortby);
    $stmt = $db->prepare('SELECT `uid`, `name`, `aliases`, `playerid`, `updatetime`, `cashdiff`, `bankdiff`, `moneydiff` FROM view_players_log ORDER BY ' . $sortby . ' ' . $order . ' LIMIT :start, :count');
    $stmt->bindValue(':start', $start, PDO::PARAM_INT);
    $stmt->bindValue(':count', $count, PDO::PARAM_INT);
    $stmt->execute();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    for ($i = 0; $i < count($rows); $i++) {
        $parsed = parseBISArray($rows[$i]['aliases']);
        $rows[$i]['aliases'] = str_replace(chr(96), "", implode(", ", $parsed));
    }
    return $rows;
}

function searchUpdateLog($str, $sortby = "updatetime", $order = "DESC", $start = 0, $count = 100, &$total = NULL) {
    global $db;
    /* @var $db PDO */
    if ($order != "DESC") $order = "ASC";
    $sortby = sanitize_sql_string($sortby);

    // Is $str an uid?
    $str_n = sanitize_int($str);
    // Is $str a name/in aliases/a playerid?
    $str_s = sanitize_sql_string($str);

    //Empty search?
    if (empty($str_s) && empty($str_n))
        return array(); // Return empty array
    
    $stmt = $db->prepare('SELECT COUNT(*) FROM view_players_log WHERE `name` LIKE :name OR `aliases` LIKE :aliases OR `uid` = :uid OR `playerid` LIKE :playerid');
    $stmt->bindValue(':name', "%".$str_s."%", PDO::PARAM_STR);
    $stmt->bindValue(':aliases', "%".$str_s."%", PDO::PARAM_STR);
    $stmt->bindValue(':uid', $str_n, PDO::PARAM_INT);
    $stmt->bindValue(':playerid', $str_s, PDO::PARAM_STR); // playerid is VARCHAR
    $stmt->execute();
    $total = $stmt->fetchColumn();

    $stmt = $db->prepare('SELECT `uid`, `name`, `aliases`, `playerid`, `updatetime`, `cashdiff`, `bankdiff`, `moneydiff` FROM view_players_log WHERE `name` LIKE :name OR `aliases` LIKE :aliases OR `uid` = :uid OR `playerid` LIKE :playerid ORDER BY ' . $sortby . ' ' . $order . ' LIMIT :start , :count');
    $stmt->bindValue(':name', "%".$str_s."%", PDO::PARAM_STR);
    $stmt->bindValue(':aliases', "%".$str_s."%", PDO::PARAM_STR);
    $stmt->bindValue(':uid', $str_n, PDO::PARAM_INT);
    $stmt->bindValue(':playerid', $str_s, PDO::PARAM_STR); // playerid is VARCHAR
    $stmt->bindValue(':start', $start, PDO::PARAM_INT);
    $stmt->bindValue(':count', $count, PDO::PARAM_INT);
    $stmt->execute();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function getLastSyncLogDBCount() {
    global $db;
    /* @var $db PDO */

    $count = $db->query('SELECT COUNT(*) FROM view_players_update')->fetchColumn();
    if (!isset($count))
        return 0;
    else
        return $count;
}

function getLastSyncLogEntries($sortby = "last_update", $order = "DESC", $start = 0, $count = 100) {
    global $db;
    /* @var $db PDO */
    if ($order != "DESC") $order = "ASC";
    $sortby = sanitize_sql_string($sortby);
    $stmt = $db->prepare('SELECT `uid`, `name`, `aliases`, `playerid`, `last_update` FROM view_players_update ORDER BY ' . $sortby . ' ' . $order . ' LIMIT :start, :count');
    $stmt->bindValue(':start', $start, PDO::PARAM_INT);
    $stmt->bindValue(':count', $count, PDO::PARAM_INT);
    $stmt->execute();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    for ($i = 0; $i < count($rows); $i++) {
        $parsed = parseBISArray($rows[$i]['aliases']);
        $rows[$i]['aliases'] = str_replace(chr(96), "", implode(", ", $parsed));
    }
    return $rows;
}

function searchLastSyncLog($str, $sortby = "last_update", $order = "DESC", $start = 0, $count = 100, &$total = NULL) {
    global $db;
    /* @var $db PDO */
    if ($order != "DESC") $order = "ASC";
    $sortby = sanitize_sql_string($sortby);

    // Is $str an uid?
    $str_n = sanitize_int($str);
    // Is $str a name/in aliases/a playerid?
    $str_s = sanitize_sql_string($str);

    //Empty search?
    if (empty($str_s) && empty($str_n))
        return array(); // Return empty array

    $stmt = $db->prepare('SELECT COUNT(*) FROM view_players_update WHERE `name` LIKE :name OR `aliases` LIKE :aliases OR `uid` = :uid OR `playerid` LIKE :playerid');
    $stmt->bindValue(':name', "%".$str_s."%", PDO::PARAM_STR);
    $stmt->bindValue(':aliases', "%".$str_s."%", PDO::PARAM_STR);
    $stmt->bindValue(':uid', $str_n, PDO::PARAM_INT);
    $stmt->bindValue(':playerid', $str_s, PDO::PARAM_STR); // playerid is VARCHAR
    $stmt->execute();
    $total = $stmt->fetchColumn();

    $stmt = $db->prepare('SELECT `uid`, `name`, `aliases`, `playerid`, `last_update` FROM view_players_update WHERE `name` LIKE :name OR `aliases` LIKE :aliases OR `uid` = :uid OR `playerid` LIKE :playerid ORDER BY ' . $sortby . ' ' . $order . ' LIMIT :start , :count');
    $stmt->bindValue(':name', "%".$str_s."%", PDO::PARAM_STR);
    $stmt->bindValue(':aliases', "%".$str_s."%", PDO::PARAM_STR);
    $stmt->bindValue(':uid', $str_n, PDO::PARAM_INT);
    $stmt->bindValue(':playerid', $str_s, PDO::PARAM_STR); // playerid is VARCHAR
    $stmt->bindValue(':start', $start, PDO::PARAM_INT);
    $stmt->bindValue(':count', $count, PDO::PARAM_INT);
    $stmt->execute();

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

?>