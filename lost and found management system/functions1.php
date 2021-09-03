<?php
function pdo_connect_mysql() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'lost and found1 management';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to database!');
    }
}
function template_header($title) {
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link rel="stylesheet" href="./fopage.css" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        
    
	</head>
    <body>
    <nav class="navtop">
        <div class="search">
        <a href="home.html"><i class="fas fa-home"></i></a>
        </div>
    </nav>
    <footer>
    </footer>

    </body>
    

EOT;
}
function template_footer() {
echo <<<EOT
       
    
</html>
EOT;
}
?>