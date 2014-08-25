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

class Vehicle {
    private $id;
    private $side;
    private $classname;
    private $type;
    private $pid;
    private $alive;
    private $active;
    private $plate;
    private $color;
    private $inventory;
    private $impound;
    
    public function getId() { return $this->id; }
    public function setId($d) { $this->id = $d; }
    public function getSide() { return $this->side; }
    public function setSide($d) { $this->side = $d; }
    public function getClassname() { return $this->classname; }
    public function setClassname($d) { $this->classname = $d; }
    public function getType() { return $this->type; }
    public function setType($d) { $this->type = $d; }
    public function getPid() { return $this->pid; }
    public function setPid($d) { $this->pid = $d; }
    public function getAlive() { return $this->alive; }
    public function setAlive($d) { $this->alive = $d; }
    public function getActive() { return $this->active; }
    public function setActive($d) { $this->active = $d; }
    public function getPlate() { return $this->plate; }
    public function setPlate($d) { $this->plate = $d; }
    public function getColor() { return $this->color; }
    public function setColor($d) { $this->color = $d; }
    public function getInventory() { return $this->inventory; }
    public function setInventory($d) { $this->inventory = $d; }
    public function getImpound() { return $this->impound; }
    public function setImpound($d) { $this->impound = $d; }
    
    public function __construct() {
        $this->id = 0;
        $this->side = "";
        $this->classname = "";
        $this->type = "";
        $this->pid = "0";
        $this->alive = 0;
        $this->active = 1;
        $this->plate = 0;
        $this->color = 0;
        $this->inventory = "";
        $this->impound = 0;
    }
}

?>