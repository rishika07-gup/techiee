<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) ? $_POST['id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $date = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d ');
    $brand = isset($_POST['brand']) ? $_POST['brand'] : '';
    $color = isset($_POST['color']) ? $_POST['color'] : '';
    $location = isset($_POST['location']) ? $_POST['location'] : '';
    // Insert new record into the foundobj table
    $stmt = $pdo->prepare('INSERT INTO foundobj(foundobj_id,foundobj_name,found_date,f_brand,f_color,found_loc) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id, $name,$date, $brand, $color, $location]);
    // Output message
    $msg = 'Created Successfully!';
    
}
?>
<?=template_header('Create')?>

<div class="content update">
	<h2>Create Record</h2>
    <form action="create.php" method="post">
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
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>
