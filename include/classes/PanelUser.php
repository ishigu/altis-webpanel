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

class PanelUser {
    private $id;
    private $username;
    private $password;
    private $salt;
    private $playerid;
    private $enabled;
    private $isInDB;
    private $isLoggedIn;
    public static $fields = '`username`, `password`, `salt`, `playerid`, `enabled`';

    public function getId() { return $this->id; }
    public function setId($d) { $this->id = $d; }
    public function getUsername() { return $this->username; }
    public function setUsername($d) { $this->username = $d; }
    public function getPasswordHash() { return $this->password; }
    public function setPasswordHash($d) { $this->password = $d; }
    public function getSalt() { return $this->salt; }
    public function setSalt($d) { $this->salt = $d; }
    public function getPlayerID() { return $this->playerid; }
    public function setPlayerID($d) { $this->playerid = $d; }
    public function isEnabled() { return $this->enabled; }
    public function setEnabled($d) { $this->enabled = $d; }
    public function isInDB() { return $this->isInDB; }
    public function isLoggedIn() { return $this->isLoggedIn; }
    public function setLoggedIn($d) { $this->isLoggedIn = $d; }
    
    public function __construct() {
        $this->id = 0;
        $this->username = "Gast";
        $this->password = "";
        $this->salt = "";
        $this->playerid = "";
        $this->enabled = 0;
        $this->isInDB = false;
        $this->isLoggedIn = false;
    }
    
    public function fill($data, $DB = false) {
        foreach ($data as $field => $value) {
            switch ($field) {
                case 'id': $this->id = $value; break;
                case 'username': $this->username = $value; break;
                case 'password': $this->password = $value; break;
                case 'salt': $this->salt = $value; break;
                case 'playerid': $this->playerid = $value; break;
                case 'enabled': $this->enabled = $value; break;
            }
        }
        if ($DB)
            $this->isInDB = true;
    }
    
    public function toArray() {
        return get_object_vars($this);
    }
    
    public function setPassword($str) {
        $cost = 10; // Costs for the hashing algorithm, makes it slower to calculate a hash
        $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
        $salt = sprintf("$2a$%02d$", $cost) . $salt; // Add a prefix to tell crypt which algorith to use, here we use $2a$ (blowfish)
        $hash = crypt($str, $salt);

        $this->setPasswordHash($hash);
        $this->setSalt($salt);
    }
    
    public function checkPassword($password) {
        return crypt($password, $this->getSalt()) === $this->getPasswordHash();
    }
    
    public function saveToDB() {
        global $paneldb;
        /* @var $paneldb PDO */
        
        if ($this->isInDB()) { // UPDATE
            $stmt = $paneldb->prepare("UPDATE users SET `username` = :username, `password` = :password, `salt` = :salt, `playerid` = :playerid WHERE `id` = :id");
            $stmt->bindValue(':id', $this->getId(), PDO::PARAM_INT);
        } else { // INSERT
            $stmt = $paneldb->prepare("INSERT INTO users (".PanelUser::$fields.") VALUES (:username, :password, :salt, :playerid, '0')");
        }
        $stmt->bindValue(':username', $this->getUsername(), PDO::PARAM_STR);
        $stmt->bindValue(':password', $this->getPasswordHash(), PDO::PARAM_STR);
        $stmt->bindValue(':salt', $this->getSalt(), PDO::PARAM_STR);
        $stmt->bindValue(':playerid', $this->getPlayerID(), PDO::PARAM_INT);
        $count = $stmt->execute();
        
        if ($count > 0)
            $this->isInDB = true;
        
        return $count;
    }
    
    public function login($password) {
        global $paneldb;
        /* @var $paneldb PDO */

        $stmt = $paneldb->prepare('SELECT `id`, '.PanelUser::$fields.' FROM users WHERE `username` = :username LIMIT 1');
        $stmt->bindValue(':username', $this->getUsername(), PDO::PARAM_STR);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) == 0) return false;
        $result = $result[0];
        
        if (crypt($password, $result["salt"]) === $result["password"] && $result["enabled"] == 1) {
            $this->fill($result, true);
            $this->setLoggedIn(true);
            return true;
        }
        return false;
    }
    
    public static function getUserById($id) {
        global $paneldb;
        /* @var $paneldb PDO */
        
        $stmt = $paneldb->prepare('SELECT `id`, '.PanelUser::$fields.' FROM users WHERE `id` = :id LIMIT 1');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($result) == 0)
            return null;
        
        $user = new PanelUser();
        $user->fill($result[0], true);

        return $user;
    }
    
    public static function getUserByUsername($username) {
        global $paneldb;
        /* @var $paneldb PDO */
        
        $stmt = $paneldb->prepare('SELECT `id`, '.PanelUser::$fields.' FROM users WHERE `username` = :username LIMIT 1');
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($result) == 0)
            return null;
        
        $user = new PanelUser();
        $user->fill($result[0], true);

        return $user;
    }
    
    public function generateCookie($exp) {
        $key = hash_hmac('md5', $this->getId().$exp, SECRET_KEY);
        $hash = hash_hmac('md5', $this->getId().$exp, $key);
        
        return $this->getId() . '|' . $exp . '|' . $hash;
    }
    
    public static function verifyCookie() {
        if (empty($_COOKIE[COOKIE_AUTH]))
            return false;

        list($id, $exp, $hmac) = explode('|', $_COOKIE[COOKIE_AUTH]);

        if ($exp < time())
            return null; // Cookie too old
        
        $key = hash_hmac('md5', $id.$exp, SECRET_KEY);
        $hash = hash_hmac('md5', $id.$exp, $key);
        
        if ($hmac == $hash) { // Login
            $user = PanelUser::getUserById($id);
            
            if ($user->isEnabled()) {
                $user->setLoggedIn(true);
                return $user;
            }
        }
        return null;
    }
}

?>