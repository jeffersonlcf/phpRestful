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

require_once('Controller.php');
require_once('View.php');
require_once('Model.php');

//$app->get ( "/classes/:id", function ($id = null) use($app) {
	//$params = array("id"=>$id,"id2"=>"avg"); //CLC977337C
	$action = "ACTION_GET_ANSWERS_AVERAGE_CLASS";
	$params = array("id"=>"CLC977337C","id2"=>"avg"); //CLC977337C
	
	$model = new Model(); 
	$controller = new Controller($model,$action,$params);
	$view = new View($model,$controller); 
	
	$responseBody = $view->getOutput();
	
	var_dump(json_encode($responseBody));	
//});
//$app->run();
?>


<!DOCTYPE html>
<meta charset="utf-8">
<style>

.bars rect {
  fill: steelblue;
}

.axis text {
  font: 10px sans-serif;
}

.axis path, .axis line {
  fill: none;
  stroke: #000;
  shape-rendering: crispEdges;
}

</style>
<body>

<script src="//d3js.org/d3.v3.min.js"></script>
<script src="histogram-chart.js"></script>
<script>

d3.select("body")
    .datum(irwinHallDistribution(10000, 10))
  .call(histogramChart()
    .bins(d3.scale.linear().ticks(20))
    .tickFormat(d3.format(".02f")));

function irwinHallDistribution(n, m) {
  var distribution = [];
  for (var i = 0; i < n; i++) {
    for (var s = 0, j = 0; j < m; j++) {
      s += Math.random();
    }
    distribution.push(s / m);
  }
  return distribution;
}

</script>