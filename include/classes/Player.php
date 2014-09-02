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

class Player {
    // Database attributes
    private $uid;
    private $name;
    private $playerid;
    private $cash;
    private $bankacc;
    private $coplevel;
    private $cop_licenses;
    private $civ_licenses;
    private $med_licenses;
    private $cop_gear;
    private $mediclevel;
    private $arrested;
    private $aliases;
    private $adminlevel;
    private $donatorlvl;
    private $civ_gear;
    private $blacklist;
    private $reb_gear;
    private $rebellevel;
    private $isInDB;
    public static $fields = '`uid`, `name`, `playerid`, `cash`, `bankacc`, `coplevel`, `cop_licenses`, `civ_licenses`, `med_licenses`, `cop_gear`, `mediclevel`, `arrested`, `aliases`, `adminlevel`, `donatorlvl`, `civ_gear`, `blacklist`, `reb_gear`, `rebellevel`';
    
    public function getUID() { return $this->uid; }
    public function setUID($d) { $this->uid = $d; }
    public function getName() { return $this->name; }
    public function setName($d) { $this->name = $d; }
    public function getPlayerID() { return $this->playerid; }
    public function setPlayerID($d) { $this->playerid = $d; }
    public function getCash() { return $this->cash; }
    public function setCash($d) { $this->cash = $d; }
    public function getBankAcc() { return $this->bankacc; }
    public function setBankAcc($d) { $this->bankacc = $d; }
    public function getCopLevel() { return $this->coplevel; }
    public function setCopLevel($d) { $this->coplevel = $d; }
    public function getCopLicenses() { return $this->cop_licenses; }
    public function setCopLicenses($d) { $this->cop_licenses = $d; }
    public function getCivLicenses() { return $this->civ_licenses; }
    public function setCivLicenses($d) { $this->civ_licenses = $d; }
    public function getMedLicenses() { return $this->med_licenses; }
    public function setMedLicenses($d) { $this->med_licenses = $d; }
    public function getCopGear() { return $this->cop_gear; }
    public function setCopGear($d) { $this->cop_gear = $d; }
    public function getMedicLevel() { return $this->mediclevel; }
    public function setMedicLevel($d) { $this->mediclevel = $d; }
    public function getArrested() { return $this->arrested; }
    public function setArrested($d) { $this->arrested = $d; }
    public function getAliases() { return $this->aliases; }
    public function setAliases($d) { $this->aliases = $d; }
    public function getAdminLevel() { return $this->adminlevel; }
    public function setAdminLevel($d) { $this->adminlevel = $d; }
    public function getDonatorLevel() { return $this->donatorlvl; }
    public function setDonatorLevel($d) { $this->donatorlvl = $d; }
    public function getCivGear() { return $this->civ_gear; }
    public function setCivGear($d) { $this->civ_gear = $d; }
    public function getBlacklist() { return $this->blacklist; }
    public function setBlacklist($d) { $this->blacklist = $d; }
    public function getRebGear() { return $this->reb_gear; }
    public function setRebGear($d) { $this->reb_gear = $d; }
    public function getRebLevel() { return $this->rebellevel; }
    public function setRebLevel($d) { $this->rebellevel = $d; }
    public function isInDB() { return $this->isInDB; }
    
    public function __construct() {
        $this->uid = 0;
        $this->name = "";
        $this->playerid = "0";
        $this->cash = 0;
        $this->bankacc = 0;
        $this->coplevel = "0";
        $this->cop_licenses = "";
        $this->civ_licenses = "";
        $this->med_licenses = "";
        $this->cop_gear = "";
        $this->mediclevel = "0";
        $this->arrested = 0;
        $this->aliases = "";
        $this->adminlevel = "0";
        $this->donatorlvl = "0";
        $this->civ_gear = "";
        $this->blacklist = 0;
        $this->reb_gear = "";
        $this->rebellevel = "0";
        $this->isInDB = false;
    }
    
    public function fill($data, $DB = false) {
        foreach ($data as $field => $value) {
            switch ($field) {
                case 'uid': $this->uid = $value; break;
                case 'name': $this->name = $value; break;
                case 'playerid': $this->playerid = $value; break;
                case 'cash': $this->cash = $value; break;
                case 'bankacc': $this->bankacc = $value; break;
                case 'coplevel': $this->coplevel = $value; break;
                case 'cop_licenses': $this->cop_licenses = $value; break;
                case 'civ_licenses': $this->civ_licenses = $value; break;
                case 'med_licenses': $this->med_licenses = $value; break;
                case 'cop_gear': $this->cop_gear = $value; break;
                case 'mediclevel': $this->mediclevel = $value; break;
                case 'arrested': $this->arrested = $value; break;
                case 'aliases': $this->aliases = $value; break;
                case 'adminlevel': $this->adminlevel = $value; break;
                case 'donatorlvl': $this->donatorlvl = $value; break;
                case 'civ_gear': $this->civ_gear = $value; break;
                case 'blacklist': $this->blacklist = $value; break;
                case 'reb_gear': $this->reb_gear = $value; break;
                case 'rebellevel': $this->rebellevel = $value; break;
            }
        }
        if ($DB)
            $this->isInDB = true;
    }
    
