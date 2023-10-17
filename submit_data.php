<?php
// Change this to your connection info.
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'test';

// Try and connect using the info above.
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$name = htmlspecialchars(trim($_POST['name']));
$email = htmlspecialchars(trim($_POST['email']));

$mobile = htmlspecialchars(trim($_POST['mobile']));
$address = htmlspecialchars(trim($_POST['address']));
$state = htmlspecialchars(trim($_POST['state']));
$city = htmlspecialchars(trim($_POST['city']));

if(empty($name) || empty($email) || empty($mobile)) {
	echo '
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
	  <strong>Oops!</strong> Please fill all frequired field bellow.
	  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div>
	';
}
else{
	$sql = "INSERT INTO form(name, email, mobile, address,state,city) VALUES ('".addslashes($name)."', '".addslashes($email)."', '".addslashes($mobile)."', '".addslashes($address)."','".addslashes($state)."','".addslashes($city)."')";
	if (mysqli_query($con, $sql)) {
    	echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Thank you!</strong> You you have sent message successfullly we will get back to you soon...
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    else{
    	echo "something went wrong!..".$message;
    }
}


?>