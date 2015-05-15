<?php
header ( 'Content-type:text/html;charset=UTF-8' );
include_once '../func/common.php';
include_once '../func/SDKConfig.php';
include_once '../func/secureUtil.php';
include_once '../func/encryptParams.php';
include_once '../func/httpClient.php';
include_once '../func/log.class.php';

//$flag = empty($_GET['flag']) ? 0 : $_GET['flag'];


/**
 * 前台消费交易
 */


/**
 *	以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己需要，按照技术文档编写。该代码仅供参考
 */

// 初始化日志
#$log = new PhpLog ( SDK_LOG_FILE_PATH, "PRC", SDK_LOG_LEVEL );
#$log->LogInfo ( "===========处理后台请求开始============" );

$params = array(
		//固定填写
		'version'=> '5.0.0',//版本号--M
		//默认取值：UTF-8
		'encoding'=> 'GBK',//编码方式--M
		//通过MPI插件获取
		'certId'=> getSignCertId (),//证书ID--M
		//01RSA02 MD5 (暂不支持)
		'signMethod'=> '01',//签名方法--M
		//取值：01 
		'txnType'=> '01',//交易类型--M
		//01：自助消费，通过地址的方式区分前台消费和后台消费（含无跳转支付）03：分期付款
		'txnSubType'=> '00',//交易子类--M
		// 
		'bizType'=> '000000',//产品类型--M
		'channelType'=> '07',//渠道类型--M
		//前台返回商户结果时使用，前台类交易需上送
		'frontUrl'=> SDK_FRONT_TRANS_URL,//前台通知地址--C
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
		//商户端生成
		'orderId'=> date('YmdHis'),//商户订单号--M
		//商户发送交易时间
		'txnTime'=> date('YmdHis'),//订单发送时间--M
		//后台类交易且卡号上送；跨行收单且收单机构收集银行卡信息时上送01：银行卡02：存折03：C卡默认取值：01取值“03”表示以IC终端发起的IC卡交易，IC作为普通银行卡进行支付时，此域填写为“01”
		'accType'=> '',//账号类型--C
		//1、  后台类消费交易时上送全卡号或卡号后4位 2、  跨行收单且收单机构收集银行卡信息时上送、  3、前台类交易可通过配置后返回，卡号可选上送
		'accNo'=> '',//账号--C
		//交易单位为分
		'txnAmt'=> '1',//交易金额--M
		//默认为156交易 参考公参
		'currencyCode'=> '156',//交易币种--M
		//1、后台类消费交易时上送2、跨行收单且收单机构收集银行卡信息时上送3、认证支付2.0，后台交易时可选Key=value格式（具体填写参考数据元说明）
		'customerInfo'=> customerInfo(),//银行卡验证信息及身份信息--C
		//PC1、前台类消费交易时上送2、认证支付2.0，后台交易时可选
		'orderTimeout'=> '',//订单接收超时时间（防钓鱼使用）--O
		//　
		'termId'=> '',//终端号--O
		//商户自定义保留域，交易应答时会原样返回
		'reqReserved'=> '',//请求方保留域--O
		//子域名： 活动号 marketId  移动支付订单推送时，特定商户可以通过该域上送该订单支付参加的活动号
		'reserved'=> '',//保留域--O
		//格式如下：{子域名1=值&子域名2=值&子域名3=值}
		'riskRateInfo'=> '',//风险信息域--O
		//当使用银联公钥加密密码等信息时，需上送加密证书的CertID；说明一下？目前商户、机构、页面统一套
		'encryptCertId'=> '',//加密证书ID--C
		//前台消费交易若商户上送此字段，则在支付失败时，页面跳转至商户该URL（不带交易信息，仅跳转）
		'frontFailUrl'=> '',//失败交易前台跳转地址--O
		//分期付款交易，商户端选择分期信息时，需上送 组合域，填法见数据元说明
		'instalTransInfo'=> '',//分期付款信息域--C
		//C当账号类型为02-存折时需填写在前台类交易时填写默认银行代码，支持直接跳转到网银商户发卡银行控制系统应答返回
		'issInsCode'=> '',//发卡机构代码--O
		//移动支付业务需要上送
		'userMac'=> '',//终端信息域--O
		//前台交易，有IP防钓鱼要求的商户上送
		'customerIp'=> '',//持卡人IP--C
		//绑定消费 需做绑定时填写 用于唯一标识绑定关系
		'bindId'=> '',//绑定标识号--O
		//绑定消费特殊商户交易控制用（如借贷分离）
		'payCardType'=> '',//支付卡类型--C
		//有卡交易必填有卡交易信息域
		'cardTransData'=> '',//有卡交易信息域--C
		//渠道类型为语音支付时使用
		'vpcTransData'=> '',//VPC交易信息域--C
		//移动支付上送
		'orderDesc'=> '',//订单描述--C
	);

