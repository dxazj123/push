<?php 
	// if(!isset($conn)){
	// 	require_once('config.php');
	// }
	// $table=isset($_POST['table'])?$_POST['table']:0;
	// if($table){
	// 	$nowtime=date('Y-m-d H:i:s',time());

	// 	$sql = "SELECT * FROM `message` where start_time<='$nowtime' and end_time>='$nowtime'";
	// 	$sql2 = "SELECT * FROM `message_one`";
	// 	$result = $conn->query($sql);
	// 	$arr=array();
	// 	if ($result->num_rows > 0) {
	// 	    $i=0;
	// 	    while($row = $result->fetch_assoc()) {
	// 			$arr[$i]['content']=$row['content']; 
	// 			$i++;
	//     	}
	// 	}
	// 	$result = $conn->query($sql2);
	// 	$arr2=array();
	// 	if ($result->num_rows > 0) {
	// 	    $i=0;
	// 	    while($row = $result->fetch_assoc()) {
	// 			$arr2[$i]['content']=$row['content']; 
	// 			$i++;
	//     	}
	// 	}
	// 	$arr3=[];
	// 	$arr3[0]=$arr;
	// 	$arr3[1]=$arr2;
	// 	echo json_encode($arr3);
	// 	exit;
	// }
	
	// $timearr=isset($_POST['timearr'])?$_POST['timearr']:0;

	// if($timearr){
	// 	$sql = "SELECT * FROM `message`";
	// 	$result = $conn->query($sql);
	// 	if($result->num_rows > 0){
	// 		$arr=[];
	// 		$i=0;
	// 		$time=time();
	// 		while($row = $result->fetch_assoc()) {
		       
	// 	       $start_time=strtotime($row['start_time']);
	// 	       $end_time=strtotime($row['end_time']);
	// 	       if($start_time>=$time){
	// 	       		$arr[$i]['start_time']=$row['start_time'];
	// 	       		$arr[$i]['content']=$row['content'];
					
	// 	       }
	// 	       $i++;
	// 	    }
		    
	// 	    echo json_encode($arr);
	// 	    $conn->close();
	// 	    exit;
	// 	}
	// }
	// $oddOrEven=isset($_POST['oddOrEven'])?$_POST['oddOrEven']:'';

	// if($oddOrEven!=''){
	// 	if($oddOrEven%2==0){
	// 		$sql = "SELECT * FROM `message_one` ORDER BY RAND() LIMIT 1";
	// 	}else{
	// 		$nowtime=date('Y-m-d H:i:s',time());
	// 		$sql = "SELECT * FROM `message` where start_time<='$nowtime' and end_time>='$nowtime'  ORDER BY RAND() LIMIT 1";
	// 	}
	// 	$result = $conn->query($sql);
	// 	if ($result->num_rows > 0) {
	// 	    $arr=array();
	// 	    while($row = $result->fetch_assoc()) {
	// 			$arr['content']=$row['content']; 
	//     	}
	//     echo json_encode($arr);
	//     $conn->close();
	//     exit;
	// 	}
	// }
	require('MongoConfig.php');

	$table=isset($_POST['table'])?$_POST['table']:0;
	if($table){

		$time=date('Y-m-d H:i:s',time());

		$filter = ['start_time'=>['$lte'=>$time],'end_time'=>['$gte'=>$time]];


		$options = [
		    'projection' => ['_id' => 0,'content'=>1],
		    'sort' => ['content' => -1],
		];
		
		
		//创建查询语句用的条件及字段过滤选项
		$query = new MongoDB\Driver\Query($filter,$options);
		$filter2 = [];
		$options2 = [
		    'projection' => ['_id' => 0,'content'=>1],
		    'sort' => ['content' => -1],
		];
		$query2 = new MongoDB\Driver\Query($filter2,$options2);
		//创建查询对象
		$cursor = $manager->executeQuery('message.message', $query)->toArray();
		$cursor2 = $manager->executeQuery('message.message_one', $query2)->toArray();
		$info=[];
		$info2=[];
		$arr3=[];
		foreach ($cursor as $key => $value) {
			 $doc = (array)$value;
			 $info[]=$doc;
		}

		foreach ($cursor2 as $key => $value) {
			 $doc = (array)$value;
			 $info2[]=$doc;
		}
		$arr3[0]=$info;
		$arr3[1]=$info2;
		echo json_encode($arr3);
	}

	$timearr=isset($_POST['timearr'])?$_POST['timearr']:0;
	if($timearr){
		$time=date('Y-m-d H:i:s',time());

		$filter = ['start_time'=>['$gte'=>$time]];
		$query = new MongoDB\Driver\Query($filter,[]);
		$cursor = $manager->executeQuery('message.message', $query)->toArray();
		if(count($cursor)>0){
			foreach ($cursor as $key => $value) {
				 $doc = (array)$value;
				 $info[$key]['start_time']=$doc['start_time'];
				 $info[$key]['content']=$doc['content'];
			}
			echo json_encode($info);
		}
	}
 ?>