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
define('SMARTY_DIR', str_replace("\\","/",getcwd()).'/libs/Smarty/');
$db = new PDO('mysql:dbname=arma3life;host=127.0.0.1', "arma", "password");
$paneldb = new PDO('mysql:dbname=webpanel;host=127.0.0.1', "panel", "password");
define('SECRET_KEY', ""); // Used for login cookies
define('COOKIE_EXPIRATION', 86400); // Login cookie expiration
define('COOKIE_AUTH', "awp_c"); // Login cookie name
define('COOKIE_PATH', "/");
define('COOKIE_DOMAIN', "");

$theme = "binary";
$title = "Westerland Altis Life Panel";

$veh_names = array(
    "B_Heli_Light_01_F" => "MH-9 Hummingbird",
    "B_Heli_Light_01_armed_F" => "AH-9 Pawnee",
    "B_Heli_Attack_01_F" => "AH-99 Blackfoot",
    "B_Heli_Transport_01_F" => "UH-80 Ghost Hawk",
    "B_Heli_Transport_01_camo_F" => "UH-80 Ghost Hawk (Camo)",
    "B_Plane_CAS_01_F" => "A-164 Wipeout (CAS)",
    "B_APC_Tracked_01_rcws_F" => "IFV-6c Panther",
    "B_APC_Tracked_01_CRV_F" => "CRV-6e Bobcat",
    "B_APC_Tracked_01_AA_F" => "IFV-6a Cheetah",
    "B_MBT_01_cannon_F" => "M2A1 Slammer",
    "B_MBT_01_arty_F" => "M4 Scorcher",
    "B_MBT_01_mlrs_F" => "M5 Sandstorm MLRS",
    "B_Boat_Armed_01_minigun_F" => "Speedboat Minigun",
    "B_Boat_Transport_01_F" => "Assault Boat",
    "B_Lifeboat" => "Rescue Boat",
    "B_SDV_01_F" => "SDV",
    "B_G_Boat_Transport_01_F" => "Assault Boat",
    "B_MRAP_01_F" => "Hunter",
    "B_MRAP_01_gmg_F" => "Hunter GMG",
    "B_MRAP_01_hmg_F" => "Hunter HMG",
    "B_Quadbike_01_F" => "Quadbike",
    "B_Truck_01_transport_F" => "HEMTT Transport",
    "B_Truck_01_covered_F" => "HEMTT Transport (Covered)",
    "B_G_Offroad_01_F" => "Offroad",
    "B_G_Offroad_01_armed_F" => "Offroad (Armed)",
    "B_G_Quadbike_01_F" => "Quadbike",
    "B_Truck_01_mover_F" => "HEMTT",
    "B_Truck_01_box_F" => "HEMTT Box",
    "B_Truck_01_Repair_F" => "HEMTT Repair",
    "B_Truck_01_ammo_F" => "HEMTT Ammo",
    "B_Truck_01_fuel_F" => "HEMTT Fuel",
    "B_Truck_01_medical_F" => "HEMTT Medica",
    "B_G_Van_01_transport_F" => "Truck",
    "B_G_Van_01_fuel_F" => "Fuel Truck",
    "B_APC_Wheeled_01_cannon_F" => "AMV-7 Marshall",
    "B_MBT_01_TUSK_" => "M2A4 Slammer UP",
    "O_Heli_Light_02_F" => "PO-30 Orca",
    "O_Heli_Light_02_unarmed_F" => "PO-30 Orca (Black)",
    "O_Heli_Attack_02_F" => "Mi-48 Kajman",
    "O_Heli_Attack_02_black_F" => "Mi-48 Kajman (Black)",
    "O_Plane_CAS_02_F" => "To-199 Neophron (CAS)",
    "O_APC_Tracked_02_cannon_F" => "BTR-K Kamysh",
    "O_APC_Tracked_02_AA_F" => "ZSU-39 Tigris",
    "O_MBT_02_cannon_F" => "T-100 Varsuk",
    "O_MBT_02_arty_F" => "2S9 Sochor",
    "O_Boat_Armed_01_hmg_F" => "Speedboat HMG",
    "O_Boat_Transport_01_F" => "Assault Boat",
    "O_Lifeboat" => "Rescue Boat",
    "O_SDV_01_F" => "SDV",
    "O_G_Boat_Transport_01_F" => "Assault Boat",
    "O_MRAP_02_F" => "Ifrit",
    "O_MRAP_02_hmg_F" => "Ifrit HMG",
    "O_MRAP_02_gmg_F" => "Ifrit GMG",
    "O_Quadbike_01_F" => "Quadbike",
    "O_Truck_02_covered_F" => "Zamak Transport (Covered)",
    "O_Truck_02_transport_F" => "Zamak Transport",
    "O_Truck_03_transport_F" => "Tempest Transport",
    "O_Truck_03_covered_F" => "Tempest Transport (Covered)",
    "O_Truck_03_repair_F" => "Tempest Repair",
    "O_Truck_03_ammo_F" => "Tempest Ammo",
    "O_Truck_03_fuel_F" => "Tempest Fuel",
    "O_Truck_03_medical_F" => "Tempest Medical",
    "O_Truck_03_device_F" => "Tempest (Device)",
    "O_G_Offroad_01_F" => "Offroad",
    "O_G_Offroad_01_armed_F" => "Offroad (Armed)",
    "O_G_Quadbike_01_F" => "Quadbike",
    "O_Truck_02_box_F" => "Zamak Repair",
    "O_Truck_02_medical_F" => "Zamak Medical",
    "O_Truck_02_Ammo_F" => "Zamak Ammo",
    "O_Truck_02_fuel_F" => "Zamak Fuel",
    "O_G_Van_01_transport_F" => "Truck",
    "O_G_Van_01_fuel_F" => "Fuel Truck",
    "O_APC_Wheeled_02_rcws_F" => "MSE-3 Marid",
    "C_Rubberboat" => "Rescue Boat",
    "C_Boat_Civil_01_F" => "Motorboat",
    "C_Boat_Civil_01_rescue_F" => "Motorboat (Rescue)",
    "C_Boat_Civil_01_police_F" => "Motorboat (Police)",
    "C_Offroad_01_F" => "Offroad",
    "C_Quadbike_01_F" => "Quadbike",
    "C_Hatchback_01_F" => "Hatchback",
    "C_Hatchback_01_sport_F" => "Hatchback (Sport)",
    "C_SUV_01_F" => "SUV",
    "C_Van_01_transport_F" => "Truck",
    "C_Van_01_box_F" => "Truck Boxer",
    "C_Van_01_fuel_F" => "Fuel Truck",
    "C_Kart_01_F" => "Kart (Random)",
    "C_Kart_01_Fuel_F" => "Kart (Fuel)",
    "C_Kart_01_Blu_F" => "Kart (Bluking)",
    "C_Kart_01_Red_F" => "Kart (Redstone)",
    "C_Kart_01_Vrana_F" => "Kart (Vrana)",
    "I_Heli_Transport_02_F" => "CH-49 Mohawk",
    "I_Heli_light_03_F" => "WY-55 Hellcat",
    "I_Heli_light_03_unarmed_F" => "WY-55 Hellcat (Green)",
    "I_Plane_Fighter_03_CAS_F" => "A-143 Buzzard (CAS)",
    "I_Plane_Fighter_03_AA_F" => "A-143 Buzzard (AA)",
    "I_APC_tracked_03_cannon_F" => "FV-720 Mora",
    "I_MBT_03_cannon_F" => "MBT-52 Kuma",
    "I_Boat_Armed_01_minigun_F" => "Speedboat Minigun",
    "I_Boat_Transport_01_F" => "Assault Boat",
    "I_SDV_01_F" => "SDV",
    "I_G_Boat_Transport_01_F" => "Assault Boat",
    "I_MRAP_03_F" => "Strider",
    "I_MRAP_03_hmg_F" => "Strider HMG",
    "I_MRAP_03_gmg_F" => "Strider GMG",
    "I_Quadbike_01_F" => "Quadbike",
    "I_Truck_02_covered_F" => "Zamak Transport (Covered)",
    "I_Truck_02_transport_F" => "Zamak Transport",
    "I_G_Offroad_01_F" => "Offroad",
    "I_G_Offroad_01_armed_F" => "Offroad (Armed)",
    "I_G_Quadbike_01_F" => "Quadbike",
    "I_Truck_02_ammo_F" => "Zamak Ammo",
    "I_Truck_02_box_F" => "Zamak Repair",
    "I_Truck_02_medical_F" => "Zamak Medical",
    "I_Truck_02_fuel_F" => "Zamak Fuel",
    "I_G_Van_01_transport_F" => "Truck",
    "I_G_Van_01_fuel_F" => "Fuel Truck",
    "I_APC_Wheeled_03_cannon_F" => "AFV-4 Gorgon"
);