    public function toArray() {
        return get_object_vars($this);
    }
    
    public function parseAliases() {
        $parsed = parseBISArray($this->aliases);
        //print_r($parsed); print "\n\n\n";
        return str_replace(chr(96), "", implode(", ", $parsed));
    }
    
    public static function searchPlayer($str, $sortby = "uid", $order = "DESC", $start = 0, $count = 100, &$total = NULL) {
        global $db;
        /* @var $db PDO */
        if ($order != "DESC") $order = "ASC";
        $sortby = sanitize_paranoid_string($sortby);
        
        // Is $str an uid?
        $str_n = sanitize_int($str);
        // Is $str a name/in aliases/a playerid?
        $str_s = sanitize_sql_string($str);
        
        //Empty search?
        if (empty($str_s) && empty($str_n))
            return array(); // Return empty array
        
        $stmt = $db->prepare('SELECT COUNT(*) FROM players WHERE `name` LIKE :name OR `aliases` LIKE :aliases OR `uid` = :uid OR `playerid` LIKE :playerid');
        $stmt->bindValue(':name', "%".$str_s."%", PDO::PARAM_STR);
        $stmt->bindValue(':aliases', "%".$str_s."%", PDO::PARAM_STR);
        $stmt->bindValue(':uid', $str_n, PDO::PARAM_INT);
        $stmt->bindValue(':playerid', $str_s, PDO::PARAM_STR); // playerid is VARCHAR
        $stmt->execute();
        $total = $stmt->fetchColumn();

        $stmt = $db->prepare('SELECT '.Player::$fields.' FROM players WHERE `name` LIKE :name OR `aliases` LIKE :aliases OR `uid` = :uid OR `playerid` LIKE :playerid ORDER BY ' . $sortby . ' ' . $order . ' LIMIT :start , :count');
        $stmt->bindValue(':name', "%".$str_s."%", PDO::PARAM_STR);
        $stmt->bindValue(':aliases', "%".$str_s."%", PDO::PARAM_STR);
        $stmt->bindValue(':uid', $str_n, PDO::PARAM_INT);
        $stmt->bindValue(':playerid', $str_s, PDO::PARAM_STR); // playerid is VARCHAR
        $stmt->bindValue(':start', $start, PDO::PARAM_INT);
        $stmt->bindValue(':count', $count, PDO::PARAM_INT);
        $stmt->execute();

        $result = array();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $plr = new Player();
            $plr->fill($row, true);
            
            $result[] = $plr;
        }
        
