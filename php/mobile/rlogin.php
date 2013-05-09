<?php
	//var_dump(error_reporting(E_ALL|E_STRICT));
	require('comm.php');
    $err=json_encode(array('msg'=>'参数错误.','success'=>'0'));
    $err1=json_encode(array('msg'=>'用户密码错误.','success'=>'0'));
    $typemap=array('1'=>'cert_no','2'=>'bar_no','3'=>'email');
    try{
if(isset($_REQUEST)&&array_key_exists('passwd',$_REQUEST)&&array_key_exists('name',$_REQUEST)&&array_key_exists('type',$_REQUEST)&&array_key_exists($_REQUEST['type'],$typemap))
    {
        $cookie=$_REQUEST['name'];
        $ch=getHttp('/reader/redr_verify.php?'.sprintf('select=%s&number=%s&passwd=%s&returnUrl=',$typemap[$_REQUEST['type']],$_REQUEST['name'],$_REQUEST['passwd']),$cookie);
        $data=getHttp('/reader/book_lst.php',$cookie);
        preg_match('/height="11" \/> ([^ ]+)/i',$data,$name);
        preg_match_all('/class="blue">(\d+)/i',$data,$lend,PREG_SET_ORDER);
            if(count($name)<1||count($lend)<1)throw new Exception('读取个人信息失败');
            $ret=array('success'=>'1','token'=>$cookie,'name'=>$name[1],'max_lend_qty'=>intval($lend[1][1]));
            echo json_encode($ret);
            
       // }
    }
    else  throw new Exception();
    }
    catch(Exception $e){//var_dump($e->getMessage());
    echo $err;}
?>