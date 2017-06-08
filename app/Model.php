<?php
class Model { 
    
	public $outputForView = null;
	public $dbManager = null;
	private $usersDAO = null;
    private $classesDAO = null;
    private $studentsDAO = null;
    private $answersDAO = null;
	private $status = null;
     
    public function __construct() {
    	//Open DB Connection 
        $this->dbManager = new pdoDbManager();
        $this->usersDAO = new usersDAO($this->dbManager);
        $this->classesDAO = new classesDAO($this->dbManager);
        $this->studentsDAO = new studentsDAO($this->dbManager);
        $this->answersDAO = new answersDAO($this->dbManager); 
        $this->dbManager->openConnection();
    }
    
    public function __destruct(){
    	//Close DB Connection
    	$this->dbManager->closeConnection();
    }

    public function setOutput($output){
    	$this->outputForView = $output;
    } 
    
    public function getOutput(){
    	return $this->outputForView;
    }
    
	public function setStatus($status){
		$this->status = $status;
	}
    
	public function getStatus(){
		return $this->status;
	}
	
	public function auth($user,$pass){
		return $this->usersDAO->auth($user,$pass);
	}
    
	public function getListOfClasses(){
		return $this->classesDAO->getListOfClasses();
	}

	public function getClass($id){
		return $this->classesDAO->getClass($id);
	}
	
	public function getStudentsClass($id){
		return $this->studentsDAO->getStudentsClass($id);
	}
	
	public function getStudentsAnswers($id,$id2){
		return $this->studentsDAO->getStudentsAnswers($id,$id2);
	}
	
	public function getStudentsAverage($id,$id2){
		return $this->studentsDAO->getStudentsAverage($id,$id2);
	}
	
	public function getStudentsStandard($id,$id2){
		return $this->studentsDAO->getStudentsStandard($id,$id2);
	}
	
	public function getAnswersAverageQ($id,$id2){
		return $this->answersDAO->getAnswersAverageQ($id,$id2);
	}
	
	public function getAnswersStandardQ($id,$id2){
		return $this->answersDAO->getAnswersStandardQ($id,$id2);
	}
	
	public function getAnswersAverageC($id){
		return $this->answersDAO->getAnswersAverageC($id);
	}
	
}
?>