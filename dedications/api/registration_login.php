<?php
$app->post('/api/register', function($request, $response){
	include('db_connection.php');
	$parsedBody = $request->getParsedBody();
	$stmt = $con->prepare("INSERT INTO user (first_name, last_name, email_id, password, mobile_no, 	                                     created_date)
		VALUES (?, ?, ?, ?, ?, UTC_TIMESTAMP())");
		//print_r($parsedBody);
	$stmt->bind_param("sssss", $parsedBody['first_name'], $parsedBody['last_name'], 
		$parsedBody['email_id'], $parsedBody['password'], 
		$parsedBody['mobile_no']);

	$stmt->execute();
	printf("Error: %s.\n", $stmt->error);
	echo "New records created successfully";
});

$app->post('/api/login', function($request, $response){
	include('db_connection.php');
	$parsedBody = $request->getParsedBody();
	$email = $parsedBody['email_id'];
	$password = $parsedBody['password'];
	$sql = "SELECT * FROM user WHERE email_id = '$email' AND password = '$password'";
	$result = $con->query($sql);
	if($result && $result->num_rows == 1 )
	{
		$row = $result -> fetch_assoc();
		$_SESSION["first_name"] = $row["first_name"]; 
		$_SESSION["user_id"] = $row["user_id"]; 
		$output = array("firstName" => $_SESSION['first_name'], "userId" => $_SESSION['user_id']);
		$_SESSION['login_details'] = $output;
		echo json_encode($output);
	}
	else
	{
		echo "0";
	}

});

$app->post('/api/email-validation', function($request, $response){
	include('db_connection.php');
	$parsedBody = $request->getParsedBody();
	$email = $parsedBody['email_id'];
	$sql = "SELECT * FROM user WHERE email_id = '$email'";
	$result = $con->query($sql);
	if($result && $result->num_rows > 0 )
	{
		echo "1";
	}
	else
	{
		echo "0";
	}

});

?>