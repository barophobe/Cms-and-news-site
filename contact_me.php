<?php # script contact_me.php

require ('includes/config.inc.php');
$page_title = 'Contact Me';
include ('includes/header.html');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	//form validation
if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message']) ) {
	
		// Create the body:
		$body = "Name: {$_POST['name']}\n\nmessage: {$_POST['message']}";
		$body = wordwrap($body, 200);
	
		// Send the email:
		mail('edoconnolly@gmail.com', 'Contact Form Submission', $body, "From: {$_POST['email']}");

		// Print a message:
		echo '<p>Your message has been sent!</p>';
		
		// Clear $_POST (so that the form's not sticky):
		$_POST = array();
	
	} else {
		echo '<p style="font-weight: bold; color: #C00">Please fill out the form completely.</p>';
	}	

}// end of main isset() IF.

// create html form
?>

<div class="container-fluid bodyBkg">
<div class="row">
<div class="col-lg-5 col-lg-offset-1 col-md-6 col-sm-12">
  

<p class="conTxt">Please feel free to contact me and I will get back to you<span class="frmConHd2">&nbsp;!</span></p>



    <div class="row">
       
          <div class="socL">

            <ul class="landList list-inline" >
                 <li><a href="https://www.facebook.com/ed.connolly.560"><span class="hovF"></span></a></li>
                  <li><a href="https://twitter.com/edddddd"><span class="hovT"></span></a></li>
                  <li><a href="https://www.linkedin.com/in/edmond-connolly-6b2a84116?trk=nav_responsive_tab_profile"><span class="hovL"></span></a></li>
            
            </ul>
        </div>
    </div>
</div>





  <div class="col-lg-6 col-md-6 col-sm-12">

<form class="form-horizontal" action="contact_me.php" method="post">
  <fieldset>
    <div class="row">
<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
<h1 class="frmConHd">Contact <span class="frmConHd2">me</span>:</h1>
</div>
</div>

  <div class="form-group has-feedback">
    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
     <input class="form-control input-lg" type="text" name="name" size="20" maxlength="20" placeholder="Your Name" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>" />
     <span class="glyphicon glyphicon-user whtIco form-control-feedback" aria-hidden="true"></span>
    </div>
    </div>

    <div class="form-group has-feedback">
      <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
     <input class="form-control input-lg" type="email" name="email" size="30" placeholder="Your Email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" />
     <span class="glyphicon glyphicon-envelope whtIco form-control-feedback" aria-hidden="true"></span>
  </div>
  </div>

    <div class="form-group">
      <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
     <textarea class="form-control input-lg" rows="7" cols="30" type="text" name="message" placeholder="Your Message" value="<?php if (isset($_POST['message'])) echo $_POST['message']; ?>"  /></textarea> 
  </div>
  </div>

                       
  </fieldset>

  <div class="form-group">
     <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2">
     <div align="center"><button class="btn btn-lg" type="submit" name="submit" value="Send!">Send</button></div>
  </div>
</div>
</form>


</div>


</div>
</div>

<?php include ('includes/footer.html'); ?>