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
define('SMARTY_DIR', str_replace("\\","/",getcwd()).'/libs/Smarty/');
$db = new PDO('mysql:dbname=arma3life;host=127.0.0.1', "arma", "password");

$theme = "binary";
$title = "Westerland Altis Life Panel";

?>