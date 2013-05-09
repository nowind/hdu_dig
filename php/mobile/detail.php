<?php
require('comm.php');
$err=json_encode(array('msg'=>'参数错误.','success'=>'0'));
try{
	if(array_key_exists('id',$_REQUEST))
	{
		$data=getHttp('/opac/item.php?marc_no='.$_REQUEST['id']);
		preg_match('/文献类型：([^<]+)[^\d]+(\d+)/',$data,$type);
		preg_match('/star(\d*)[^\d]+[\d]+/',$data,$score);
		preg_match('/openlink[.]php[?]title=[^&]+([^<]+)[^&]+([^<]+)[^&]+([^,]+),([^<]+)[^&]+([&#x0-9a-f;]+)/',$data,$title);
		preg_match_all('/F"  [>]([^ ]+).+[^>]+>(\d+).+[^>]+.+[^>]+[>]([^<]+).+[^>]+[>]([^<]+).+[^>]+[<> a-zA-Z0-9"=]+([^<]+)/',$data,$books,PREG_SET_ORDER);
		preg_match('/出版发行项:[^&]+(.+)$/',$title[3],$t);
		if(count($t)>0)$title[3]=$t[1];
		if(count($type)<1||count($title)<1||count($score)<1)
		throw new Exception();
		$all=array();
		foreach($books as $book)
		{
			for($j=1;$j<count($book);$j++){
            	$book[$j]=html_entity_decode($book[$j],ENT_COMPAT,'UTF-8');
        		}
			array_push($all,array('call_no'=>$book[1],'barcode'=>$book[2],'campus'=>$book[3],'location'=>$book[4],'book_stat'=>$book[5]));
		}
		for($j=1;$j<count($title);$j++){
            	$title[$j]=html_entity_decode($title[$j],ENT_COMPAT,'UTF-8');
        		}
		$ret=array('doc_type_name'=>$type[1],'lend_times'=>0,'marc_rec_no'=>$_REQUEST['id'],
		'peris'=>array(),'avg_score'=>intval($score[1]),'items'=>$all,'title'=>$title[1],
		'author'=>$title[2],'publisher'=>$title[3],'view_count'=>intval($type[2]),'pub_year'=>$title[4],
		'isbn'=>$title[5],'success'=>'1','toal_person'=>intval($score[2])
		);
		echo json_encode($ret);
	}
else throw new Exception();
}
catch(Exception $e){echo $e->getMessage();echo $err;}

?>