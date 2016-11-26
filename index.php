<?php

/*require('includes/utilities.inc.php');*/
require ('includes/config.inc.php');

$pageTitle = 'News Site';
include('includes/header.inc.php');

try {

	$q = 'SELECT id, title, content, DATE_FORMAT(dateAdded, "%e %m %y") AS dateAdded FROM pages ORDER BY dateAdded DESC LIMIT 2';
	$r = $pdo->query($q);

	if ($r && $r->rowCount() > 0) {

		$r->setFetchMode(PDO::FETCH_CLASS, 'Page');

		include('views/index.html');
	} else {
		throw new Exception('No content is available to be viewed at this time');
	}
} catch (Exception $e) {
	include('views/error.html');
}

/*include('includes/footer.inc.php');*/

?>