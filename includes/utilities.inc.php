<?php # utilities.inc.php - Script 9.3
// This page needs to do the setup and configuration required by every other page.

// Autoload classes from "classes" directory:
function class_loader($class) {
    require('classes/' . $class . '.php');
}
spl_autoload_register('class_loader');

// Start the session:
session_start();

// Check for a user in the session:
$user = (isset($_SESSION['user'])) ? $_SESSION['user'] : null;

// Create the database connection as a PDO object:
try { 

    // Create the object:
    $pdo = new PDO('mysql:dbname=news;host=localhost', 'root', '');

} catch (PDOException $e) { // Report the error!
    
    $pageTitle = 'Error!';
    include('includes/header.inc.php');
    include('views/error.html');
    include('includes/footer.inc.php');
    exit();
    
}

// Flag variable for site status:
define('LIVE', FALSE);

// Admin contact address:
define('EMAIL', 'edoconnolly@gmail.com');

// Site URL (base for all redirections):
define ('BASE_URL', 'http://localhost/NewsSite/');

// Location of the MySQL connection script:
define ('MYSQL', '../mysqli_connect.php');

// Adjust the time zone for PHP 5.1 and greater:
date_default_timezone_set ('Europe/Dublin');

// ************ SETTINGS ************ //
// ********************************** //


// ****************************************** //
// ************ ERROR MANAGEMENT ************ //

// Create the error handler:
function my_error_handler ($e_number, $e_message, $e_file, $e_line, $e_vars) {

	// Build the error message:
	$message = "An error occurred in script '$e_file' on line $e_line: $e_message\n";
	
	// Add the date and time:
	$message .= "Date/Time: " . date('n-j-Y H:i:s') . "\n";
	
	if (!LIVE) { // Development (print the error).

		// Show the error message:
		echo '<div class="error">' . nl2br($message);
	
		// Add the variables and a backtrace:
		echo '<pre>' . print_r ($e_vars, 1) . "\n";
		debug_print_backtrace();
		echo '</pre></div>';
		
	} else { // Don't show the error:

		// Send an email to the admin:
		$body = $message . "\n" . print_r ($e_vars, 1);
		mail(EMAIL, 'Site Error!', $body, 'From: email@example.com');
	
		// Only print an error message if the error isn't a notice:
		if ($e_number != E_NOTICE) {
			echo '<div class="error">A system error occurred. We apologize for the inconvenience.</div><br />';
		}
	} // End of !LIVE IF.

} // End of my_error_handler() definition.

// Use my error handler:
set_error_handler ('my_error_handler');