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

class Gang {
    private $id;
    private $owner;
    private $name;
    private $members;
    private $maxmembers;
    private $bank;
    private $active;
    
    public function getId() { return $this->id; }
    public function setId($d) { $this->id = $d; }
    public function getOwner() { return $this->owner; }
    public function setOwner($d) { $this->owner = $d; }
    public function getName() { return $this->name; }
    public function setName($d) { $this->name = $d; }
    public function getMembers() { return $this->members; }
    public function setMembers($d) { $this->members = $d; }
    public function getMaxMembers() { return $this->maxmembers; }
    public function setMaxMembers($d) { $this->maxmembers = $d; }
    public function getBank() { return $this->bank; }
    public function setBank($d) { $this->bank = $d; }
    public function getActive() { return $this->active; }
    public function setActive($d) { $this->active = $d; }
    
    public function __construct() {
        $this->id = 0;
        $this->owner = "";
        $this->name = "";
        $this->members = "";
        $this->maxmembers = 3;
        $this->bank = 0;
        $this->active = 1;
    }
}

?>