<?php 
	require('MongoConfig.php');


	$content=$_POST['content'];
	
	$bulk->insert(['content' =>$content]);
	$result = $manager->executeBulkWrite('message.message_one', $bulk);

	$affectLineSum = $result->getInsertedCount();
	
	$res=[];

	if($affectLineSum>0){
	    $res['status']='success';
	    echo json_encode($res);
	} else {
	   	$res['status']='error';
	   	echo json_encode($res);
	}
 ?>