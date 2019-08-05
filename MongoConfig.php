<?php 
	$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
	//连接mongodb

	$bulk = new MongoDB\Driver\BulkWrite;
	//创建写对象
	
	$writeConcern   = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 100);
 ?>