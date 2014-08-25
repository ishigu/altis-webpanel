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

class House {
    private $id;
    private $pid;
    private $pos;
    private $inventory;
    private $containers;
    private $owned;
    
    public function getId() { return $this->id; }
    public function setId($d) { $this->id = $d; }
    public function getPid() { return $this->pid; }
    public function setPid($d) { $this->pid = $d; }
    public function getPos() { return $this->pos; }
    public function setPos($d) { $this->pos = $d; }
    public function getInventory() { return $this->inventory; }
    public function setInventory($d) { $this->inventory = $d; }
    public function getContainers() { return $this->containers; }
    public function setContainers($d) { $this->containers = $d; }
    public function getOwned() { return $this->owned; }
    public function setOwned($d) { $this->owned = $d; }
    
    public function __construct() {
        $this->id = 0;
        $this->pid = "0";
        $this->pos = "";
        $this->inventory = "";
        $this->containers = "";
        $this->owned = 0;
    }
}

?>