$veh_skins = array(
    "C_Offroad_01_F" => array("Rot","Gelb","Weiss","Blau","Dunkel Rot","Blau / Weiss","Polizei","Taxi","Polizei","Greenfoot","Tussy","Hard Work","Mario","Monster","Nyan","Pokemon","ADAC","Schwarz Metallic"),
    "I_Heli_light_03_unarmed_F" => array("Angry","Angry","Polizei","Rebel Green"),
    "B_Heli_Transport_01_F" => array("Polizei"),
    "C_Hatchback_01_F" => array("Beige","Gruen","Blau","Dunkel Blau","Gelb","Weiss","Grau","Schwarz","Pimp","Hello Kitty","Pimp Blue","Metallica","Polizei","Schwarz Metallic","Schwarz"),
    "C_Hatchback_01_sport_F" => array("Rot","Dunkel Blau","Orange","Schwarz / Weiss","Tan","Gruen","Schwarz Metallic","Schwarz","Polizei"),
    "C_SUV_01_F" => array("Schwarz","Silver","Orange","Weiss","Polizei","Carbon","Carbon / Felgen","RageCore","Batman","Superman","Notarzt","Schwarz Metallic","Schwarz"),
    "C_Van_01_box_F" => array("Weiss","Rot"),
    "C_Van_01_transport_F" => array("Weiss","Rot"),
    "C_Van_01_fuel_F" => array("Weiss","Rot"),
    "B_Quadbike_01_F" => array("Braun","Digital Braun","Schwarz","Blau","Rot","Weiss","Digital Gruen","Hunter Camo","Rebell Camo"),
    "B_Heli_Light_01_F" => array("Polizei","Polizei","Civ Blue","Civ Red","Digi Green","Blueline","Elliptical","Furious","Jeans Blue","Speedy Redline","Sunset","Vrana","Waves Blue","Rebellen Digital","Gruen/Braun","Weed"),
    "O_Heli_Light_02_unarmed_F" => array("Polizei","Weiss / Blau","Digital Gruen","Digital Braun","Weiss / Gruen","Weiss / Orange","Weiss / Grau","Schwarz","Notarzt","Adac"),
    "B_MRAP_01_F" => array("Polizei"),
    "I_MRAP_03_F" => array("Regular","Camo","Sand"),
    "O_MRAP_02_F" => array("Black","Death","Sand","GoldGelb","BluePixel"),
    "I_Truck_02_covered_F" => array("Rot","Schwarz","Blau","Gruen","Orange"),
    "I_Truck_02_transport_F" => array("Rot","Schwarz","Blau","Gruen","Orange","Rebellen Digital"),
    "O_Heli_Attack_02_black_F" => array("Black"),
    "I_Heli_Transport_02_F" => array("Ion","Dahoman","Braun","RageCore","Camo","Rebel"),
    "B_Truck_01_covered_F" => array("Regulear"),
    "B_Truck_01_mover_F" => array("ADAC")
);

$veh_sides = array(
    "cop" => "Polizei",
    "civ" => "Zivilist",
    "reb" => "Rebell",
    "med" => "Sanit&auml;ter",
    "adac" => "ADAC"
);

?>