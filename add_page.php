<?php
require ('includes/config.inc.php');

if (!$user->canCreatePage()) {
	header("Location:index.php");
	exit;
}

set_include_path(get_include_path() . PATH_SEPARATOR . '/HTML/QuickForm2.php/');
require('HTML/QuickForm2.php');
/*require(MYSQL);*/
$form = new HTML_QuickForm2('addPageForm');

$title = $form->addElement('text', 'Title');
$title->setLabel('Page Title');
$title->addFilter('strip_tags');
$title->addRule('required', 'Please enter a page title');

$content = $form->addElement('textarea', 'content');
$content->setLabel('Page Content');
$content->addFilter('trim');
$content->addRule('required', 'Please enter page content');

$submit = $form->addElement('submit', 'submit', array('value'=>'Add This Page'));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($form->validate()) {

	$q = 'INSERT INTO pages (creatorId, title, content, dateAdded) VALUES (:creatorId, :title, :content,NOW())';
	$stmt = $pdo->prepare($q);
	$r = $stmt->execute(array(':creatorId' => $user->getId(), ':title' => $title->getValue(), ':content' => $content->getValue()));

	if ($r) {
		$form->toggleFrozen(true);
		$form->removeChild($submit);
	}
  }
}


$pageTitle = 'Add a Page';
include('includes/header.inc.php');
include('views/add_page.html');
include('includes/footer.inc.php');

?>