$params_4_pin = array(
//固定填写
		'version'=> '5.0.0',//版本号--M
		//默认取值：UTF-8
		'encoding'=> 'GBK',//编码方式--M
		//通过MPI插件获取
		'certId'=> getSignCertId (),//证书ID--M
		//01RSA02 MD5 (暂不支持)
		'signMethod'=> '01',//签名方法--M
		//取值：01 
		'txnType'=> '01',//交易类型--M
		//01：自助消费，通过地址的方式区分前台消费和后台消费（含无跳转支付）03：分期付款
		'txnSubType'=> '00',//交易子类--M
		// 
		'bizType'=> '000000',//产品类型--M
		'channelType'=> '07',//渠道类型--M
		//前台返回商户结果时使用，前台类交易需上送
		'frontUrl'=> SDK_FRONT_TRANS_URL,//前台通知地址--C
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
		//商户端生成
		'orderId'=> date('YmdHis'),//商户订单号--M
		//商户发送交易时间
		'txnTime'=> date('YmdHis'),//订单发送时间--M
		//后台类交易且卡号上送；跨行收单且收单机构收集银行卡信息时上送01：银行卡02：存折03：C卡默认取值：01取值“03”表示以IC终端发起的IC卡交易，IC作为普通银行卡进行支付时，此域填写为“01”
		'accType'=> '',//账号类型--C
		//1、  后台类消费交易时上送全卡号或卡号后4位 2、  跨行收单且收单机构收集银行卡信息时上送、  3、前台类交易可通过配置后返回，卡号可选上送
		'accNo'=> '',//账号--C
		//交易单位为分
		'txnAmt'=> '1',//交易金额--M
		//默认为156交易 参考公参
		'currencyCode'=> '156',//交易币种--M
		//1、后台类消费交易时上送2、跨行收单且收单机构收集银行卡信息时上送3、认证支付2.0，后台交易时可选Key=value格式（具体填写参考数据元说明）
		'customerInfo'=> customerInfo(),//银行卡验证信息及身份信息--C
		//PC1、前台类消费交易时上送2、认证支付2.0，后台交易时可选
		'orderTimeout'=> '',//订单接收超时时间（防钓鱼使用）--O
		//　
		'termId'=> '',//终端号--O
		//商户自定义保留域，交易应答时会原样返回
		'reqReserved'=> '',//请求方保留域--O
		//子域名： 活动号 marketId  移动支付订单推送时，特定商户可以通过该域上送该订单支付参加的活动号
		'reserved'=> '',//保留域--O
		//格式如下：{子域名1=值&子域名2=值&子域名3=值}
		'riskRateInfo'=> '',//风险信息域--O
		//当使用银联公钥加密密码等信息时，需上送加密证书的CertID；说明一下？目前商户、机构、页面统一套
		'encryptCertId'=> '',//加密证书ID--C
		//前台消费交易若商户上送此字段，则在支付失败时，页面跳转至商户该URL（不带交易信息，仅跳转）
		'frontFailUrl'=> '',//失败交易前台跳转地址--O
		//分期付款交易，商户端选择分期信息时，需上送 组合域，填法见数据元说明
		'instalTransInfo'=> '',//分期付款信息域--C
		//C当账号类型为02-存折时需填写在前台类交易时填写默认银行代码，支持直接跳转到网银商户发卡银行控制系统应答返回
		'issInsCode'=> '',//发卡机构代码--O
		//移动支付业务需要上送
		'userMac'=> '',//终端信息域--O
		//前台交易，有IP防钓鱼要求的商户上送
		'customerIp'=> '',//持卡人IP--C
		//绑定消费 需做绑定时填写 用于唯一标识绑定关系
		'bindId'=> '',//绑定标识号--O
		//绑定消费特殊商户交易控制用（如借贷分离）
		'payCardType'=> '',//支付卡类型--C
		//有卡交易必填有卡交易信息域
		'cardTransData'=> '',//有卡交易信息域--C
		//渠道类型为语音支付时使用
		'vpcTransData'=> '',//VPC交易信息域--C
		//移动支付上送
		'orderDesc'=> '',//订单描述--C
);
//$params_4_pin['customerInfo'] =base64_encode("{phoneNo=13764069733&pin=".encryptPin("622114000000100150","111111")."}");
     

