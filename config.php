<?php 
	header("Content-Type: text/html;charset=utf-8");
	$host="127.0.0.1";
	$prot=3326;
	$dbname="test";
	$username="root";
	$password="root";

	$conn= new mysqli($host,$username,$password,$dbname,$prot);

	if ($conn->connect_error) {
    	die("连接失败: " . $conn->connect_error);
	} 
 	
 	// class mysql_db{  
 	//   	//1.私有的静态属性
 	//   	private static $dbcon = false;  
 	//   	//2.私有的构造方法
 	//   	private function __construct(){
 	//     	$dbconn = @mysql_connect("localhost","root","");
	 // 	    mysql_select_db("test",$dbconn) or die("mysql_connect error");
	 // 	    mysql_query("SET NAMES utf8");
 	//   	}  
 	//   	//3.私有的克隆方法
 	//   	private function __clone() {
	 	  
 	//   	}  
 	//   	//1.公有的静态方法
 	//   	public static function getIntance() { 
	 // 	    if(self::$dbcon==false){    
	 // 	      self::$dbcon=new self;
	 // 	    } 
 	//     	return self::$dbcon;
 	//   	} 
 	// }
  ?>