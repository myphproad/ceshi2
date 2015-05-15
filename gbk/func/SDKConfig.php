<?php


// cvn2加密 1：加密 0:不加密
const SDK_CVN2_ENC = 0;
// 有效期加密 1:加密 0:不加密
const SDK_DATE_ENC = 0;
// 卡号加密 1：加密 0:不加密
const SDK_PAN_ENC = 0;
 

// 签名证书路径
const SDK_SIGN_CERT_PATH = 'http://weizhan.chiwoon.com/demo_003/zhengshu.pfx';

// 签名证书密码
 const SDK_SIGN_CERT_PWD = '900515';
 
// 验签证书
const SDK_VERIFY_CERT_PATH = 'http://weizhan.chiwoon.com/demo_003/verify_sign_acp.cer';

// 密码加密证书
const SDK_ENCRYPT_CERT_PATH = 'http://weizhan.chiwoon.com/demo_003/UpopRsaCert.cer';

// 验签证书路径
const SDK_VERIFY_CERT_DIR = 'http://weizhan.chiwoon.com/demo_003';

// 前台请求地址
const SDK_FRONT_TRANS_URL = 'https://gateway.95516.com/gateway/api/frontTransReq.do';

// 后台请求地址
const SDK_BACK_TRANS_URL = 'https://gateway.95516.com/gateway/api/backTransReq.do';

// 批量交易
const SDK_BATCH_TRANS_URL = 'https://gateway.95516.com/gateway/api/batchTrans.do';

//批量交易状态查询
const SDK_BATCH_QUERY_URL = 'https://gateway.95516.com/gateway/api/batchQueryRequest.do';
//http://146.240.25.27:11000/ACP/api/queryTrans.do

//单笔查询请求地址
const SDK_SINGLE_QUERY_URL = 'https://gateway.95516.com/gateway/api/queryTrans.do';

//文件传输请求地址
const SDK_FILE_QUERY_URL = 'https://gateway.95516.com/';

// 前台通知地址
const SDK_FRONT_NOTIFY_URL = 'http://weizhan.chiwoon.com/demo_003/gbk/response.php';
// 后台通知地址
const SDK_BACK_NOTIFY_URL = 'http://weizhan.chiwoon.com/demo_003/gbk/response.php';

//文件下载目录 
const SDK_FILE_DOWN_PATH = 'e://';

//日志 目录 
const SDK_LOG_FILE_PATH = 'e:/certs/UPOnlineMPIUtilPhp/logs/';

//日志级别
const SDK_LOG_LEVEL = 'INFO';

//有卡交易地址
const SDK_Card_Request_Url = '';

//App交易地址
const SDK_App_Request_Url = '';
	
?>