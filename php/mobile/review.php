<?php
require('comm.php');
    echo json_encode(array('reviews'=>array(),'success'=>'1'));
	// 审核后才显示 == 没有评论
	/*$err=json_encode(array('msg'=>'参数错误.','success'=>'0'));
	try{
		if(isset($_REQUEST)&&array_key_exists('id',$_REQUEST) )//&& array_key_exists('barcode',$_REQUEST))
		{
			//$h=array('http'=>array('method'=>'GET','header'=>"Cookie: PHPSESSID=".$_REQUEST['token']."\r\n"));
			$data=getHttp('/opac/item.php?marc_no='.$_REQUEST['id']);
			//var_dump($data);
			preg_match_all('/([^>]{0,4})** 发表于[\d\D]*?"([^"]+)[\d\D]*?<z>([^<]+)/i',$data,$all,PREG_SET_ORDER);
			//var_dump($all);
			$reviews=array();
			foreach($all as $i)
			{
				for($j=1;$j<count($i);$j++){
            	$i[$j]=html_entity_decode($i[$j],ENT_COMPAT,'UTF-8');
        		}
				array_push($reviews,array('name'=>$i[1].'**','review'=>trim($i[3]),'review_time'=>trim($i[2])));
			}
			echo json_encode(array('reviews'=>$reviews,'success'=>'1'));
		}
		else throw new Exception();
	}
	catch(Exception $e){echo $e->getMessage();echo $err;}*/
?>