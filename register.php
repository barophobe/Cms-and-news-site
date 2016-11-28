<?php # register.php 
// This page both displays and handles the registration form.


// Need the utilities file:
require('includes/utilities.inc.php');
/*require ('includes/config.inc.php');*/
// Create a new form:
set_include_path(get_include_path() . PATH_SEPARATOR . '/usr/share/pear');
require('HTML/QuickForm2.php');




$form = new HTML_QuickForm2('registerForm');

  

// Add the firstname field:
$firstname = $form->addElement('text', 'first_name', 'class=form-control input-xs');
$firstname->setLabel('Firstname');
$firstname->addFilter('trim');
$firstname->addFilter('strip_tags');
$firstname->addRule('required', 'Please enter a firstname.');

// Add the lastname field:
$lastname = $form->addElement('text', 'last_name', 'class=form-control input-xs');
$lastname->setLabel('Lastname');
$lastname->addFilter('trim');
$lastname->addFilter('strip_tags');
$lastname->addRule('required', 'Please enter a lastname.');

// Add the username field:
$username = $form->addElement('text', 'username', 'class=form-control input-xs');
$username->setLabel('Username');
$username->addFilter('trim');
$username->addFilter('strip_tags');
$username->addRule('required', 'Please enter a username.');

// Add the email address field:
$email = $form->addElement('text', 'email', 'class=form-control input-xs');
$email->setLabel('Email Address');
$email->addFilter('trim');
$email->addRule('email', 'Please enter your email address.');
$email->addRule('required', 'Please enter your email address.');

// Add the password field:
$pass = $form->addElement('password', 'pass', 'class=form-control input-xs');
$pass->setLabel('Password');
$pass->addFilter('trim');
$pass->addRule('required', 'Please enter your password.');

// Add the submit button:
$submit = $form->addElement('submit', 'submit', 'class=btn btn-default', array('value'=>'Register'));



// Check for a form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form submission
    
    // Validate the form data:
    if ($form->validate()) {

        // Check for the email address:
        $q = 'SELECT email FROM users WHERE email=:email';
        $stmt = $pdo->prepare($q);
        $r = $stmt->execute(array(':email' => $email->getValue()));
        if ($stmt->fetch(PDO::FETCH_NUM) > 0) {
            $email->setError('That email address has already been registered.');
        } else {

            // Insert into the database:
            $a = md5(uniqid(rand(), true));
            $q = 'INSERT INTO users (userType, first_name, last_name, active, username, email, pass, registration_date) VALUES ("public", :firstname, :lastname, :active, :username, :email, SHA1(:pass), NOW())';
            $stmt = $pdo->prepare($q);
            $r = $stmt->execute(array(':firstname' => $firstname->getValue(), ':lastname' => $lastname->getValue(), ':active' => $a, ':username' => $username->getValue(), ':email' => $email->getValue(), ':pass' => $pass->getValue()));


            if ($r) { // If it ran OK.

                // Send the email:
                $body = "Thank you for registering at <whatever site>. To activate your account, please click on this link:\n\n";
                $body .= BASE_URL . 'activate.php?x=' . urlencode($email->getValue()) . "&y=$a";
                mail($email->getValue(), 'Registration Confirmation', $body, 'From: admin@sitename.com');
                
                
               
            // Freeze the form upon success:
            
                $form->toggleFrozen(true);
                $form->removeChild($submit);
            }

        }
                
    } // End of form validation IF.
    
} // End of form submission IF.

// Show the page:
$pageTitle = 'Register';
include('includes/header.inc.php');
include('views/register.html');
/*include('includes/footer.inc.php');*/
?>