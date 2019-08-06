<?php 
	require('MongoConfig.php');


	$content=$_POST['content'];
	$start_time=$_POST['start_time'];
	$end_time=$_POST['end_time'];

	$bulk->insert(['content' =>$content,'start_time'=>$start_time,'end_time'=>$end_time]);
	$result = $manager->executeBulkWrite('message.message', $bulk);

	$affectLineSum = $result->getInsertedCount();
	
	$res=[];

	if($affectLineSum>0){
	    $res['msg']='success';
	    echo json_encode($res);
	} else {
	   	$res['msg']='error';
	   	echo json_encode($res);
	}
 ?>