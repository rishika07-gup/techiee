<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.html');
	exit;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>User</title>
    <link rel="stylesheet" href="./assets/css/home1.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
  </head>
  <body>
    <header>
      <div class="container">
        <div class="header-left">
          <p class="logo"></p>
          <a href="note.php" class="notification"><i class="fa fa-bell" style="font-size:24px"></i></a>
        </div>
        <div class="header-right">
         <a href="logout.php" class="admin">Logout</a>
          <a href="lostobj.php" class="login">lostobjectform</a>
          <a href="afterlogin.php" class="home">Home</a>
          <a href="profile.php" class="profile"><i class='fas fa-user-circle' style='font-size:24px'></i></a>
        </div>
      </div>
    </header>
    <div class="top-wrapper">
      <div class="container">
        <p>Welcome back, <?=$_SESSION['id']?>!</p>
      </div>
    </div>
        
    <div class="lesson-icon">
    <p>Lost object? Please fill the lostobject form present at the top.</p>
    </div> 
  </body>
</html>
