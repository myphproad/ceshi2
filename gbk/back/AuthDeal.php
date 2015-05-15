<?php
header ( 'Content-type:text/html;charset=GBK' );
include_once '../func/common.php';
include_once '../func/SDKConfig.php';
include_once '../func/secureUtil.php';
include_once '../func/encryptParams.php';
include_once '../func/httpClient.php';
include_once '../func/log.class.php';

/**
 * 预授权交易
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
			'certId'=> getSignCertId(),//证书ID--M
			//01RSA02 MD5 (暂不支持)
			'signMethod'=> '01',//签名方法--M
			//取值：02
			'txnType'=> '02',//交易类型--M
			//01：预授权通过地址区分前台与后台交易
			'txnSubType'=> '01',//交易子类--M
			'bizType'=> '000000',//产品类型--M
			'channelType'=> '07',//渠道类型--M
			//后台返回商户结果时使用，如上送，则发送商户后台交易结果通知
			'backUrl'=> SDK_BACK_TRANS_URL,//后台通知地址--M
			//0：普通商户直连接入2：平台类商户接入
			'accessType'=> '0',//接入类型--M
			//　
			'merId'=> '898340183980105',//商户代码--M
			//商户类型为平台类商户接入时必须上送
//			'subMerId'=> '',//二级商户代码--C
//			//商户类型为平台类商户接入时必须上送
//			'subMerName'=> '',//二级商户全称--C
//			//商户类型为平台类商户接入时必须上送
//			'subMerAbbr'=> '',//二级商户简称--C
			//预授权的订单号，由商户生成
			'orderId'=> date('YmdHis'),//商户订单号--M
			//　
			'txnTime'=> date('YmdHis'),//订单发送时间--M
			//后台类交易且卡号上送；跨行收单且收单机构收集银行卡信息时上送01：银行卡02：存折03：C卡默认取值：01取值“03”表示以IC终端发起的IC卡交易，IC作为普通银行卡进行支付时，此域填写为“01”
			'accType'=> '01',//帐号类型--C
			//1、  后台类消费交易时上送全卡号或卡号后4位 2、  跨行收单且收单机构收集银行卡信息时上送、  3、前台类交易可通过配置后返回，卡号可选上送
			'accNo'=> '88888',//帐号--C
			'txnAmt'=> '1',//交易金额--M
			//默认为156交易 参考公参
			'currencyCode'=> '156',//交易币种--M
//			//1、后台类消费交易时上送2、跨行收单且收单机构收集银行卡信息时上送3、认证支付2.0，后台交易时可选Key=value格式（具体填写参考数据元说明）
//			'customerInfo'=> customerInfo(),//银行卡验证信息及身份信息--C
//			//　
//			'termId'=> '',//终端号--O
//			//商户自定义保留域，交易应答时会原样返回
//			'reqReserved'=> '',//请求方保留域--O
//			//格式如下：{子域名1=值&子域名2=值&子域名3=值} 移动支付参考消费
//			'reserved'=> '',//保留域--O
//			//格式如下：{子域名1=值&子域名2=值&子域名3=值}
//			'riskRateInfo'=> '',//风险信息域--O
//			//当使用银联公钥加密密码等信息时，需上送加密证书的CertID；说明一下？目前商户、机构、页面统一套
//			'encryptCertId'=> '',//加密证书ID--C
//			//分期付款交易，商户端选择分期信息时，需上送 组合域，填法见数据元说明
//			'instalTransInfo'=> '',//分期付款信息域--C
//			//C当帐号类型为02-存折时需填写在前台类交易时填写默认银行代码，支持直接跳转到网银商户发卡银行控制系统应答返回
//			'issInsCode'=> '',//发卡机构代码--O
//			//移动支付业务需要上送
//			'userMac'=> '',//终端信息域--O
//			//有卡交易必填有卡交易信息域
//			'cardTransData'=> '',//有卡交易信息域--C
//			//渠道类型为语音支付时使用用法见VPC交易信息组合域子域用法
//			'vpcTransData'=> '',//VPC交易信息域--C
//			//移动支付上送
//			'orderDesc'=> '',//订单描述--C

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
