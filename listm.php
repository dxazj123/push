<?php 
	require('MongoConfig.php');


	$page=$_GET['page'];
	$limit=$_GET['limit'];

	$filter = [];
	$skip=($page-1)*$limit;
	$options = [
	    'projection' => ['_id' => 1,'content'=>1],
	    'sort' => ['content' => -1],
	    'skip'=>$skip,
	    'limit'=>$limit
	];

	//创建查询语句用的条件及字段过滤选项
	$query = new MongoDB\Driver\Query($filter,$options);
	//创建查询对象


	$command = new MongoDB\Driver\Command(['count' => 'message_one','query'=>[]]);
  	$result = $manager->executeCommand('message',$command);
  	$res = $result->toArray();
  	$cnt = 0;
  	if ($res) {
    
     	$cnt = $res[0]->n;
  	}


	$cursor = $manager->executeQuery('message.message_one', $query)->toArray();

	$info=[];
	$data=[];
	// 执行查询语句
	if(count($cursor)>0){

		foreach ($cursor as $key => $value) {
			 $doc = (array)$value;
			 $doc['id']=(string)$doc['_id'];
			 $info[]=$doc;
		}
		$data['code']=0;
		$data['msg']='success';
		$data['count']=$cnt;
		$data['data']=$info;
		echo json_encode($data);
	}else{
		$data['code']=1;
		$data['msg']='暂无数据';
		$data['count']=0;
		$data['data']=[];
		echo json_encode($data);
	}
	
 ?>