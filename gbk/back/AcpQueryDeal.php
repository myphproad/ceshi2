<?php
header ( 'Content-type:text/html;charset=GBK' );
include_once '../func/common.php';
include_once '../func/SDKConfig.php';
include_once '../func/secureUtil.php';
include_once '../func/encryptParams.php';
include_once '../func/httpClient.php';
include_once '../func/log.class.php';

/**
 *	6.8　交易状态查询交易
 */

/**
 *	以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己需要，按照技术文档编写。该代码仅供参考
 */


// 初始化日志
$log = new PhpLog ( SDK_LOG_FILE_PATH, "PRC", SDK_LOG_LEVEL );
$log->LogInfo ( "===========处理后台请求开始============" );

$params = array(
		//固定填写
		'version'=> '5.0.0',//版本号--M
		//默认取值：UTF-8
		'encoding'=> 'GBK',//编码方式--M
		//通过MPI插件获取
		'certId'=> getSignCertId (),//证书ID--M
		//01RSA02 MD5 (暂不支持)
		'signMethod'=> '01',//签名方法--M
		//交易类型 00
		'txnType'=> '00',//交易类型--M
		//默认00
		'txnSubType'=> '00',//交易子类--M
		//默认:000000
		'bizType'=> '000000',//产品类型--M
		//0：普通商户直连接入2：平台类商户接入
		'accessType'=> '0',//接入类型--M
		//　
		'merId'=> '898340183980105',//商户代码--M
		//被查询交易的交易时间
		'txnTime'=> date('YmdHis'),//订单发送时间--M
		//被查询交易的订单号
		'orderId'=> date('YmdHis'),//商户订单号--M
		//待查询交易的流水号
		'queryId'=> '',//交易查询流水号--C
		//格式如下：{子域名1=值&子域名2=值&子域名3=值} 子域： origTxnType N2原交易类型余额查询时必送
		'reserved'=> '',//保留域--O
	);

// 检查字段是否需要加密
encrypt_params ( $params );

// 签名
sign ( $params );

$log->LogInfo ( "后台请求地址为>" . SDK_BACK_TRANS_URL );
// 发送信息到后台
$result = sendHttpRequest ( $params, SDK_BACK_TRANS_URL );
$log->LogInfo ( "后台返回结果为>" . $result );

//返回结果展示
$result_arr = coverStringToArray ( $result );
$html = create_html ( $result_arr, SDK_BACK_NOTIFY_URL );
echo $html;
