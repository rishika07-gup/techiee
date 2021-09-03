<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.html');
	exit;
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'lost and found1 management';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT pass_word,f_name,l_name FROM user WHERE userid = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('s', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($pass_word,$f_name,$l_name);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Profile</title>
    <link rel="stylesheet" href="./assets/css/profile.css">
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
    <div class="content">
			<h2>Profile</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Userid:</td>
						<td><?=$_SESSION['id']?></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><?=$pass_word?></td>
					</tr>
					<tr>
						<td>Firstname:</td>
						<td><?=$f_name?></td>
                    </tr>
                    <tr>
						<td>Lastname:</td>
						<td><?=$l_name?></td>
					</tr>
				</table>
			</div>
		</div>
</body>
</html>