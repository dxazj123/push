<?php 
	require('MongoConfig.php');

	$id=$_POST['id'];

	$content=$_POST['content'];


	$id=new MongoDB\BSON\ObjectId($id);

	$bulk->update(['_id'=>$id],['$set'=>['content'=>$content]], ['multi' => true, 'upsert' =>false]);
	//创建更新语句
	$result=$manager->executeBulkWrite('message.message_one', $bulk, $writeConcern);
	$affectLineSum=$result->getModifiedCount();
	$data=[];
    if($affectLineSum){
    	$data['status']='success';
    	echo json_encode($data);
    }else{
    	$data['status']='error';
    	echo json_encode($data);
    }
    exit;
 ?>