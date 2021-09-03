<?php
include 'functions1.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 6;
// Prepare the SQL statement and get records from our foundobj table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM foundobj ORDER BY foundobj_id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$founds = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of objects, this is so we can determine whether there should be a next and previous button
$num_found = $pdo->query('SELECT COUNT(*) FROM foundobj')->fetchColumn();
?>
<?=template_header('Read')?>

<div class="content read">
	<h2>Found objects</h2>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Name</td>
                <td>Date</td>
                <td>Brand</td>
                <td>Color</td>
                <td>Location</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($founds as $found): ?>
            <tr>
                <td><?=$found['foundobj_id']?></td>
                <td><?=$found['foundobj_name']?></td>
                <td><?=$found['found_date']?></td>
                <td><?=$found['f_brand']?></td>
                <td><?=$found['f_color']?></td>
                <td><?=$found['found_loc']?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read3.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_found): ?>
		<a href="read3.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>