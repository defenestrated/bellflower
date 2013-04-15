
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
	$query = "SELECT name, email FROM emailList";
	$result = mysql_query($query);
	
	
	$numRows = mysql_num_rows($result);
	$counter = 0;
	
	while($row=mysql_fetch_array($result)) {  
		$counter++;
		echo $row['name'] . ' &lt;';
		echo $row['email'] . '&gt;';
		if ($counter < $numRows) {
			echo ', ';
		}
	}  
	mysql_close();
}
