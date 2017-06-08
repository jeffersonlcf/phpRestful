<?php
/**
 * @author Jefferson
 * definition of the Students DAO (database access object)
 */
class studentsDAO {
	private $dbManager;
	function studentsDAO($DBMngr) {
		$this->dbManager = $DBMngr;
	}

	function getStudentsClass($id) {
			
		$sql = "SELECT u.id_user, u.gender, u.mothertongue ";
		$sql .= "FROM user u ";
		$sql .= "JOIN classes c ON c.classID = u.classID ";
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
	
	function getStudentsAnswers($id,$id2) {

		$sql = "SELECT a.answered_value, ql.desc FROM answers a ";
		$sql .= "JOIN classes c on c.classID = a.classID ";
		$sql .= "JOIN user u on u.id_user = a.id_user ";
		$sql .= "JOIN questions q on q.id = a.id_question ";
		$sql .= "JOIN questions_in_languages ql on ql.idquestion = q.id ";
		$sql .= "WHERE LOWER(c.classID) = ? ";
		$sql .= "and LOWER(u.desc_user) = ?;";
		
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
	
	function getStudentsAverage($id,$id2) {

		$sql = "SELECT AVG(a.answered_value) as AVERAGE FROM answers a ";
		$sql .= "JOIN classes c on c.classID = a.classID ";
		$sql .= "JOIN user u on u.id_user = a.id_user ";
		$sql .= "WHERE LOWER(c.classID) = ? ";
		$sql .= "and LOWER(u.desc_user) = ?;";
		
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
	
	function getStudentsStandard($id,$id2) {

		$sql = "SELECT STDDEV(a.answered_value) as STANDARD_DEVIATION FROM answers a ";
		$sql .= "JOIN classes c on c.classID = a.classID ";
		$sql .= "JOIN user u on u.id_user = a.id_user ";
		$sql .= "WHERE LOWER(c.classID) = ? ";
		$sql .= "and LOWER(u.desc_user) = ?;";
		
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
}
?>
	