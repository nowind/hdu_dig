<?php
require('comm.php');
	$err=json_encode(array('msg'=>'参数错误.','success'=>'0'));
	try{
		if(isset($_REQUEST)&&array_key_exists('token',$_REQUEST)&&array_key_exists('id',$_REQUEST)&&
			array_key_exists('content',$_REQUEST))//&& array_key_exists('barcode',$_REQUEST))
		{
			//$h=array('http'=>array('method'=>'GET','header'=>"Cookie: PHPSESSID=".$_REQUEST['token']."\r\n"));
			$data=getHttp("/opac/book_review_add.php?marc_no=$_REQUEST[id]&r_content=$_REQUEST[content]",$_REQUEST['token']);
			//var_dump($data);
			echo json_encode(array('msg'=>'评论成功','success'=>'1'));
		}
		else throw new Exception();
	}
	catch(Exception $e){echo $e->getMessage();echo $err;}
?>