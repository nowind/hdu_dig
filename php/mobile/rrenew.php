<?php
require('comm.php');
$err=json_encode(array('msg'=>'参数错误.','success'=>'0'));
try{
	if(isset($_REQUEST)&&array_key_exists('token',$_REQUEST) && array_key_exists('barcode',$_REQUEST))
	{
		//$h=array('http'=>array('method'=>'GET','header'=>"Cookie: PHPSESSID=".$_REQUEST['token']."\r\n"));
		$data=getHttp('/reader/ajax_renew.php?bar_code='.$_REQUEST['barcode'],$_REQUEST['token']);
		//preg_match('/red>([^<]+)/',$data,$msg);
		if(stripos($data,'red')!=false)echo json_encode(array('msg'=>'还没到续借时间或超过续借次数.','success'=>'0'));
		else if (stripos($data,'green')!=false) echo json_encode(array('msg'=>'续借成功','success'=>'1'));
		else echo json_encode(array('msg'=>'没有该条码的书','success'=>'0'));
	}
	else throw new Exception();
}
catch(Exception $e){echo $err;}
?>