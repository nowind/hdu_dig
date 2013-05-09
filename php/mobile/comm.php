<?php
    function getHttp($url,$sess=null){
		$myServer='http://210.32.33.91:8080';
    	$ch=curl_init($myServer.$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        if(!empty($sess))curl_setopt($ch,CURLOPT_COOKIE,"PHPSESSID=".$sess);
		$ret=curl_exec($ch);
		curl_close($ch);
        return $ret;
    };
 ?>