$result_arr_1024 = array(
  "accNo"=> "9555********0001",
  "accessType"=> "0",
  "bizType"=> "000000",
  "certId"=> "3474813271258769001041842579301293446",
  "currencyCode"=> "156",
  "encoding"=> "GBK",
  "merId"=> "898340183980105",
  "orderId"=> "20141120140721",
  "payCardType"=> "01",
  "payType"=> "0301",
  "queryId"=> "201411201407211751638",
  "respCode"=> "00",
  "respMsg"=> "成功[0000000]",
  "signMethod"=> "01",
  "txnAmt"=> "1230",
  "txnSubType"=> "01",
  "txnTime"=> "20141120140721",
  "txnType"=> "01",
  "version"=> "5.0.0",
  "signature"=> "eNVMlQAL78/R0qJWzKDoMW0JlfNIQ1if4VpM1we13sMY7Np9D9dBV+AGWGxiVt5Uk5oDs9NcFtxB18hKcberTKRHehHMMAXFBojWe5iOG0Xj+KyrDUOIcqf5ueIFoV7rNqnbsS7F4VXY9gEIChlkn4UCF0nuTgRVO+ePrV1gx2ZmQrMsTtFtpIvNGgOtHC2uwlSRo+E6ewcZZ+FUQnQ6a6alW/kSAweCKhheBtCsm+//Obgs88+mM0yzO1/95PGrnGaEQsg2xYgNVlka6KsH9akUrefDz1gWolDPTylNk/CMU2FRsD/t2gzysytzAljtiPuzuCjG6h1936baEjmWuw=="
);

//echo "<br><b>params</b><br>";
//echo "SDK_SIGN_CERT_PATH：".SDK_SIGN_CERT_PATH."<br>";
//echo "SDK_SIGN_CERT_PWD：".SDK_SIGN_CERT_PWD."<br>";
//echo "SDK_VERIFY_CERT_PATH".SDK_VERIFY_CERT_PATH."<br>";
if ($flag == 1){
    // 性能测试，签名
    sign ($params);		
    exit;
}elseif ($flag == 2 ){
    // 性能测试，验签

    $r = verify($result_arr_1024);
    echo $r ? '验签成功' : '验签失败';
    exit;
}elseif ($flag == 3 ){
    // 性能测试，加密
    $r = encryptPin("1234567890123456", "111111");
    echo $r;
    exit;
}elseif ($flag == 4 ){
}elseif ($flag == 5 ){
}elseif ($flag == 6 ){
        // 功能测试1
		// 检查字段是否需要加密
		encrypt_params ( $params_4_pin );		
        echo "<br /><br />";
        //echo "<br /><b>encrypt_params</b><br />";
        var_dump($params_4_pin);
        echo  var_dump($params_4_pin);
        //echo    var_dump($params_4_pin);
        
        echo "<br /><br />";
        echo "<br /><br />";
		// 签名
		sign ( $params_4_pin );		
        echo "<br /><br />";
        //echo "<br /><b>sign</b><br />";
        var_dump($params_4_pin);
        
        
        echo "<br /><br />";
        echo "<br /><br />";
		// 发送信息到后台

		$result = sendHttpRequest ($params_4_pin, SDK_BACK_TRANS_URL );


		//返回结果展示
        $result_arr = coverStringToArray ( $result );//字符转数组
        echo "<br /><br />";
        echo "<br /><b>result</b><br />";
        var_dump($result_arr);
        echo "<br /><br />";
        echo "<br /><br />";
        $r = verify($result_arr);
        echo "<br /><br />";
        echo "<br /><b>verify</b><br />";
        echo $r;
        echo "<br /><br />";
        echo "<br /><br />";
        echo $r ? '验签成功' : '验签失败';

		$html = create_html ( $result_arr, SDK_BACK_NOTIFY_URL );
        #echo $html;
}else{
    // 功能测试2

		// 检查字段是否需要加密
		//encrypt_params ( $params );		
		// 签名
		sign ( $params );		
		// 发送信息到后台
		$result = sendHttpRequest ($params, SDK_BACK_TRANS_URL );

		//返回结果展示
        $result_arr = coverStringToArray ( $result );//字符转数组
        var_dump($result_arr);
        echo "<br /><br />";
        echo "<br /><br />";
        $r = verify($result_arr);
        echo "<br /><br />";
        echo "<br /><br />";
        echo $r;
        echo "<br /><br />";
        echo "<br /><br />";
        echo $r ? '验签成功' : '验签失败';

		$html = create_html ( $result_arr, SDK_BACK_NOTIFY_URL );
        #echo $html;
}
		?>
