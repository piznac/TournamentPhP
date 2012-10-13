<?php
/**
* connect.php - simple mysqli connection file
*
* @package  phpTournament
* @author   Matthew Hurst 
*           - HurstFreelance.com
*           - piznac
*/
$mysqli = new mysqli();
$mysqli->connect('DBhost', 'DBuser', 'DBpassword', 'DBname');
$mysqli->select_db('DBname');

//Check our connection
if (mysqli_connect_errno()) {
	throw new Exception("Connect failed");

	exit();
}