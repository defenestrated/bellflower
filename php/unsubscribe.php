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
	
	//form data
	$name = $_POST['name'];
	$email = $_POST['email'];
	
	//mySQL input
	$mysqldate;
	$query;
		
	
	mysql_connect($hostname, $username, $password);
	@mysql_select_db($database) or die( "Unable to select database");
	$mysqldate = date( 'Y-m-d H:i:s' );
	$query = "DELETE FROM emailList WHERE email = '$email'";
	$result = mysql_query($query);
	
	if ($result == true) {
		$headers = 'From: info@bellflowerproject.com' . "\r\n" .
		'Reply-To: info@bellflowerproject.com' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$subject = "You've been successfully unsubscribed from The Bellflower Project mailing list";
		$emailBody = '
		<html>
		<body>
		<p>We\'re sad to see you go!</p>
		<p>You can always find the latest happenings at <a href="www.bellflowerproject.com">www.bellflowerproject.com</a></p>
		</body>
		</html>';
		$mailSuccess = mail($email, $subject, $emailBody, $headers);
	}
	mysql_close();
	/*
	$headers = "From: info@bellflowerproject.com" . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	$emailBody = "<p>Hi there! </br></br> Thanks for signing up - we'll keep you posted with all the latest solar-powered-robot-musical-flower news.</br></br></br>All the best,</br>-the Bellflower team</p>";
				  
				  
	
	mail("$email","Mailing list confirmation from the Bellflower project",$emailBody,$headers);
	
	$headers = "From: do-not-reply@bellflowerproject.com" . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	$emailBody = "<p>New registration info: </p>
				  <p><strong>Email Address: </strong> {$email} </p>
				  <p> on $date at $time from $ipaddress</p>";
	
	mail("info@bellflowerproject.com","New registration: $email",$emailBody,$headers);
	*/
	
	$returnData = array(
		'posted_form_data' => array(
			'name' => $name,
			'email' => $email,
			'ipAddress' => $ipAddress,
			'dateT' => $mysqldate
		),
		'errors' => $errors,
		'exists' => $result,
		'mailSuccess' => $mailSuccess
	);
	
	echo(json_encode($returnData) );
}
