<?php


// cvn2���� 1������ 0:������
const SDK_CVN2_ENC = 0;
// ��Ч�ڼ��� 1:���� 0:������
const SDK_DATE_ENC = 0;
// ���ż��� 1������ 0:������
const SDK_PAN_ENC = 0;
 

// ǩ��֤��·��
const SDK_SIGN_CERT_PATH = 'http://weizhan.chiwoon.com/demo_003/zhengshu.pfx';

// ǩ��֤������
 const SDK_SIGN_CERT_PWD = '900515';
 
// ��ǩ֤��
const SDK_VERIFY_CERT_PATH = 'http://weizhan.chiwoon.com/demo_003/verify_sign_acp.cer';

// �������֤��
const SDK_ENCRYPT_CERT_PATH = 'http://weizhan.chiwoon.com/demo_003/UpopRsaCert.cer';

// ��ǩ֤��·��
const SDK_VERIFY_CERT_DIR = 'http://weizhan.chiwoon.com/demo_003';

// ǰ̨�����ַ
const SDK_FRONT_TRANS_URL = 'https://gateway.95516.com/gateway/api/frontTransReq.do';

// ��̨�����ַ
const SDK_BACK_TRANS_URL = 'https://gateway.95516.com/gateway/api/backTransReq.do';

// ��������
const SDK_BATCH_TRANS_URL = 'https://gateway.95516.com/gateway/api/batchTrans.do';

//��������״̬��ѯ
const SDK_BATCH_QUERY_URL = 'https://gateway.95516.com/gateway/api/batchQueryRequest.do';
//http://146.240.25.27:11000/ACP/api/queryTrans.do

//���ʲ�ѯ�����ַ
const SDK_SINGLE_QUERY_URL = 'https://gateway.95516.com/gateway/api/queryTrans.do';

//�ļ����������ַ
const SDK_FILE_QUERY_URL = 'https://gateway.95516.com/';

// ǰ̨֪ͨ��ַ
const SDK_FRONT_NOTIFY_URL = 'http://weizhan.chiwoon.com/demo_003/gbk/response.php';
// ��̨֪ͨ��ַ
const SDK_BACK_NOTIFY_URL = 'http://weizhan.chiwoon.com/demo_003/gbk/response.php';

//�ļ�����Ŀ¼ 
const SDK_FILE_DOWN_PATH = 'e://';

//��־ Ŀ¼ 
const SDK_LOG_FILE_PATH = 'e:/certs/UPOnlineMPIUtilPhp/logs/';

//��־����
const SDK_LOG_LEVEL = 'INFO';

//�п����׵�ַ
const SDK_Card_Request_Url = '';

//App���׵�ַ
const SDK_App_Request_Url = '';
	
?>