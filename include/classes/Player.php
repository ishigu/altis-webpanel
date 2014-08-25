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
    }
}

?>