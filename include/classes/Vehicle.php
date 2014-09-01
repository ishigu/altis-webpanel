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
    private $isInDB;
    public static $fields = '`id`, `side`, `classname`, `type`, `pid`, `alive`, `active`, `plate`, `color`, `inventory`, `impound`';

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
    public function IsInDB() { return $this->isInDB; }
    
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
        $this->isInDB = false;
    }
    
    public function fill($data, $DB = false) {
        foreach ($data as $field => $value) {
            switch ($field) {
                case 'id': $this->id = $value; break;
                case 'side': $this->side = $value; break;
                case 'classname': $this->classname = $value; break;
                case 'type': $this->type = $value; break;
                case 'pid': $this->pid = $value; break;
                case 'alive': $this->alive = $value; break;
                case 'active': $this->active = $value; break;
                case 'plate': $this->plate = $value; break;
                case 'color': $this->color = $value; break;
                case 'inventory': $this->inventory = $value; break;
                case 'impound': $this->impound = $value; break;
            }
        }
        if ($DB)
            $this->isInDB = true;
    }
    
    public function toArray() {
        return get_object_vars($this);
    }
    
    public static function searchVehicle($str, $sortby = "id", $order = "DESC", $start = 0, $count = 100, &$total = NULL) {
        global $db;
        /* @var $db PDO */
        if ($order != "DESC") $order = "ASC";
        $sortby = sanitize_paranoid_string($sortby);
        
        // Is $str an id?
        $str_n = sanitize_int($str);
        // Is $str a classname/side/playerid/type/(class)?
        $str_s = sanitize_sql_string($str);
        
        //Empty search?
        if (empty($str_s) && empty($str_n))
            return array(); // Return empty array
        
        // Search for vehicle classes (names) instead of just classnames
        $classes = Vehicle::searchClassname($str_s);
        $classes = implode(",", $classes);
        
        $stmt = $db->prepare('SELECT COUNT(*) FROM vehicles WHERE `side` LIKE :side OR `classname` LIKE :classname OR FIND_IN_SET( `classname`, :classes ) OR `id` = :id OR `pid` LIKE :pid OR `type` LIKE :type');
        $stmt->bindValue(':side', $str_s, PDO::PARAM_STR);
        $stmt->bindValue(':classname', $str_s, PDO::PARAM_STR);
        $stmt->bindValue(':classes', $classes, PDO::PARAM_STR);
        $stmt->bindValue(':id', $str_n, PDO::PARAM_INT);
        $stmt->bindValue(':pid', $str_s, PDO::PARAM_STR); // pid is VARCHAR
        $stmt->bindValue(':type', $str_s, PDO::PARAM_STR);
        $stmt->execute();
        $total = $stmt->fetchColumn();

        $stmt = $db->prepare('SELECT '.Vehicle::$fields.' FROM vehicles WHERE `side` LIKE :side OR `classname` LIKE :classname OR FIND_IN_SET( `classname`, :classes ) OR `id` = :id OR `pid` LIKE :pid OR `type` LIKE :type ORDER BY ' . $sortby . ' ' . $order . ' LIMIT :start , :count');
        $stmt->bindValue(':side', $str_s, PDO::PARAM_STR);
        $stmt->bindValue(':classname', $str_s, PDO::PARAM_STR);
        $stmt->bindValue(':classes', $classes, PDO::PARAM_STR);
        $stmt->bindValue(':id', $str_n, PDO::PARAM_INT);
        $stmt->bindValue(':pid', $str_s, PDO::PARAM_STR); // pid is VARCHAR
        $stmt->bindValue(':type', $str_s, PDO::PARAM_STR);
        $stmt->bindValue(':start', $start, PDO::PARAM_INT);
        $stmt->bindValue(':count', $count, PDO::PARAM_INT);
        $stmt->execute();

        $result = array();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $veh = new Vehicle();
            $veh->fill($row, true);
            
            $result[] = $veh;
        }
        
        return $result;
    }
    
    public static function getVehicleDBCount() {
        global $db;
        /* @var $db PDO */
        
        $count = $db->query('SELECT COUNT(*) FROM vehicles')->fetchColumn();
        if (!isset($count))
            return 0;
        else
            return $count;
    }
    
    public static function getVehicleById($id) {
        global $db;
        /* @var $db PDO */
        $id = sanitize_int($id);
        $stmt = $db->prepare('SELECT '.Vehicle::$fields.' FROM vehicles WHERE `id` = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) == 0) return null;
        
        $veh = new Vehicle();
        $veh->fill($result[0], true);
        
        return $veh;
    }
    
    public function updateAndSave($fields) {
        $this->fill($fields);
        return $this->saveToDB();
    }
    
    private function saveToDB() {
        global $db;
        /* @var $db PDO */
        if ($this->isInDB()) { // UPDATE
            $stmt = $db->prepare('UPDATE vehicles SET `side` = :side, `classname` = :classname, `type` = :type, `pid` = :pid, `alive` = :alive, `active` = :active, `plate` = :plate, `color` = :color, `inventory` = :inventory, `impound` = :impound WHERE `id` = :id');
        } else { // INSERT
            $stmt = $db->prepare('INSERT INTO vehicles ('.Vehicle::$fields.') VALUES (:id, :side, :classname, :type, :pid, :alive, :active, :plate, :color, :inventory, :impound)');
        }
        $stmt->bindValue(':id', $this->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':side', $this->getSide(), PDO::PARAM_STR);
        $stmt->bindValue(':classname', $this->getClassname(), PDO::PARAM_STR);
        $stmt->bindValue(':type', $this->getType(), PDO::PARAM_STR);
        $stmt->bindValue(':pid', $this->getPid(), PDO::PARAM_STR);
        $stmt->bindValue(':alive', $this->getAlive(), PDO::PARAM_INT);
        $stmt->bindValue(':active', $this->getActive(), PDO::PARAM_INT);
        $stmt->bindValue(':plate', $this->getPlate(), PDO::PARAM_INT);
        $stmt->bindValue(':color', $this->getColor(), PDO::PARAM_INT);
        $stmt->bindValue(':inventory', $this->getInventory(), PDO::PARAM_STR);
        $stmt->bindValue(':impound', $this->getImpound(), PDO::PARAM_INT);
        $count = $stmt->execute();
        
        if ($count > 0)
            $this->isInDB = true;
        
        return $count;
    }
    
    public static function getVehicles($sortby = "id", $order = "DESC", $start = 0, $count = 100) {
        global $db;
        /* @var $db PDO */
        if ($order != "DESC") $order = "ASC";
        $sortby = sanitize_paranoid_string($sortby);
        $stmt = $db->prepare('SELECT '.Vehicle::$fields.' FROM vehicles ORDER BY ' . $sortby . ' ' . $order . ' LIMIT :start, :count');
        $stmt->bindValue(':start', $start, PDO::PARAM_INT);
        $stmt->bindValue(':count', $count, PDO::PARAM_INT);
        $stmt->execute();
        
        $result = array();
        
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $veh = new Vehicle();
            $veh->fill($row, true);
            
            $result[] = $veh;
        }
        
        return $result;
    }
    
    public static function getClassByClassname($str) {
        global $veh_names;
        if (array_key_exists($str,$veh_names))
            return $veh_names[$str];
        return $str; // Failsafe for typos
    }
    
    public static function getClassnameByClass($str) {
        global $veh_names;
        
        $result = array();
        foreach ($veh_names as $classname => $class) {
            if ($class == $str)
                $result[] = $classname;
        }
        
        return $result;
    }
    
    public static function searchClassname($str) {
        global $veh_names;

        if (empty($str))
            return array();
        
        $result = array();
        foreach ($veh_names as $classname => $class) {
            if (stripos($class, $str) !== false) // Found a possible classname
                $result[] = $classname;
        }

        return $result;
    }
    
    public function getClass() {
        return Vehicle::getClassByClassname($this->classname);
    }
}

?>