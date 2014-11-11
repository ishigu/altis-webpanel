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

/**
 * Based on BattleNet BattleEye library and DayZAdmin
 */
class RconClient {

    private $socket;
    private $credentials;

    public function __construct($host, $port, $password) {
        $this->credentials = array("host" => $host, "port" => $port, "password" => $password);
    }

    private function computeUnsignedCRC32($str) {
        sscanf(crc32($str), "%u", $var);
        $var = dechex($var + 0);
        return $var;
    }

    private function strToHex($string) {
        $hex = '';
        for ($i = 0; $i < strlen($string); $i++) {
            $hex .= dechex(ord($string[$i]));
        }
        return $hex;
    }

    private function get_checksum($cs) {
        $var = $this->computeUnsignedCRC32($cs);
        $x = ('0x');
        $a = substr($var, 0, 2);
        $a = $x . $a;
        $b = substr($var, 2, 2);
        $b = $x . $b;
        $c = substr($var, 4, 2);
        $c = $x . $c;
        $d = substr($var, 6, 2);
        $d = $x . $d;
        return chr($d) . chr($c) . chr($b) . chr($a);
    }

    public function connect() {
        $this->socket = fsockopen("udp://" . $this->credentials['host'], $this->credentials['port'], $errno, $errstr, 1);
        stream_set_timeout($this->socket, 1);

        if ($this->socket) {
            $this->sendLogin();
        }
    }

    public function disconnect() {
        $this->sendCommand("Exit");
        fclose($this->socket);
    }

    private function sendLogin() {
        $pass = chr(0xFF) . chr(0x00) . $this->credentials['password'];
        $checksum = $this->get_checksum($pass);
        $loginmsg = chr(0x42) . chr(0x45) . $checksum . $pass;

        fwrite($this->socket, $loginmsg);
        $result = fread($this->socket, 16);
        
        return $result;
    }

    public function sendCommand($cmd) {
        $cmd = chr(0xFF) . chr(0x01) . chr(0x00) . $cmd;
        $checksum = $this->get_checksum($cmd);
        $cmdPacket = chr(0x42) . chr(0x45) . $checksum . $cmd;

        fwrite($this->socket, $cmdPacket);
        return $this->receive();
    }

    private function receive() {
        $answer = "";
        $orig = "";
        for ($i = 0; $i < 5; $i++) {
            $str = fread($this->socket, 102400); // Read 100kB
            $orig .= $str;
            $answer .= substr($str, 12);
        }
        /*
        if ($this->strToHex(substr($answer, 9, 1)) == "0") {
            $count = $this->strToHex(substr($orig, 10, 1));
            for ($i = 0; $i < $count - 1; $i++)
                $answer .= substr(fread($this->socket, 102400), 12);
        }*/
        return $answer;
    }

}
