<?php
class View { 
  	private $model;
	private $controller;
	
	public function __construct($model, $controller){
		$this->model = $model;
		$this->controller=$controller;
	}
	
	public function getOutput(){
		return $this->model->getOutput();
	}
	
	public function getStatus(){
		return $this->model->getStatus();
	}
} 
?>