<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $date = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d');
        $brand = isset($_POST['brand']) ? $_POST['brand'] : '';
        $color = isset($_POST['color']) ? $_POST['color'] : '';
        $location = isset($_POST['location']) ? $_POST['location'] : '';
        // Update the record
        $stmt = $pdo->prepare('UPDATE foundobj SET foundobj_id = ?, foundobj_name = ?, found_date = ?, f_brand = ?, f_color = ?, found_loc = ? WHERE foundobj_id = ?');
        $stmt->execute([$id, $name, $date, $brand, $color, $location, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM foundobj WHERE foundobj_id = ?');
    $stmt->execute([$_GET['id']]);
    $found = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$found) {
        exit('object doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Read')?>

<div class="content update">
	<h2>Update object #<?=$found['foundobj_id']?></h2>
    <form action="update.php?id=<?=$found['foundobj_id']?>" method="post">
        <label for="id">ID</label>
        
        <input type="text" name="id" placeholder="1" value="<?=$found['foundobj_id']?>" id="id">
        <label for="name">Name</label>
        <input type="text" name="name" placeholder="ball" value="<?=$found['foundobj_name']?>" id="name">
        <label for="date">Date</label>
        <input type="date" name="date" value="<?=date('Y-m-d', strtotime($found['found_date']))?>" id="date">
        <label for="brand">Brand</label>
        <input type="text" name="brand" placeholder="cello" value="<?=$found['f_brand']?>" id="brand">
        <label for="color">Color</label>
        <input type="text" name="color" placeholder="blue" value="<?=$found['f_color']?>" id="color">
        <label for="location">Location</label>
        <input type="text" name="location" placeholder="cafetaria" value="<?=$found['found_loc']?>" id="location">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>