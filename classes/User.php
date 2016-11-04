<?php

class User {
	protected $id = null;
	protected $userType = null;
	protected $firstname = null;
	protected $lastname = null;
	protected $email = null;
	protected $pass = null;
	protected $userLevel = null;
	protected $dateAdded = null;

	function getId() {
	return $this->id;
}
	function getuserType() {
	return $this->userType;
}
	function getFirstName() {
	return $this->firstname;
}
	function getLastName() {
	return $this->lastname;
}
	function isAdmin() {
	return ($this->userType == 'admin');
}
	function canEditPage(Page $p) {
	return ($this->isAdmin() || ($this->id == $page->getCreatorId()));
}
	function canCreatePage() {
	return ($this->isAdmin() || ($this->userType == 'author'));
}

}