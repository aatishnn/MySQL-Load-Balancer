<?php
/**
 * MySQL Load Balancer - Aatish Neupane 
 * A simple anywhere usable load balancer for MySQL servers
 * 
 * Copyright (c) 2011 Aatish Neupane
 *
 *  This file is part of MySQL Load Balancer.
 *
 *  MySQL Load Balancer is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  at your option) any later version.
 *
 *  MySQL Load Balancer is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *  You should have received a copy of the GNU General Public License
 *  along with MySQL Load Balancer.  If not, see <http://www.gnu.org/licenses/>.
 */
class loadbalancer
{
public $server_main=array("Hostname:Port","root","password","dbname");
public $backup_server=array("Hostname:Port","root","password","dbname");
public $debug_info = "";
public $myFile = "status.txt";

function checkserver($server,$username,$password,$db) {
	try{
			$connection=@mysql_connect($server,$username,$password);
			if(!$connection)
			throw new Exception("Cannot connect to MYSQL server");

			$db_select=@mysql_select_db($db,$connection);
			if(!$db_select)
			throw new Exception("Cannot select database");
			return true;
		}
	catch(Exception $e){
			$this->debug_info = $e->getMessage();
			return false;
			}

	}
function checkstatus(){
$fh = @fopen($myFile, 'r');
$status = @fread($fh, 6);
fclose($fh);
if($status=="Backup")
return false;//Backup Server is used
else 
return true;
}

function returnconfig(){
if($this->checkserver($this->server_main[0],$this->server_main[1],$this->server_main[2],$this->server_main[3])){
if($this->checkstatus()){
return server_main;
}
}
else
return backup_server;
if(!$this->checkstatus()){
$fh = @fopen($this->myFile, 'w')
$stringData = "Backup";
@fwrite($fh, $stringData);
@fclose($fh);
}
}
}
?>

