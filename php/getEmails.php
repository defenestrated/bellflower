<?php
if( isset($_POST) ){
	
	//database connection
	$hostname = "localhost";
	$username = "samgalis_bf";
	$password = "Bellfl0w3r_DB";
	$database = "samgalis_bellflower_general";
	
	$errors = array();
	
	//sumbission data
	$ipAddress = $_SERVER['REMOTE_ADDR'];
	$date = date('d/m/Y');
	$time = date('H:i:s');
	
	//mySQL input
	$mysqldate;
	$query;
		
	
	mysql_connect($hostname, $username, $password);
	@mysql_select_db($database) or die( "Unable to select database");
	$mysqldate = date( 'Y-m-d H:i:s' );
	$query = "SELECT email FROM emailList";
	$result = mysql_query($query);
	mysql_close();
	
	$numRows = mysql_num_rows($result);
	for ($i = 0; $i < $numRows; $i++) {
		echo(mysql_result($result, $i));
		if ($i < $numRows - 1) echo(", ");
		//echo(mysql_result($result, $i, 1));
		//echo(">, ");
	}
}