        return $result;
    }
    
    public static function getPlayersByPlayerID($pids) {
        global $db;
        /* @var $db PDO */
        $pids = sanitize_sql_string($pids);

        $stmt = $db->prepare('SELECT '.Player::$fields.' FROM players WHERE FIND_IN_SET(`playerid`, :pids) ORDER BY playerid ASC');
        $stmt->bindValue(':pids', $pids, PDO::PARAM_INT);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = array();

        foreach ($rows as $row) {
            $plr = new Player();
            $plr->fill($row, true);
            
            $result[] = $plr;
        }

        return $result;
    }
    
    public static function getPlayerByPlayerID($pid) {
        global $db;
        /* @var $db PDO */
        $pid = sanitize_paranoid_string($pid);

        $stmt = $db->prepare('SELECT '.Player::$fields.' FROM players WHERE `playerid` = :pid LIMIT 1');
        $stmt->bindValue(':pid', $pid, PDO::PARAM_STR);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) == 0) return null;
        
        $plr = new Player();
        $plr->fill($result[0], true);
        
        return $plr;
    }
    
    public static function getPlayerByUID($uid) {
        global $db;
        /* @var $db PDO */
        $uid = sanitize_paranoid_string($uid);

        $stmt = $db->prepare('SELECT '.Player::$fields.' FROM players WHERE `uid` = :uid LIMIT 1');
        $stmt->bindValue(':uid', $uid, PDO::PARAM_STR);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) == 0) return null;
        
        $plr = new Player();
        $plr->fill($result[0], true);
        
        return $plr;
    }
    
    public static function getPlayerDBCount() {
        global $db;
        /* @var $db PDO */
        
        $count = $db->query('SELECT COUNT(*) FROM players')->fetchColumn();
        if (!isset($count))
            return 0;
        else
            return $count;
    }
    
    public static function getPlayers($sortby = "uid", $order = "DESC", $start = 0, $count = 100) {
        global $db;
        /* @var $db PDO */
        if ($order != "DESC") $order = "ASC";
        $sortby = sanitize_paranoid_string($sortby);
        $stmt = $db->prepare('SELECT '.Player::$fields.' FROM players ORDER BY ' . $sortby . ' ' . $order . ' LIMIT :start, :count');
        $stmt->bindValue(':start', $start, PDO::PARAM_INT);
        $stmt->bindValue(':count', $count, PDO::PARAM_INT);
        $stmt->execute();
        
        $result = array();
        
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row) {
            $plr = new Player();
            $plr->fill($row, true);
            
            $result[] = $plr;
        }
        
        return $result;
    }
    
    public static function getPlayersArray($sortby = "uid", $order = "DESC", $start = 0, $count = 100) {
        $players = Player::getPlayers($sortby, $order, $start, $count);
        $result = array();
        foreach ($players as $plr)
            $result[] = $plr->toArray();
        
        return $result;
    }
    
    public function updateAndSave($fields) {
        $this->fill($fields);
        return $this->saveToDB();
    }
    
    private function saveToDB() {
        global $db;
        /* @var $db PDO */
        
        if ($this->isInDB()) { // UPDATE
            $stmt = $db->prepare("UPDATE players SET `name` = :name, `playerid` = :playerid, `cash` = :cash, `bankacc` = :bankacc, `coplevel` = :coplevel, `cop_licenses` = :cop_licenses, `civ_licenses` = :civ_licenses, `med_licenses` = :med_licenses, `cop_gear` = :cop_gear, `mediclevel` = :mediclevel, `arrested` = :arrested, `aliases` = :aliases, `adminlevel` = :adminlevel, `donatorlvl` = :donatorlvl, `civ_gear` = :civ_gear, `blacklist` = :blacklist, `reb_gear` = :reb_gear, `rebellevel` = :rebellevel WHERE `uid` = :uid");
        } else { // INSERT
            $stmt = $db->prepare("INSERT INTO players (".Player::$fields.") VALUES (:name, :playerid, :cash, :bankacc, :coplevel, :cop_licenses, :civ_licenses, :med_licenses, :cop_gear, :mediclevel, :arrested, :aliases, :adminlevel, :donatorlvl, :civ_gear, :blacklist, :reb_gear, :rebellevel)");
        }
        $stmt->bindValue(':uid', $this->getUID(), PDO::PARAM_INT);
        $stmt->bindValue(':name', $this->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':playerid', $this->getPlayerID(), PDO::PARAM_STR);
        $stmt->bindValue(':cash', $this->getCash(), PDO::PARAM_INT);
        $stmt->bindValue(':bankacc', $this->getBankAcc(), PDO::PARAM_INT);
        $stmt->bindValue(':coplevel', $this->getCopLevel(), PDO::PARAM_STR);
        $stmt->bindValue(':cop_licenses', $this->getCopLicenses(), PDO::PARAM_STR);
        $stmt->bindValue(':civ_licenses', $this->getCivLicenses(), PDO::PARAM_STR);
        $stmt->bindValue(':med_licenses', $this->getMedLicenses(), PDO::PARAM_STR);
        $stmt->bindValue(':cop_gear', $this->getCopGear(), PDO::PARAM_STR);
        $stmt->bindValue(':mediclevel', $this->getMedicLevel(), PDO::PARAM_STR);
        $stmt->bindValue(':arrested', $this->getArrested(), PDO::PARAM_INT);
        $stmt->bindValue(':aliases', $this->getAliases(), PDO::PARAM_STR);
        $stmt->bindValue(':adminlevel', $this->getAdminLevel(), PDO::PARAM_STR);
        $stmt->bindValue(':donatorlvl', $this->getDonatorLevel(), PDO::PARAM_STR);
        $stmt->bindValue(':civ_gear', $this->getCivGear(), PDO::PARAM_STR);
        $stmt->bindValue(':blacklist', $this->getBlacklist(), PDO::PARAM_INT);
        $stmt->bindValue(':reb_gear', $this->getRebGear(), PDO::PARAM_STR);
        $stmt->bindValue(':rebellevel', $this->getRebLevel(), PDO::PARAM_STR);
        $count = $stmt->execute();
        
        if ($count > 0)
            $this->isInDB = true;
        
        return $count;
    }
}

?>