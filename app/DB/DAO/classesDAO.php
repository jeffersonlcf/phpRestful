<?php
/**
 * @author Jefferson
 * definition of the User DAO (database access object)
 */
class classesDAO {
	private $dbManager;
	function classesDAO($DBMngr) {
		$this->dbManager = $DBMngr;
	}
		
	function getListOfClasses() {
			
		$sql = "SELECT c.title, TIMESTAMPDIFF(MINUTE,activation_date,c.deactivation_date) as lenght ";
		$sql .= "FROM classes c ";
		$sql .= "ORDER BY 1; ";
		
		//Prepare Statement
		$stmt = $this->dbManager->prepareQuery($sql);
		//Execute Query
		$this->dbManager->executeQuery($stmt);
		//Fetch the Results
		$arrayOfResults = $this->dbManager->fetchResults($stmt);
		
		return $arrayOfResults;
	}
	
	function getClass($id) {
			
		$sql = "SELECT * ";
		$sql .= "FROM classes c ";
		$sql .= "WHERE LOWER(c.classID) = ?";

		
		//Prepare Statement
		$stmt = $this->dbManager->prepareQuery($sql);
		// bind parameters
		$stmt->bindParam(1, $id);
		//Execute Query
		$this->dbManager->executeQuery($stmt);
		//Fetch the Results
		$arrayOfResults = $this->dbManager->fetchResults($stmt);
		
		return $arrayOfResults;
	}	
}
?>
