<?php # - activate.php
//activates a users account
require ('includes/config.inc.php');
$page_title = 'Activate Your Account';
include ('includes/header.inc.php');
//if $x and $y are not present or in the right format redirect  the user.
if (isset($_GET['x'], $_GET['y']) && filter_var($_GET['x'],
	FILTER_VALIDATE_EMAIL) && (strlen($_GET['y']) == 32 )
	) {
 //update database
	require(MYSQL);
$q = "UPDATE users SET active=NULL WHERE (email='" .mysqli_real_escape_string($dbc, $_GET['x']) . "' AND active='" .mysqli_real_escape_string($dbc, $_GET['y']) ."') LIMIT 1";
$r = mysqli_query($dbc, $q) OR trigger_error("Query: $q\n<br />MySQL Error: " . mysql_error($dbc));

//Print a customised message:
if (mysqli_affected_rows($dbc) == 1) {
	echo "<h3>Your account is now active. You may Log in.</h3>";
} else {
  echo '<p class"error"> Your account could not be activated. Please recheck the link or contact the system administrator.</P>';
}

mysqli_close($dbc);

} else { //redirect.

$url = BASE_URL . 'index.php'; //define the url.
ob_end_clean(); //delete buffer.
header("Location: $url");
exit(); //quit script.
} // end main if-else.
/*include ('includes/footer.html');*/
?>