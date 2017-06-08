<?php
class Controller {
    private $model; 
    private $action;
    private $params;

    public function __construct($model, $action, $params) { 
        $this->model = $model;
        $this->action = $action;
        $this->params = $params;
        
        if (array_key_exists('user', $params)) {
        	$user = $params['user'];
        	$pass = $params['pass'];
        }
        
        if (array_key_exists('id', $params)) {
        	$id = $params['id'];
        	$id2 = $params['id2'];
        }
        
        switch ($action){
        	case "ACTION_AUTHENTICATE": 
        		$authentication = $this->model->auth($user,$pass);
        		$this->output($this->model,$authentication);
        		break;
        	case "ACTION_GET_ALL_CLASSES": 
        		$listOfClasses = $this->model->getListOfClasses();
        		$this->output($this->model,$listOfClasses);
        		break;
        	case "ACTION_GET_CLASSE": 
        		$class = $this->model->getClass($id);
        		$this->output($this->model,$class);
        		break;
        	case "ACTION_GET_STUDENTS": 
        		$students = $this->model->getStudentsClass($id);
        		$this->output($this->model,$students);
        		break;
        	case "ACTION_GET_ANSWERS": 
        		$answers = $this->model->getStudentsAnswers($id,$id2);
        		$this->output($this->model,$answers);
        		break;
        	case "ACTION_GET_STUDENTS_AVERAGE": 
        		$average = $this->model->getStudentsAverage($id,$id2);
        		$this->output($this->model,$average);
        		break;
    		case "ACTION_GET_STUDENTS_STANDARD": 
        		$standard = $this->model->getStudentsStandard($id,$id2);
        		$this->output($this->model,$standard);
        		break;
        	case "ACTION_GET_ANSWERS_AVERAGE_QUESTION": 
        		$average = $this->model->getAnswersAverageQ($id,$id2);
        		$this->output($this->model,$average);
        		break;
    		case "ACTION_GET_ANSWERS_STANDARD_QUESTION": 
        		$standard = $this->model->getAnswersStandardQ($id,$id2);
        		$this->output($this->model,$standard);
        		break;
        	case "ACTION_GET_ANSWERS_AVERAGE_CLASS": 
        		$average = $this->model->getAnswersAverageC($id);
        		$this->output($this->model,$average);
        		break;
        	default: $model->setStatus(HTTPSTATUS_BADREQUEST); 
        }
    }
    
    public function output($model,$result){
    	$model->setOutput($result);
        $out = $model->getOutput();
		if ($out==null){
			$model->setStatus(HTTPSTATUS_NOTFOUND);
		} else {
			$model->setStatus(HTTPSTATUS_OK);
		}
    }
}?>