<?php 
	
	$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
	//连接mongodb

	$bulk = new MongoDB\Driver\BulkWrite;
	//创建写对象

	$writeConcern   = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 100);
	//创建写安全对象

	//message随机取一条
	$time=date('Y-m-d H:i:s',time());

	$filter = ['start_time'=>['$lte'=>$time],'end_time'=>['$gte'=>$time]];

	// 总记录数
	$command = new MongoDB\Driver\Command(['count' => 'message','query'=>$filter]);
  	$result = $manager->executeCommand('test',$command);
  	$res = $result->toArray();
  	$total = 0;
  	if ($res) {
     	$total = $res[0]->n;
  	}
  	// $total = getCount($manager,'test','message');
	// 随机偏移
	$skip = mt_rand(0, $total-1);

	$options = [
	    'projection' => ['_id' => 0,'content'=>1],
	    'sort' => ['content' => -1],
	    'skip'=>$skip, 
	    'limit'=>1
	];
	//创建查询语句用的条件及字段过滤选项
	$query = new MongoDB\Driver\Query($filter,$options);
	//创建查询对象
	$cursor = $manager->executeQuery('test.message', $query)->toArray();

	$info=[];
	foreach ($cursor as $key => $value) {
		 $doc = (array)$value;
		 $info[]=$doc;
	}
	echo json_encode($info);


	//message_one随机取一条
	// 总记录数
	$command = new MongoDB\Driver\Command(['count' => 'message_one','query'=>[]]);
  	$result = $manager->executeCommand('test',$command);
  	$res = $result->toArray();
  	$total = 0;
  	if ($res) {
     	$total = $res[0]->n;
  	}
  	// $total = getCount($manager,'test','message');
	// 随机偏移
	$skip = mt_rand(0, $total-1);

	$options = [
	    'projection' => ['_id' => 0,'content'=>1],
	    'sort' => ['content' => -1],
	    'skip'=>$skip, 
	    'limit'=>1
	];
	//创建查询语句用的条件及字段过滤选项
	$query = new MongoDB\Driver\Query([],$options);
	//创建查询对象
	$cursor = $manager->executeQuery('test.message', $query)->toArray();

	$info=[];
	foreach ($cursor as $key => $value) {
		 $doc = (array)$value;
		 $info[]=$doc;
	}
	echo json_encode($info);

	//超时器部分
	$time=date('Y-m-d H:i:s',time());

	$filter = ['start_time'=>['$gte'=>$time]];

	$options = [
	    'projection' => ['_id' => 0,'content'=>1,'start_time'=>1],
	    'sort' => ['content' => -1]
	];

	//创建查询语句用的条件及字段过滤选项
	$query = new MongoDB\Driver\Query($filter,$options);
	//创建查询对象
	$cursor = $manager->executeQuery('test.message', $query)->toArray();

	$info=[];
	foreach ($cursor as $key => $value) {
		 $doc = (array)$value;
		 $info[]=$doc;
	}
	echo json_encode($info);
 ?>