<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the object ID exists
if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM lostobj WHERE lostobj_id = ?');
    $stmt->execute([$_GET['id']]);
    $lost = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$lost) {
        exit('object doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM lostobj WHERE lostobj_id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have deleted the object!';
            header('Location: read1.php');
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: read1.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>
<?=template_header('Delete1')?>

<div class="content- delete">
	<h2>Delete Object #<?=$lost['lostobj_id']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete object #<?=$lost['lostobj_id']?>?</p>
    <div class="yesno">
        <a href="delete1.php?id=<?=$lost['lostobj_id']?>&confirm=yes">Yes</a>
        <a href="delete1.php?id=<?=$lost['lostobj_id']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>