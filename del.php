<?php 
	require('MongoConfig.php');

	$id=isset($_POST['id'])?$_POST['id']:0;
	$ids=isset($_POST['ids'])?$_POST['ids']:0;
	if($id){
		$id=new MongoDB\BSON\ObjectId($id);
		$bulk->delete(['_id'=>$id],['limit'=>1]);
		$result = $manager->executeBulkWrite('message.message', $bulk, $writeConcern);
	    $affectLineSum = $result->getDeletedCount();
	    $data=[];
	    if($affectLineSum){
	    	$data['msg']='success';
	    	echo json_encode($data);
	    }
	    exit;
	}
	if($ids){
		$idArr=[];
		foreach ($ids as $v) {
			$idArr[]=new MongoDB\BSON\ObjectId($v);
		}
		
		$bulk->delete(['_id'=>['$in'=>$idArr]]);
		$result = $manager->executeBulkWrite('message.message', $bulk, $writeConcern);
	    $affectLineSum = $result->getDeletedCount();
		if($affectLineSum){
			$data['msg']='success';
			echo json_encode($data);
		}
		exit;
	}
 ?>