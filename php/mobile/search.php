<?php
    require('comm.php');
//错误情况下的输出
$err=json_encode(array('msg'=>'参数错误.','success'=>'0'));
$typemap=array('02'=>'title','03'=>'author','05'=>'isbn');
//
try{
    if(isset($_REQUEST)&&array_key_exists('grp',$_REQUEST) && array_key_exists('q',$_REQUEST) && array_key_exists('start',$_REQUEST) && array_key_exists($_REQUEST['grp'],$typemap))
{
	$data=getHttp(sprintf('/opac/openlink.php?doctype=ALL&match_flag=any&sort=CATA_DATE&orderby=desc&showmode=list&dept=ALL&strSearchType=%s&strText=%s&&displaypg=20&page=%d',$typemap[$_REQUEST['grp']],urlencode($_REQUEST['q']),(intval($_REQUEST['start'])/20+1)));
    preg_match_all('/FF">(\d+)[^?]+[?]marc_no=(\d*)">([^<]*)[^&]+([^<]+)[^&]+([^<]+)[^&]+([^<]+)[^b]+[^>]+[>]([^<]+)/i',$data,$matchs,PREG_SET_ORDER);
    $books=array();
    if(intval($start)<=$matchs[0][1]){
    $i=0;
    foreach($matchs as $match)
    {
        for($i=2;$i<count($match);$i++){
            $match[$i]=html_entity_decode($match[$i],ENT_COMPAT,'UTF-8');
        }
        preg_match('/([^\d]*)(.*)/i',$match[5],$split);
        array_push($books,array('marc_rec_no'=>$match[2],'title'=>$match[3],'author'=>$match[4],
                   'publisher'=>$split[1],'pub_year'=>$split[2],'call_no'=>$match[6],
                   'doc_type_name'=>$match[7],'num'=>$start+($i++),'lend_num'=>0,'total_num'=>0));
    }}
    echo json_encode(array('success'=>'1','books'=>$books,'count'=>count($matchs)));
}
  else  throw new Exception();
}
catch(Exception $e){echo $err;}

 ?>