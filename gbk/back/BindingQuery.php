<?php
header ( 'Content-type:text/html;charset=GBK' );
include_once '../func/common.php';
include_once '../func/SDKConfig.php';
include_once '../func/secureUtil.php';
include_once '../func/encryptParams.php';
include_once '../func/httpClient.php';
include_once '../func/log.class.php';

/**
 * 查询绑定关系
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
		//取值：75
		'txnType'=> '75',//交易类型--M
		//默认：00
		'txnSubType'=> '00',//交易子类--M
		'bizType'=> '000000',//产品类型--M
		'channelType'=> '07',//渠道类型--M
		//0：普通商户直连接入2：平台类商户接入
		'accessType'=> '0',//接入类型--M
		//　
		'merId'=> '898340183980105',//商户代码--M
		//商户类型为平台类商户接入时必须上送
		'subMerId'=> '',//二级商户代码--C
		//商户类型为平台类商户接入时必须上送
		'subMerName'=> '',//二级商户名称--C
		//商户类型为平台类商户接入时必须上送
		'subMerAbbr'=> '',//二级商户简称--C
		//　
		'orderId'=> date('YmdHis'),//商户订单号--M
		//　
		'txnTime'=> date('YmdHis'),//订单发送时间--M
		//用于唯一标识委托关系
		'bindId'=> '',//委托关系标识号--O
		//上送卡号后4位或完整卡号或不送
		'accNo'=> '',//账号--O
		//商户自定义保留域，交易应答时会原样返回
		'reqReserved'=> '',//请求方保留域--O
		//格式如下：{子域名1=值&子域名2=值&子域名3=值} 移动支付参考消费
		'reserved'=> '',//保留域--O
		//格式如下：{子域名1=值&子域名2=值&子域名3=值}有风险级别要求的商户必填 风险级别 {riskLevel=XX}
		'riskRateInfo'=> '',//风险信息域--O
	);

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
?>
