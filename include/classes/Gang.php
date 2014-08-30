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

class Gang {
    private $id;
    private $owner;
    private $name;
    private $members;
    private $maxmembers;
    private $bank;
    private $active;
    public static $fields = '`id`, `owner`, `name`, `members`, `maxmembers`, `bank`, `active`';

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
    
    public function fill($data) {
        foreach ($data as $field => $value) {
            switch ($field) {
                case 'id': $this->id = $value; break;
                case 'owner': $this->owner = $value; break;
                case 'name': $this->name = $value; break;
                case 'members': $this->members = $value; break;
                case 'maxmembers': $this->maxmembers = $value; break;
                case 'bank': $this->bank = $value; break;
                case 'active': $this->active = $value; break;
            }
        }
    }
    
    public function toArray() {
        return get_object_vars($this);
    }
    
    public static function searchGang($str, $sortby = "id", $order = "DESC", $start = 0, $count = 100, &$total = NULL) {
        global $db;
        /* @var $db PDO */
        if ($order != "DESC") $order = "ASC";
        $sortby = sanitize_paranoid_string($sortby);
        
        // Is $str an id?
        $str_n = sanitize_int($str);
        // Is $str a name/owner/member?
        $str_s = sanitize_sql_string($str);

        //Empty search?
        if (empty($str_s) && empty($str_n))
            return array(); // Return empty array
        
        $stmt = $db->prepare('SELECT COUNT(*) FROM gangs WHERE `id` = :id OR `owner` LIKE :owner OR `name` LIKE :name OR `members` LIKE :members');
        $stmt->bindValue(':id', $str_n, PDO::PARAM_INT);
        $stmt->bindValue(':owner', $str_s, PDO::PARAM_STR); // owner is VARCHAR
        $stmt->bindValue(':name', "%".$str_s."%", PDO::PARAM_STR);
        $stmt->bindValue(':members', "%".$str_s."%", PDO::PARAM_STR);        
        $stmt->execute();
        $total = $stmt->fetchColumn();

        $stmt = $db->prepare('SELECT '.Gang::$fields.' FROM gangs WHERE `id` = :id OR `owner` LIKE :owner OR `name` LIKE :name OR `members` LIKE :members ORDER BY ' . $sortby . ' ' . $order . ' LIMIT :start , :count');
        $stmt->bindValue(':id', $str_n, PDO::PARAM_INT);
        $stmt->bindValue(':owner', $str_s, PDO::PARAM_STR); // owner is VARCHAR
        $stmt->bindValue(':name', "%".$str_s."%", PDO::PARAM_STR);
        $stmt->bindValue(':members', "%".$str_s."%", PDO::PARAM_STR);
        $stmt->bindValue(':start', $start, PDO::PARAM_INT);
        $stmt->bindValue(':count', $count, PDO::PARAM_INT);
        $stmt->execute();

        $result = array();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $gang = new Gang();
            $gang->fill($row);
            
            $result[] = $gang;
        }
        
        return $result;
    }
    
    public static function getGangDBCount() {
        global $db;
        /* @var $db PDO */
        
        $count = $db->query('SELECT COUNT(*) FROM gangs')->fetchColumn();
        if (!isset($count))
            return 0;
        else
            return $count;
    }
    
    public static function getGangs($sortby = "id", $order = "DESC", $start = 0, $count = 100) {
        global $db;
        /* @var $db PDO */
        if ($order != "DESC") $order = "ASC";
        $sortby = sanitize_paranoid_string($sortby);
        $stmt = $db->prepare('SELECT '.Gang::$fields.' FROM gangs ORDER BY ' . $sortby . ' ' . $order . ' LIMIT :start, :count');
        $stmt->bindValue(':start', $start, PDO::PARAM_INT);
        $stmt->bindValue(':count', $count, PDO::PARAM_INT);
        $stmt->execute();
        
        $result = array();
        
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $gang = new Gang();
            $gang->fill($row);
            
            $result[] = $gang;
        }
        
        return $result;
    }
    
    public function getOwnerName() {
        $plr = Player::getPlayerByPlayerID($this->owner);
        if (!isset($plr))
            return "";
        return $plr->getName();
    }
    
    public function getMembersList() {
        $list = parseBISArray($this->members);
        return str_replace(chr(96), "", implode(", ", $list));
    }
    
    public function getMembersListNames() {
        $mbrs = str_replace(", ", ",", $this->getMembersList());
        $mbrs = Player::getPlayersByPlayerID($mbrs);
        //print_r($mbrs);
        $names = array();
        foreach ($mbrs as $plr) {
            $names[] = $plr->getName();
        }
        
        return implode(", ", $names);
    }
}

?>