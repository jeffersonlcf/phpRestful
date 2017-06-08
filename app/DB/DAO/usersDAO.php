<?php
/**
 * @author Jefferson
 * definition of the Answers DAO (database access object)
 */
class usersDAO {
	private $dbManager;
	function answersDAO($DBMngr) {
		$this->dbManager = $DBMngr;
	}
	function auth($user,$pass) {
		if(!($user==AUTH_USER && $pass==AUTH_PASS)){
			return false;
		}else{
			return true;
		}
	}
}