<?php
require('comm.php');
	$err=json_encode(array('msg'=>'参数错误.','success'=>'0'));
	try{
		if(isset($_REQUEST)&&array_key_exists('token',$_REQUEST) )//&& array_key_exists('barcode',$_REQUEST))
		{
			//$h=array('http'=>array('method'=>'GET','header'=>"Cookie: PHPSESSID=".$_REQUEST['token']."\r\n"));
			$data=getHttp('/reader/book_lst.php',$_REQUEST['token']);
			//var_dump($data);
			preg_match_all('/10%">(\d+)[^?]+\?marc_no=(\d+)">([^<]+)[^&]+([^<]+)[^%]+%">([^<]+)[^2]+([^ ]+)[^%]+%[^%]/i',$data,$all,PREG_SET_ORDER);
			//var_dump($all);
			$books=array();
			foreach($all as $i)
			{
							for($j=1;$j<count($i);$j++){
            	$i[$j]=html_entity_decode($i[$j],ENT_COMPAT,'UTF-8');
        		}
				array_push($books,array('barcode'=>$i[1],'marc_rec_no'=>$i[2],'title'=>$i[3],'author'=>$i[4],
				'lend_date'=>$i[5],'norm_ret_date'=>$i[6],'location'=>$i[7]));
			}
			echo json_encode(array('lend'=>$books,'success'=>'1'));
		}
		else throw new Exception();
	}
	catch(Exception $e){echo $e->getMessage();echo $err;}
?>