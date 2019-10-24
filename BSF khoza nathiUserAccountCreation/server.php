
<?php

session_start();
// variable declaration
$_SESSION['success'] = "";

require_once('connection.php');




//sign Up

	if(isset($_POST['Sign_Up'])){
		// receive all input values from the form
		$FirstName = mysqli_real_escape_string($con, $_POST['USER_NAM']);
		$LastName = mysqli_real_escape_string($con, $_POST['USER_SURNAME']);
		$USER_PASSWORD = mysqli_real_escape_string($con, $_POST['USER_PASSWORD']);
		$CONFIRM_PASSWORD = mysqli_real_escape_string($con, $_POST['CONFIRM_PASSWORD']);

		$SQL = "SELECT FirstName, LastName, EMAIL,FROM  `userdetails`
				WHERE EMAIL = '$EMAIL'";
								
		
		// Gender, birthDate, maritalStatus,llocation,
		// 				, website, skype, twitter, UserType, immage 
								
		$Cresults = mysqli_query($con, $SQL);
		if(mysqli_num_rows($Cresults) == 0 && $USER_PASSWORD === $CONFIRM_PASSWORD){
			$SQL = "INSERT INTO `userdetails`(FirstName, LastName, EMAIL,USER_PASSWORD)									  
					VALUES ('$FirstName','$LastName','$EMAIL','$CONFIRM_PASSWORD')";

			$succesCResults = mysqli_query($con, $SQL);
			if($succesCResults){
						echo "<script>
						window.alert('Successfully Registered');
						</script>";
						//header("Location:login.php");
					} 
					else
					{
						echo 'Unable to register. Please try again.', mysqli_error($con);
					}
			}
			else
			{
				//Error Here
				echo "user already registered", mysqli_error($con);
			}
			
	}




//Login
if(isset($_POST['Login'])){
	// receive all input values from the form
	$EMAIL = mysqli_real_escape_string($con, $_POST['EMAIL']);
	$USER_PASSWORD = mysqli_real_escape_string($con, $_POST['USER_PASSWORD']);
	
	//Check If the company exist
	$SQL = "SELECT * FROM `userdetails` 
							WHERE email = '$EMAIL'
							";
	$Cresults = mysqli_query($con, $SQL);
	
	if(mysqli_num_rows($Cresults) > 0){
			echo "Successfully Logged in";
			header("Location:index.php");
		}
		else
		{
			//Error Here
			echo "Error", mysqli_error($con);
		}
		
}

//FORGOT PASSWORD

if(isset($_POST['resetP'])){
	// receive all input values from the form
	$EMAIL = mysqli_real_escape_string($con, $_POST['EMAIL']);

	$SQL = "SELECT * FROM `userdetails` WHERE email = '$EMAIL'";
	$Cresults = mysqli_query($con, $SQL);
	if(mysqli_num_rows($Cresults) > 0){
		echo "you can change ur password";
		header("Location:forgotP.php");
	}
		
}

//change password

if(isset($_POST['forgotP'])){
	// receive all input values from the form
	$newPass = mysqli_real_escape_string($con, $_POST['newpassword']);
	$conPass = mysqli_real_escape_string($con, $_POST['corn_password']);
	
	if($newPass === $conPass){
		$SQL="UPDATE userdetails SET user_password = '$conPass'";

			$succesCResults = mysqli_query($con, $SQL);
			if($succesCResults){
						
				echo "Successfully Updated";
				header("Location:login.php");
			} 
			else
			{
				echo 'Unable to chance password. Please try again.', mysqli_error($con);
			}
	}
	else{
		echo "Password not the same";
	}
		
}



?>
