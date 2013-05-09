<?php
require('comm.php');
	$err=json_encode(array('msg'=>'参数错误.','success'=>'0'));
	try{
		if(isset($_REQUEST)&&array_key_exists('token',$_REQUEST) )//&& array_key_exists('barcode',$_REQUEST))
		{
			//$h=array('http'=>array('method'=>'GET','header'=>"Cookie: PHPSESSID=".$_REQUEST['token']."\r\n"));
			$rand=rand(0,100);
			$data=getHttp("/reader/book_rv.php?t=$rand",$_REQUEST['token']);
			//var_dump($data);
			preg_match_all('/marc_no=(\d+)">\d+.([^<]+)<.a>[\d\D]*?con">([^<]+)<[\d\D]*?发表于 <.strong>([^<]+)/i',$data,$all,PREG_SET_ORDER);
			//var_dump($all);
			$reviews=array();
			foreach($all as $i)
			{
				for($j=1;$j<count($i);$j++){
            	$i[$j]=html_entity_decode($i[$j],ENT_COMPAT,'UTF-8');
        		}
				array_push($reviews,array('marc_rec_no'=>$i[1],'review'=>trim($i[3]),'title'=>trim($i[2]),'review_time'=>trim($i[4])));
			}
			echo json_encode(array('reviews'=>$reviews,'success'=>'1'));
		}
		else throw new Exception();
	}
	catch(Exception $e){echo $e->getMessage();echo $err;}
?>