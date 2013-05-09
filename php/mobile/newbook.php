<?php
//date_default_timezone_set('PRC');
require('comm.php');
$err=json_encode(array('msg'=>'参数错误.','success'=>'0'));
try{
$data=getHttp('/opac/newbook_rss.php?type=cls&s_doctype=01&back_days=2&cls=H&loca_code=ALL&clsname=%26%23x8bed%3B%26%23x8a00%3B%26%23x3001%3B%26%23x6587%3B%26%23x5b57%3B');
	preg_match_all('/item[^t]+title[>]([^<]+)[^=]+[=](\d+)[^&]+([^ ]+)[^&]+([^ ]+)[^&]+([^<]+)/i',$data,$matchs,PREG_SET_ORDER);
	$books=array();
	foreach($matchs as $match)
    {
        for($i=1;$i<count($match);$i++){
            $match[$i]=html_entity_decode($match[$i],ENT_COMPAT,'UTF-8');
        }
        preg_match('/([^\d]*)(.*)/i',$match[5],$split);
        array_push($books,array('marc_rec_no'=>$match[2],'title'=>$match[1],'author'=>$match[3],
                   'publisher'=>$split[1],'pub_year'=>$split[2],'call_no'=>$match[4],
                   'doc_type_name'=>'中文书籍','num'=>0,'lend_num'=>0,'total_num'=>0));
    }
    
	echo json_encode(array('success'=>'1','books'=>$books,'count'=>10,'last_day'=>'0'));
}
catch(Exception $e){echo $err;}
?>
