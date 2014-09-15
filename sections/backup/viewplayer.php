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
error_reporting(E_ALL);
require_once("libs/PHPSQLParser/PHPSQLParser.php");
require_once("include/classes/Player.php");
/* @var $smarty Smarty */

$pid = isset($_REQUEST['pid']) ? sanitize_paranoid_string($_REQUEST['pid']) : 0;
if (empty($pid)) $pid = "nopidselected";

$file = str_replace(array("T","S"),array("_"," "), sanitize_paranoid_string(str_replace(array("_"," "),array("T","S"), $_REQUEST['time'])));
if (empty($file)) $file = "";

if (file_exists(SQL_PATH.'/'.$file.'.sql')) {
    $data = file_get_contents(SQL_PATH.'/'.$file.'.sql');
    $data = explode("\n", $data);
    $res = "";
    
    foreach ($data as $line) {
        if (!stristr($line, "INSERT INTO `players` VALUES")) continue;
        if (!stristr($line, $pid)) continue;
        $linedata = explode("(", $line);
        $res = "";
        foreach ($linedata as $ld) {
            if (!stristr($ld, $pid)) continue;
            $res = $ld;
        }
        $res = $linedata[0]."(".substr($res, 0, -1);
    }
    if (!empty($res)) {
        $parser = new PHPSQLParser\PHPSQLParser();
        $parsed = $parser->parse($res);
        $parsed = $parsed['VALUES'][0];
        //print_r($parsed);
        
        $data = array();
        for ($i = 0; $i < count($parsed['data']); $i++) {
            switch ($i) {
                case 0: $data['uid'] = trim($parsed['data'][$i]['base_expr'], "\"'\\"); break;
                case 1: $data['name'] = trim($parsed['data'][$i]['base_expr'], "\"'\\"); break;
                case 2: $data['playerid'] = trim($parsed['data'][$i]['base_expr'], "\"'\\"); break;
                case 3: $data['cash'] = trim($parsed['data'][$i]['base_expr'], "\"'\\"); break;
                case 4: $data['bankacc'] = trim($parsed['data'][$i]['base_expr'], "\"'\\"); break;
                case 5: $data['coplevel'] = trim($parsed['data'][$i]['base_expr'], "\"'\\"); break;
                case 6: $data['cop_licenses'] = trim($parsed['data'][$i]['base_expr'], "\"'\\"); break;
                case 7: $data['civ_licenses'] = trim($parsed['data'][$i]['base_expr'], "\"'\\"); break;
                case 8: $data['med_licenses'] = trim($parsed['data'][$i]['base_expr'], "\"'\\"); break;
                case 9: $data['cop_gear'] = trim($parsed['data'][$i]['base_expr'], "\"'\\"); break;
                case 10: $data['mediclevel'] = trim($parsed['data'][$i]['base_expr'], "\"'\\"); break;
                case 11: $data['arrested'] = trim($parsed['data'][$i]['base_expr'], "\"'\\"); break;
                case 12: $data['aliases'] = trim($parsed['data'][$i]['base_expr'], "\"'\\"); break;
                case 13: $data['adminlevel'] = trim($parsed['data'][$i]['base_expr'], "\"'\\"); break;
                case 14: $data['donatorlvl'] = trim($parsed['data'][$i]['base_expr'], "\"'\\"); break;
                case 15: $data['civ_gear'] = trim($parsed['data'][$i]['base_expr'], "\"'\\"); break;
                case 16: $data['blacklist'] = trim($parsed['data'][$i]['base_expr'], "\"'\\"); break;
                case 17: $data['reb_gear'] = trim($parsed['data'][$i]['base_expr'], "\"'\\"); break;
                case 18: $data['rebellevel'] = trim($parsed['data'][$i]['base_expr'], "\"'\\"); break;
            }
        }
        foreach ($data as $row => $val) {
            $data[$row] = utf8_decode($val);
        }
        $plr = new Player();
        $plr->fill($data);
        $smarty->assign('player', $plr);
        $smarty->assign('time', $file);
        $smarty->display('backup/viewplayer.tpl');
        $smarty->clearAllAssign();
    }
}
else {
    
}
?>