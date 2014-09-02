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
require_once("include/classes/Player.php");

class House {
    private $id;
    private $pid;
    private $pos;
    private $inventory;
    private $containers;
    private $owned;
    private $isInDB;
    public static $fields = '`id`, `pid`, `pos`, `inventory`, `containers`, `owned`';
    
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
    public function isInDB() { return $this->isInDB; }
    
    public function __construct() {
        $this->id = 0;
        $this->pid = "0";
        $this->pos = "";
        $this->inventory = "";
        $this->containers = "";
        $this->owned = 0;
        $this->isInDB = false;
    }
    
    public function fill($data, $DB = false) {
        foreach ($data as $field => $value) {
            switch ($field) {
                case 'id': $this->id = $value; break;
                case 'pid': $this->pid = $value; break;
                case 'pos': $this->pos = $value; break;
                case 'inventory': $this->inventory = $value; break;
                case 'containers': $this->containers = $value; break;
                case 'owned': $this->owned = $value; break;
            }
        }
        if ($DB)
            $this->isInDB = true;
    }
    
    public function toArray() {
        return get_object_vars($this);
    }
    
    public static function searchHouse($str, $sortby = "id", $order = "DESC", $start = 0, $count = 100, &$total = NULL) {
        global $db;
        /* @var $db PDO */
        if ($order != "DESC") $order = "ASC";
        $sortby = sanitize_paranoid_string($sortby);
        
        // Is $str an id?
        $str_n = sanitize_int($str);
        // Is $str a pid/inventory item/container item?
        $str_s = sanitize_sql_string($str);

        //Empty search?
        if (empty($str_s) && empty($str_n))
            return array(); // Return empty array
        
        $stmt = $db->prepare('SELECT COUNT(*) FROM houses WHERE `id` = :id OR `pid` LIKE :pid OR `inventory` LIKE :inventory OR `containers` LIKE :containers');
        $stmt->bindValue(':id', $str_n, PDO::PARAM_INT);
        $stmt->bindValue(':pid', $str_s, PDO::PARAM_STR); // owner is VARCHAR
        $stmt->bindValue(':inventory', "%".$str_s."%", PDO::PARAM_STR);
        $stmt->bindValue(':containers', "%".$str_s."%", PDO::PARAM_STR);
        $stmt->execute();
        $total = $stmt->fetchColumn();

        $stmt = $db->prepare('SELECT '.House::$fields.' FROM houses WHERE `id` = :id OR `pid` LIKE :pid OR `inventory` LIKE :inventory OR `containers` LIKE :containers ORDER BY ' . $sortby . ' ' . $order . ' LIMIT :start , :count');
        $stmt->bindValue(':id', $str_n, PDO::PARAM_INT);
        $stmt->bindValue(':pid', $str_s, PDO::PARAM_STR); // owner is VARCHAR
        $stmt->bindValue(':inventory', "%".$str_s."%", PDO::PARAM_STR);
        $stmt->bindValue(':containers', "%".$str_s."%", PDO::PARAM_STR);
        $stmt->bindValue(':start', $start, PDO::PARAM_INT);
        $stmt->bindValue(':count', $count, PDO::PARAM_INT);
        $stmt->execute();

        $result = array();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $hs = new House();
            $hs->fill($row, true);
            
            $result[] = $hs;
        }
        
        return $result;
    }
    
    public static function getHouseDBCount() {
        global $db;
        /* @var $db PDO */
        
        $count = $db->query('SELECT COUNT(*) FROM houses')->fetchColumn();
        if (!isset($count))
            return 0;
        else
            return $count;
    }
    
    public static function getHouses($sortby = "id", $order = "DESC", $start = 0, $count = 100) {
        global $db;
        /* @var $db PDO */
        if ($order != "DESC") $order = "ASC";
        $sortby = sanitize_paranoid_string($sortby);
        $stmt = $db->prepare('SELECT '.House::$fields.' FROM houses ORDER BY ' . $sortby . ' ' . $order . ' LIMIT :start, :count');
        $stmt->bindValue(':start', $start, PDO::PARAM_INT);
        $stmt->bindValue(':count', $count, PDO::PARAM_INT);
        $stmt->execute();
        
        $result = array();
        
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $hs = new House();
            $hs->fill($row, true);
            
            $result[] = $hs;
        }
        
        return $result;
    }
    
    public function getOwnerName() {
        $plr = Player::getPlayerByPlayerID($this->pid);
        if (!isset($plr))
            return "";
        return $plr->getName();
    }
    
    public function getInventoryList() {
        $list = parseBISArray($this->inventory);
        
        if (count($list) == 0 || $list[count($list)-1] == 0 || count($list[0]) == 0)
            return "-";
        
        $result = array();
        for ($i = 0; $i < count($list)-1; $i += 2) {
            if (!is_array($list[$i])) {
                $str = trim($list[$i], chr(96)."[]");
                $count = trim($list[$i+1], chr(96)."[]");
                $result[] = sprintf("%s[%d]", $str, $count);
            }
        }
        
        return implode(", ", $result);
    }
    public function getContainersList() {
        if ($this->containers == "\"[]\"")
            return "-";
        
        $list = parseBISArray($this->containers);
        
        $result = array();
        for ($i = 0; $i < count($list); $i++) {
            if (!is_array($list[$i])) {
                $str = trim($list[$i], chr(96)."[]");
                $result[] = sprintf("%s", $str);
            } else {
                foreach ($list[$i] as $l) {
                    $str = trim($l, chr(96)."[]");
                    if (!empty($str)) {
                        $result[] = sprintf("%s", $str);
                    }
                }
            }
        }
        
        //return str_replace(chr(96), "", implode(", ", $list));
        return implode(", ", $result);
    }
    
    public static function getHouseById($id) {
        global $db;
        /* @var $db PDO */
        
        $id = sanitize_int($id);
        $stmt = $db->prepare('SELECT '.House::$fields.' FROM houses WHERE `id` = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $house = new House();
        $house->fill($result[0], true);
        
        return $house;
    }
    
    public function updateAndSave($fields) {
        $this->fill($fields);
        return $this->saveToDB();
    }
    
    private function saveToDB() {
        global $db;
        /* @var $db PDO */
        
        if ($this->isInDB()) { // UPDATE
            $stmt = $db->prepare("UPDATE houses SET `pid` = :pid, `pos` = :pos, `inventory` = :inventory, `containers` = :containers, `owned` = :owned WHERE `id` = :id");
        } else { // INSERT
            $stmt = $db->prepare("INSERT INTO houses (".House::$fields.") VALUES (:id, :pid, :pos, :inventory, :containers, :owned)");
        }
        $stmt->bindValue(':id', $this->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':pid', $this->getPid(), PDO::PARAM_STR);
        $stmt->bindValue(':pos', $this->getPos(), PDO::PARAM_STR);
        $stmt->bindValue(':inventory', $this->getInventory(), PDO::PARAM_STR);
        $stmt->bindValue(':containers', $this->getContainers(), PDO::PARAM_STR);
        $stmt->bindValue(':owned', $this->getOwned(), PDO::PARAM_INT);
        $count = $stmt->execute();
        
        if ($count > 0)
            $this->isInDB = true;
        
        return $count;
    }
}

?>