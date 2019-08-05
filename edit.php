<?php 
	require('MongoConfig.php');

	$id=$_GET['id'];
	

	$id=new MongoDB\BSON\ObjectId($id);

	$filter = ['_id' =>$id];
	$options = [
	    'projection' => ['_id' => 1,'content'=>1,'start_time'=>1,'end_time'=>1],
	    'sort' => ['content' => -1],
	];
	//创建查询语句用的条件及字段过滤选项
	$query = new MongoDB\Driver\Query($filter,$options);
	//创建查询对象
	$cursor = $manager->executeQuery('message.message', $query)->toArray();
	// 执行查询语句
	$info=[];
	foreach ($cursor as $key => $value) {
		 $doc = (array)$value;
		 $doc['_id']=(string)$doc['_id'];
		 $info=$doc;
	}

	echo  json_encode($info);
 ?>
 