<?php # Script - forgot_password.php
//to reset password, if forgotten.
require ('includes/config.inc.php');
$page_title = 'Forgot Your Password';
include ('includes/header.inc.php');
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  	require (MYSQL);

  	//assume nothing:
  	$uid = FALSE;
  		//validate email address....
  		if (!empty($_POST['email'])) {

  			//check for the existence of email address.
  			$q = 'SELECT user_id FROM users WHERE email="'. mysqli_real_escape_string ($dbc, $_POST['email']) . '"';
  			$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

  			if (mysqli_num_rows($r) == 1) {
  				list($uid) = mysqli_fetch_array($r, MYSQLI_NUM);
  			} else { // no match in database.
  				echo '<p class="error">The submitted email does not match those on file!</p>';
  			}
  			} else { //no email!.
  				echo '<p class="error"> You forgot to enter your email address!.</p>';
  			} //end of empty post email IF. 
  			if ($uid) { 
  			$p = substr ( md5(uniqid(rand(), true)), 3, 10);
  			$q = "UPDATE users SET pass=SHA1('$p') WHERE user_id=$uid LIMIT 1";
  			$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
  				
  			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
		
			// Send an email:
  				$body = "Your password to log into edcodev.com has been temporarily changed to '$p'. Please log in using this password and this email address. Then you can change your password to something more familiar.";
  				mail ($_POST['email'], 'your temporary password.', $body, 'From: admin@edcodev.com');

  				//Print message.
  				echo '<h3> Your password has been changed. You will receive the new temporary password at the email address with which you registered. Once you have logged in with this password, you may change it by clicking on the "change password" link.</h3>';
  				mysqli_close($dbc);
  				include ('includes/footer.html');
  				exit();  //stop the script

  			} else { // if it did not run ok...
  				echo '<p class="error">Your password could not be changed due to a system error.We apologise for any inconvenience.</p>';
  			}

  			}  else { //failed the validation test..
  				echo '<p class="error">Please try again!.</p>';
  			}
  			mysqli_close($dbc);                   

  		}//end of main submit conditional.
?>
<h1>Reset Your Password</h1>
<p>Enter your email address below and your password will be reset.</p> 
<form action="forgot_password.php" method="post">
	<fieldset>
	<p><b>Email Address:</b> <input type="text" name="email" size="20" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" /></p>
	</fieldset>
	<div align="center"><input type="submit" name="submit" value="Reset My Password" /></div>
</form>

<?php include ('includes/footer.html'); ?>