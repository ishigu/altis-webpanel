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
function parseBISArray($str) {
    $str = substr($str, 1, -1); // Strip trailing quotes
    $bla = parseBISArray_helper($str);
    $result = array();

    foreach ($bla as $row) {
        foreach ($row as $child) {
            $result[] = $child;
        }
        if (count($row) == 0)
            $result[] = array();
    }
    //var_dump($result);
    return $result;
}

function parseBISArray_helper($str) {
    $result = array();

    $str = str_replace(array(chr(96).",".chr(96), "\""), array(chr(96)."\n".chr(96), ""), $str);

    if ($str[0] == "[" && $str[strlen($str)-1] == "]")
        $str = substr($str, 1, -1);
    
    $result = explode(",", $str);
    for ($i = 0; $i < count($result); $i++) {
        $row = $result[$i];
        if (is_array($row)) continue;
        if ($row == "[]") {
            $result[$i] = array();
            continue;
        }
        elseif ($row[0] == "[" && $row[strlen($row)-1] == "]")
            $result[$i] = parseBISArray_helper($row); // It's an array, parse it
        else
            $result[$i] = explode("\n", $row);
    }
    return $result;
}

function compileBISArray($array) {
    $output = "\"[";
    compileBISArray_helper($array, $output);
    $output .= "]\"";
    return $output;
    
    
}

function compileBISArray_helper($array, &$output) {
    for ($i = 0; $i < count($array); $i++) {
        if (is_array($array[$i]) && count($array[$i]) > 0) {
            $output .= "[";
            compileBISArray_helper($array[$i], $output);
            $output .= "]";
        }
        elseif (is_array($array[$i]) && count($array[$i]) == 0) {
            $output .= "[]";
        }
        else {
            $output .= $array[$i];
        }
        $output .= (($i < count($array)-1) ? "," : "");
    }
}

function simpleCommaSepListToBISArray($str) {
    $data = explode(",", str_replace(", ", ",", $str));
    $temp = array();
    foreach ($data as $val) {
        $temp[] = sprintf("%s%s%s", chr(96), $val, chr(96));
    }
    
    return compileBISArray($temp);
}

function throwAJAXError($str) {
    $data = array('type' => 'error', 'message' => $str);
    header('HTTP/1.1 400 Bad Request');
    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode($data));
}

function redirect($url) {
    header("Location: ".$url);
    die();
}
?>