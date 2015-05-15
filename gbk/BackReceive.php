<?php
header ( 'Content-type:text/html;charset=GBK' );
include_once '/func/common.php';
include_once '/func/SDKConfig.php';
include_once '/func/secureUtil.php';
include_once '/func/encryptParams.php';
include_once '/func/httpClient.php';
include_once '/func/log.class.php';


// 初始化日志
$log = new PhpLog ( SDK_LOG_FILE_PATH, "PRC", SDK_LOG_LEVEL );
$log->LogInfo ( "===========处理后台请求开始============" );




$params=$_POST['flags'];

 foreach($params as $key=>$val){
 echo $val,'<br />';
}
$ar=$_POST['arr'];

foreach($ar as $key=>$val){
	echo $key,$val,'<br />';
}
// 检查字段是否需要加密
encrypt_params ( $ar );
//echo $params;
// 签名
sign ( $params );

$log->LogInfo ( "后台请求地址为>" . SDK_BACK_TRANS_URL );
//发送信息到后台
$result = sendHttpRequest ( $params, SDK_BACK_TRANS_URL );
$log->LogInfo ( "后台返回结果为>" . $result );

//返回结果展示
$result_arr = coverStringToArray ( $result );
$html = create_html ( $result_arr, SDK_BACK_NOTIFY_URL );
echo $html;
?>

