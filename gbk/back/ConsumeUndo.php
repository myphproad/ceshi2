<?php
header ( 'Content-type:text/html;charset=GBK' );
 include_once '../func/common.php';
include_once '../func/SDKConfig.php';
include_once '../func/secureUtil.php';
include_once '../func/encryptParams.php';
include_once '../func/httpClient.php';
include_once '../func/log.class.php';

/**
 *	消费撤销
 */


/**
 *	以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己需要，按照技术文档编写。该代码仅供参考
 */

// 初始化日志
$log = new PhpLog ( SDK_LOG_FILE_PATH, "PRC", SDK_LOG_LEVEL );
$log->LogInfo ( "===========处理后台请求开始============" );

$params = array(
		'version' => '5.0.0',			//版本号
		'encoding' => 'GBK',				//编码方式
		'certId' => getSignCertId (),	//证书ID	
		'signMethod' => '01',		//签名方法
		'txnType' => '31',					//交易类型	
		'txnSubType' => '00',				//交易子类
		'bizType' => '000000',			//业务类型
		'channelType' => '07',				//渠道类型
		'accessType' => '0',				//接入类型
		'channelType' => '07',					//渠道类型
		'orderId' => date('YmdHis'),			//商户订单号
		'merId' => '898340183980105',			//商户代码
		'accNo' => '9555542160000001',			//账号
		'txnTime' => date('YmdHis'),				//订单发送时间

		//固定填写
		'version'=> '5.0.0',//版本号--M
		//默认取值：UTF-8
		'encoding'=> 'GBK',//编码方式--M
		//通过MPI插件获取
		'certId'=> getSignCertId (),//证书ID--M
		//01RSA02 MD5 (暂不支持)
		'signMethod'=> '01',//签名方法--M
		//取值：31
		'txnType'=> '31',//交易类型--M
		//默认:00
		'txnSubType'=> '00',//交易子类--M
		'bizType'=> '000000',//产品类型--M
		'channelType'=> '07',//渠道类型--M
		//后台返回商户结果时使用，如上送，则发送商户后台交易结果通知
		'backUrl'=> SDK_BACK_TRANS_URL,//后台通知地址--M
		//0：普通商户直连接入2：平台类商户接入
		'accessType'=> '0',//接入类型--M
		//　
		'merId'=> '898340183980105',//商户代码--M
		//商户类型为平台类商户接入时必须上送
		'subMerId'=> '',//二级商户代码--C
		//商户类型为平台类商户接入时必须上送
		'subMerName'=> '',//二级商户全称--C
		//商户类型为平台类商户接入时必须上送
		'subMerAbbr'=> '',//二级商户简称--C
		//消费撤销的订单号，由商户生成
		'orderId'=> date('YmdHis'),//商户订单号--M
		//原始交易的queryId
		'origQryId'=> 'origQryId',//原始交易流水号--M
		//　
		'txnTime'=> date('YmdHis'),//订单发送时间--M
		//与原始消费交易一致
		'txnAmt'=> '1',//交易金额--M
		//　
		'termId'=> '',//终端号--O
		//商户自定义保留域，交易应答时会原样返回
		'reqReserved'=> '',//请求方保留域--O
		//格式如下：{子域名1=值&子域名2=值&子域名3=值} 移动支付参考消费
		'reserved'=> '',//保留域--O
		//渠道类型为语音支付时使用用法见VPC交易信息组合域子域用法
		'vpcTransData'=> '',//VPC交易信息域--C
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
