<?php
require("balancer.inc.php");
$details = new loadbalancer();
$server=$details->returnconfig();
echo "<br />Hostname:{$server[0]}";
echo "<br />Username:{$server[1]}";
echo "<br />Password:{$server[2]}";
echo "<br />Database:{$server[3]}";
?>