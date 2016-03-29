<?php
    require_once('dbconfig.php');
    //$db  = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD);
   // $db->query("CREATE DATABASE cyber_twin2");
    $db  = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD,DB_DATABASE);
    //$db = new SQLite3("events.db");
    /*** Create table for machine failure event ***/
    //$db->query("use DATABASE cyber_twin2");
   // $db->query("CREATE TABLE IF NOT EXISTS `buttons` (
  /*`id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `under` int(11) DEFAULT NULL,
  `show_name` varchar(500) NOT NULL
)");
    $db->query("CREATE TABLE IF NOT EXISTS `login` (
  `id_login` int(11) NOT NULL PRIMARY KEY,
  `name_login` varchar(45) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type_login` int(45) NOT NULL
)");

*/
//TODO CHANGE QUERY
 
   

//    $db->query("CREATE TABLE IF NOT EXISTS job (start_time varchar(255), end_time varchar(255), duration varchar(255), job_type varchar(255), component varchar(255))");
 //   $db->query("CREATE TABLE IF NOT EXISTS machine_failure (start_time varchar(255), end_time varchar(255), duration varchar(255), failed_unit varchar(255), failure_mode varchar(255))");
  //  $db->query("CREATE TABLE IF NOT EXISTS setup_change (start_time varchar(255), end_time varchar(255), duration varchar(255), old_setup varchar(255), new_setup varchar(255))");
 //   $db->query("CREATE TABLE IF NOT EXISTS production_stoppage (start_time varchar(255), end_time varchar(255), duration varchar(255), cause varchar(255))");
   // $db->query("CREATE TABLE IF NOT EXISTS operator_unavailability (start_time varchar(255), end_time varchar(255), duration varchar(255), cause varchar(255))");

   // $db->query("CREATE TABLE IF NOT EXISTS lunch_tea (start_time varchar(255), end_time varchar(255), duration varchar(255))");//
   // $db->query("CREATE TABLE IF NOT EXISTS precautionary_check (start_time varchar(255), end_time varchar(255), duration varchar(255))");
    //$db->query("CREATE TABLE IF NOT EXISTS pm (start_time varchar(255), end_time varchar(255), duration varchar(255))");
?>
