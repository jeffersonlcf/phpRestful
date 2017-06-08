<?php
/**
 * @author Jefferson
 * definition of the Answers DAO (database access object)
 */
class answersDAO {
	private $dbManager;
	function answersDAO($DBMngr) {
		$this->dbManager = $DBMngr;
	}
	function getAnswersAverageQ($id,$id2) {

		$sql = "SELECT AVG(a.answered_value) AS AVERAGE FROM answers a ";
		$sql .= "JOIN questions q ON q.id = a.id_question ";
		$sql .= "JOIN classes c on c.classID = a.classID ";
		$sql .= "WHERE LOWER(c.classID) = ? ";
		$sql .= "and LOWER(q.id) = ?;";
		
		//Prepare Statement
		$stmt = $this->dbManager->prepareQuery($sql);
		// bind parameters
		$stmt->bindParam(1, $id);
		$stmt->bindParam(2, $id2);
		
		//Execute Query
		$this->dbManager->executeQuery($stmt);
		//Fetch the Results
		$arrayOfResults = $this->dbManager->fetchResults($stmt);
		
		return $arrayOfResults;
	}

	function getAnswersStandardQ($id,$id2) {

		$sql = "SELECT STDDEV(a.answered_value) AS STANDARD_DEVIATION FROM answers a ";
		$sql .= "JOIN questions q ON q.id = a.id_question ";
		$sql .= "JOIN classes c on c.classID = a.classID ";
		$sql .= "WHERE LOWER(c.classID) = ? ";
		$sql .= "and LOWER(q.id) = ?;";
		
		//Prepare Statement
		$stmt = $this->dbManager->prepareQuery($sql);
		// bind parameters
		$stmt->bindParam(1, $id);
		$stmt->bindParam(2, $id2);
		
		//Execute Query
		$this->dbManager->executeQuery($stmt);
		//Fetch the Results
		$arrayOfResults = $this->dbManager->fetchResults($stmt);
		
		return $arrayOfResults;
	}
	
	function getAnswersAverageC($id) {

		$sql = "SELECT q.id, AVG(a.answered_value) AS AVERAGE FROM answers a ";
		$sql .= "JOIN questions q ON q.id = a.id_question ";
		$sql .= "JOIN classes c on c.classID = a.classID ";
		$sql .= "WHERE LOWER(c.classID) = ? ";
		$sql .= "GROUP BY q.id;";
		
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