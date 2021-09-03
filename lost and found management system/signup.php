<?php
include 'functions4.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['userid']) ? $_POST['userid'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $fname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
    $lname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
    $phno = isset($_POST['phonenumber']) ? $_POST['phonenumber'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    // Insert new record into the foundobj table
    $stmt = $pdo->prepare('INSERT INTO user(userid,f_name,l_name,pass_word) VALUES (?, ?, ?, ?)');
    $stmt->execute([$id,$fname,$lname,$password]);
    $id = isset($_POST['userid']) ? $_POST['userid'] : NULL;
    $phno = isset($_POST['phonenumber']) ? $_POST['phonenumber'] : '';
    $stmt1 = $pdo->prepare('INSERT INTO user_ph(userid,Phno) VALUES (?, ?)');
    $stmt1->execute([$id,$phno]);
    // Output message
    $msg = ' Account Created Successfully! Please go to login page and login';
    
}
?>
<?=template_header('Signup')?>
<div class="login-wrap">
  
  <div class="login-html">
    <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
    <div class="login-form">
      <form class="sign-up-htm" action="signup.php" method="POST">
        <div class="group">
          <label for="user" class="label">Userid</label>
          <input id="userid" name="userid" type="text" class="input">
        </div>
        <div class="group">
          <label for="firstname" class="label">First Name</label>
          <input id="firstname" name="firstname" type="firstname" class="input" data-type="firstname">
        </div>
        <div class="group">
          <label for="lastname" class="label">Last Name</label>
          <input id="lastname" name="lastname" type="lastname" class="input" data-type="lastname">
        </div>
        <div class="group">
          <label for="pass" class="label">Password</label>
          <input id="password" name="password" type="password" class="input" data-type="password">
        </div>
        <div class="group">
          <label for="phonenumber" class="label">Phone number</label>
          <input id="phonenumber" name="phonenumber" type="phonenumber" class="input">
        </div>
        
        
        <div class="group">
          <input type="submit" class="button" value="Sign Up" name="submit">
        </div>
      </form> 
    </div>
  </div>
</div>


    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>
<div class="footer">
    <a href="home.html">Home</a>
    <a href="read3.php">Found Listings</a>
  </div>

<?=template_footer()?>
