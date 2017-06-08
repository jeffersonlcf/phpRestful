<?php
require_once "../Slim/Slim.php";
Slim\Slim::registerAutoloader ();
$app = new \Slim\Slim (); // slim run-time object
require_once "conf/config.inc.php"; // include configuration file

require('DB/dbManager/pdoDbManager.php');
require('DB/DAO/usersDAO.php');
require('DB/DAO/classesDAO.php');
require('DB/DAO/studentsDAO.php');
require('DB/DAO/answersDAO.php');

require('util/util.php');

require_once('Controller.php');
require_once('View.php');
require_once('Model.php');

function authenticate(\Slim\Route $route){
	
	$app = \Slim\Slim::getInstance ();
	
	$headers = $app->request->headers; /// Get request headers as associative array
	
	$action = "ACTION_AUTHENTICATE";
	$params = array("user"=>$headers['user'],"pass"=>$headers['pass']);
	
	$model = new Model(); 
	$controller = new Controller($model,$action,$params);
	$view = new View($model,$controller); 
	
	if(!($view->getOutput())){
		$app->halt(401);
	}else{
		return true; 
	}
};

$app->map ( "/classes(/:id(/:route(/:id2(/:route2))))", "authenticate", function ($id = null,$route = NULL,$id2 = NULL,$route2 = NULL) use($app) {
	
	$headers = $app->request->headers();
	$format   = strtoupper($headers['format']);
	$httpMethod = $app->request->getMethod();
	$action = null;
	
	$util = new util();
	//Convert to lower case (Pass by Reference)
	$util->toLowerCase($id, $route, $id2, $route2);
	
	switch ($httpMethod) {
		case "GET" :	
			if (empty($id) && empty($route)){
				// R1: classes
				$action = "ACTION_GET_ALL_CLASSES";
			}else if (!empty($id) && empty($route)){
				// R2: classes/ID
				$action = "ACTION_GET_CLASSE";
			}else if ($route==ROUTE_STUDENT && empty($id2) && empty($route2)){
				// R3: classes/ID/students
				$action = "ACTION_GET_STUDENTS";
			}else if ($route==ROUTE_STUDENT && !empty($id2) && empty($route2)){
				// R4: classes/ID1/students/ID2
				$action = "ACTION_GET_ANSWERS";
			}else if ($route==ROUTE_STUDENT && !empty($route2) && $route2==ROUTE_AVERAGE){
				// R5: classes/ID1/students/ID2/avg
				$action = "ACTION_GET_STUDENTS_AVERAGE";
			}else if ($route==ROUTE_STUDENT && !empty($route2) && $route2==ROUTE_STANDAR){
				// R6: classes/ID1/students/ID2/std
				$action = "ACTION_GET_STUDENTS_STANDARD";
			}else if ($route==ROUTE_ANSWERS && !empty($route2) && $route2==ROUTE_AVERAGE){
				// R7: classes/ID1/answers/ID2/avg
				$action = "ACTION_GET_ANSWERS_AVERAGE_QUESTION";
			}else if ($route==ROUTE_ANSWERS && !empty($route2) && $route2==ROUTE_STANDAR){
				// R8: classes/ID1/answers/ID2/std
				$action = "ACTION_GET_ANSWERS_STANDARD_QUESTION";
			}else if ($route==ROUTE_ANSWERS && $id2==ROUTE_AVERAGE && empty($route2)){
				// R9: classes/ID1/answers/avg
				$action = "ACTION_GET_ANSWERS_AVERAGE_CLASS";
			}
			break;
		/*
		case "POST" :
			$action = "ACTION_POST_USER";
			break;
		case "PUT" :
			$action = "ACTION_PUT_USER";
			break;
		case "DELETE" :
			$action = "ACTION_DELETE_USER";
			break;
	*/		
	}
	
	$params = array("id"=>$id,"id2"=>$id2);
	
	$model = new Model(); 
	$controller = new Controller($model,$action,$params); 
	$view = new View($model,$controller);
	
	$responseBody = $view->getOutput();
	$responseCode = $view->getStatus();

	if ($responseBody != null){
		//return JSON
		if (empty($format) || $format=="JSON"){
			$app->response->write ( json_encode ( $responseBody ) );
		//return XML 
		}else if ($format == "XML"){
			// creating object of SimpleXMLElement
			$xmlData = new SimpleXMLElement('<?xml version="1.0"?><data></data>');
			// function call to convert array to xml
			$util->arrayToXML($responseBody,$xmlData);
			$app->response->write($xmlData->asXML());
		}
	}
	
	header($responseCode);
	$app->response->status ( $responseCode );
	

})->via ("GET");

$app->run();

?>