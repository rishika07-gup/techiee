<?php
include 'function3.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) ? $_POST['id'] : NULL;
    $userid = isset($_POST['userid']) ? $_POST['userid'] :'';
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $date = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d ');
    $brand = isset($_POST['brand']) ? $_POST['brand'] : '';
    $color = isset($_POST['color']) ? $_POST['color'] : '';
    $location = isset($_POST['location']) ? $_POST['location'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';
    // Insert new record into the foundobj table
    $stmt = $pdo->prepare('INSERT INTO lostobj(lostobj_id,lostobj_name,lost_date,l_brand,l_color,lost_loc,status1) VALUES (?, ?, ?, ?, ?, ?,?)');
    $stmt->execute([$id, $name,$date, $brand, $color, $location,$status]);
    $userid = isset($_POST['userid']) ? $_POST['userid'] :'';
    $id = isset($_POST['id']) ? $_POST['id'] : NULL;
    $stmt1 = $pdo->prepare('INSERT INTO user_lostobj(userid,lostobj_id) VALUES (?, ?)');
    $stmt1->execute([$userid,$id]);
    // Output message
    $msg = 'Created Successfully!';
    
}
?>
<?=template_header('Create')?>

<div class="content update">
	<h2>Create Record</h2>
    <form action="lostobj.php" method="post">
        <label for="userid">userID</label>
        <input type="text" name="userid" placeholder="---" id="userid">
        <label for="id">ID</label>
        <input type="text" name="id" placeholder="26"  id="id">
        <label for="name">Name</label>
        <input type="text" name="name" placeholder="pencil" id="name">
        <label for="date">Date</label>
        <input type="date" name="date" value="<?=date('Y-m-d')?>" id="date">
        <label for="brand">Brand</label>
        <input type="text" name="brand" placeholder="cello" id="brand">
        <label for="color">Color</label>
        <input type="text" name="color" placeholder="red" id="color">
        <label for="location">Location</label>
        <input type="text" name="location" placeholder="location" id="location">
        <label for="status">Status</label>
        <input type="text" name="status" placeholder="status (0or 1)" id="status">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
