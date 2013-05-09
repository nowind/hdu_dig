<?php
require('comm.php');
	$err=json_encode(array('msg'=>'参数错误.','success'=>'0'));
	try{
		if(isset($_REQUEST)&&array_key_exists('token',$_REQUEST)&&array_key_exists('id',$_REQUEST) )//&& array_key_exists('barcode',$_REQUEST))
		{
			//$h=array('http'=>array('method'=>'GET','header'=>"Cookie: PHPSESSID=".$_REQUEST['token']."\r\n"));
			$data=getHttp("/opac/book_review_del.php?marc_no=$_REQUEST[id]&certId=$_REQUEST[token]",$_REQUEST['token']);
			//var_dump($data);
			echo json_encode(array('msg'=>'删除成功','success'=>'1'));
		}
		else throw new Exception();
	}
	catch(Exception $e){echo $e->getMessage();echo $err;}
?>