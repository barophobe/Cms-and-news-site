<?php #  header.inc.php
// This page begins the HTML header for the site.

// Start output buffering:
ob_start();
/*session_start();*/

// Check for a user in the session:
//$user = (isset($_SESSION['user'])) ? $_SESSION['user'] : null;
/*require('includes/utilities.inc.php');*/
/*require ('includes/config.inc.php');
// Check for a $page_title value:
/*if (!isset($page_title)) {
  $page_title = 'User Registration';
}*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="" name="description">
	<meta content="" name="author">
	<link href="assets/img/favicon.ico" rel="icon">
	<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
  <meta name="twitter:widgets:autoload" content="on">
  <link rel="canonical" href="https://dev.twitter.com/">
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
<!--   <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
   -->  <link rel="stylesheet" href="css/styles.css">
  <script src= "bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js" type="text/javascript"></script>
  <script src="js/edcodev.js" type="text/javascript"></script>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<!-- <title><?php  $page_title; ?></title> -->
  <title><?php echo (isset($pageTitle)) ? $pageTitle : 'Some Content Site'; ?></title>
	<!--<style type="text/css" media="screen">@import "includes/layout.css";</style>-->
  <script src="https://connect.soundcloud.com/sdk/sdk-3.0.0.js"></script>
  <script>
  SC.initialize({
    client_id: '90f1b793826749d759909682ff92be8d'
  });
  </script>
  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
  
  </head>
<body>
  <header class="woops">
    <div class="container">
  <nav class="nav navbar-default">
     <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
        

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php if ($user && $user->canCreatePage()) echo '<li><a href="add_page.php">Add a New Page</a></li>'; ?>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
    
      <ul class="nav navbar-nav navbar-right">
        <?php 
                if (!$user) { //  Not logged in.
                  echo '<li><a href="register.php" title="Register for the Site">Register</a></li>
                <li><a href="forgot_password.php" title="Password Retrieval">Retrieve Password</a></li>
                ';
                }
                ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php if ($user) {
  echo '<span>' . $user->getUserName() . '</span>';} else { //  Not logged in.
                  echo '<li><a href="login.php" title="Login">Log in</a></li>';
                }
                ?>
 <span class="caret"></span> </a> 
          <ul class="dropdown-menu">
            <?php 
                // Display links based upon the login status:
                if ($user) {
                  echo '<li><a href="logout.php" title="Logout">Logout</a></li>
                <li><a href="change_password.php" title="Change Your Password">Change Password</a></li>
                ';}
                  // Add links if the user is an administrator:
                  if ($user && $user->isAdmin()) {
                    echo '<li role="separator" class="divider"></li>
                    <li><a href="view_users.php" title="View All Users">View Users</a></li>
                  <li><a href="add_page.php">Add a Page</a></li>
                  ';
                } elseif (!$user){ //  Not logged in.
                  echo '<li><a href="register.php" title="Register for the Site">Register</a></li>
                <li><a href="forgot_password.php" title="Password Retrieval">Retrieve Password</a></li>
                <li><a href="login.php" title="Login">Log in</a></li>
                ';
                }
                ?>
            
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>
    


      <div class="container">
        <div class="row-fluid">
          <div class="col-md-3">
            <img src="assets/img/ed-connolly-LOGO-01.png" alt="" />
          </div>
        </div>
      </div>

</header>



  <div class="container-fluid end">
  <div class="container realHdr">
  <nav class="nav navbar-inverse">
     <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#naCol" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
        </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="naCol">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            
            <li><a href="#">Another action</a></li>
            <?php if ($user && $user->canCreatePage()) echo '<li><a href="add_page.php">Add a New Page</a></li>'; ?>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <?php 
                if (!$user) { //  Not logged in.
                  echo '<li><a href="register.php" title="Register for the Site">Register</a></li>
                <li><a href="forgot_password.php" title="Password Retrieval">Retrieve Password</a></li>
                ';
                }
                ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php if ($user) {
  echo '<span>' . $user->getUserName() . '</span>';} else { //  Not logged in.
                  echo '<li><a href="login.php" title="Login">Log in</a></li>';
                }
                ?>
 <span class="caret"></span> </a> 
          <ul class="dropdown-menu">
            <?php 
                // Display links based upon the login status:
                if ($user) {
                  echo '<li><a href="logout.php" title="Logout">Logout</a></li>
                <li><a href="change_password.php" title="Change Your Password">Change Password</a></li>
                ';}
                  // Add links if the user is an administrator:
                  if ($user && $user->isAdmin()) {
                    echo '<li role="separator" class="divider"></li>
                    <li><a href="view_users.php" title="View All Users">View Users</a></li>
                  <li><a href="add_page.php">Add a Page</a></li>
                  ';
                } elseif (!$user) { //  Not logged in.
                  echo '<li><a href="register.php" title="Register for the Site">Register</a></li>
                <li><a href="forgot_password.php" title="Password Retrieval">Retrieve Password</a></li>
                <li><a href="login.php" title="Login">Log in</a></li>
                ';
                }
                ?>
            
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>
</div>

<div class="container-fluid end1">
  <div class="container realHdr1">
  <nav class="nav navbar-inverse1">
     <div class="container">
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="index.php">Home</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>
</div>

<div class="jquery-script-clear"></div>
<div class="container-fluid edgeC">

<div class="container">





