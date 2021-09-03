<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the object ID exists
if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM foundobj WHERE foundobj_id = ?');
    $stmt->execute([$_GET['id']]);
    $found = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$found) {
        exit('object doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM foundobj WHERE foundobj_id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have deleted the object!';
            header('Location: read.php');
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Delete')?>

<div class="content- delete">
	<h2>Delete Object #<?=$found['foundobj_id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete object #<?=$found['foundobj_id']?>?</p>
    <div class="yesno">
        <a href="delete.php?id=<?=$found['foundobj_id']?>&confirm=yes">Yes</a>
        <a href="delete.php?id=<?=$found['foundobj_id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>