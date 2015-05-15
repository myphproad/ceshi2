<?php
//include './gbk/Front/FrontDeal.php';
//include './gbk/front/AuthDeal.php';
include_once '/func/secureUtil.php';
include_once '/func/encryptParams.php';
?>
<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GBK" />
<title>发送页面</title>
<style type="text/css">
body table tr td {
	font-size: 14px;
	word-wrap: break-word;
	word-break: break-all;
	empty-cells: show;	
}
</style>
<script type="text/javascript">  

    function test()  
    {  
    	window.location.href="FrontReceive.php";
    	   	       
    }
    function showValue(){
    	pwd.value = "";     
        for (i=0;i<cus.length;i++){
        if(cus[i].checked)
        	pwd.value+=cus[i].checked?cus[i].value+' ':'';
       }    
      }
    
}
</script> 
</head>
<body>
 <form action="BackReceive.php" method="post">
 <table width="900px" border="1" align="center">
 <tr><td align="left" colspan="2" >发送请求</td></tr>
<tr><td width="30%">版本号</td><td><input type="text"  name="flags[version]"   value="5.0.0"/></td></tr>
<tr><td width="30%">编码方式</td><td><input type="text"  name="flags[encoding]" value="GBK"/></td></tr>
<tr><td width="30%">证书ID</td><td>
<input type="text"  name="flags[certId]"   value="<?=getSignCertId()?>"/></td></tr>
<tr><td width="30%">签名域</td><td><input type="text"  name="flags[signature]" value=""/></td></tr>
<tr><td width="30%">签名方法</td><td><input type="text" name="flags[signMethod]" value=""/></td></tr>
<tr><td width="30%">交易类型</td><td><input type="text" name="flags[txnType]" value=""/></td></tr>
<tr><td width="30%">交易子类</td><td><input type="text" name="flags[txnSubType]" value=""/></td></tr>
<tr><td width="30%">产品类型</td><td><input type="text" name="flags[bizType]" value=""/></td></tr>
<tr><td width="30%">渠道类型</td><td><input type="text" name="flags[channelType]" value=""/></td></tr>
<tr><td width="30%" >持卡人是否加密信息<td>
<input type="checkbox" name="arr[SDK_PAN_ENC]"  value="" checked="true"/>密码 
<input type="checkbox" name="arr[SDK_CVN2_ENC]" value="" checked="true"/>CVN2
<input type="checkbox" name="arr[SDK_DATE_ENC]" value="" checked="true"/>有效期</td></tr>
<tr><td width="30%">前台地址</td><td><input type="text" name="flags[frontUrl]" value=""/></td></tr>
<tr><td width="30%">后台地址</td><td><input type="text" name="flags[backUrl]"  value=""/></td></tr>
<tr><td width="30%">接入类型</td><td><input type="text" name="flags[accessType]" value=""/></td></tr>
<tr><td width="30%">商户ID</td><td><input type="text" name="flags[merId]"  	value="898140148161209"/></td></tr>
<tr><td width="30%">商户订单号</td><td><input type="text" name="flags[orderId]" value=""/></td></tr>
<tr><td width="30%" >订单发送时间</td><td><input type="text" name="flags[txnTime]"  value="20141124145900"/></td></tr>
<tr><td width="30%">交易币种</td><td><input type="text" name="flags[currencyCode]" value=""/></td></tr>
<tr><td width="30%">交易金额</td><td><input type="text" name="flags[txnAmt]" value=""/></td></tr>
<tr><td width="30%">接入类型</td><td><input type="text" name="flags[accessType]" value=""/></td></tr>
<tr><td width="30%">收单机构代码</td><td><input type="text" name="flags[acqInsCode]"  	value=""/></td></tr>
<tr><td width="30%">商户类别</td><td><input type="text" name="flags[merCatCode]" value=""/></td></tr>
<tr><td width="30%">商户名称</td><td><input type="text" name="flags[merName]" value=""/></td></tr>
<tr><td width="30%">商户简称</td><td><input type="text" name="flags[currencyCode]" value=""/></td></tr>
<tr><td width="30%">二级商户代码</td><td><input type="text" name="flags[txnAmt]" value=""/></td></tr>
<tr><td width="30%">二级商户名称</td><td><input type="text" name="flags[accessType]" value=""/></td></tr>
 <tr><td width="30%">默认支付方式</td><td><input type="text" name="flags[defaultPayType]" value=""/></td></tr>
<tr><td width="30%">支付卡类型</td><td><input type="text" name="flags[payCardType]" value=""/></td></tr>
<tr><td width="30%">账户类型</td><td><input type="text" name="flags[accType]" value=""/></td></tr>
<tr><td width="30%">账号</td><td><input type="text" name="flags[accNo]" value=""/></td></tr>
<tr><td width="30%">账单号</td><td><input type="text" name="flags[billNo]" value=""/></td></tr>
<tr><td width="30%">账单类型</td><td><input type="text" name="flags[billType]" value=""/></td></tr>
<tr><td width="30%">绑定标识号</td><td><input type="text" name="flags[bindId]" value=""/></td></tr>
<tr><td width="30%">风险信息域</td><td><input type="text" name="flags[riskRateInfo]" value=""/></td></tr>
<tr><td width="30%">批次号</td><td><input type="text" name="flags[batchNo]" value=""/></td></tr>
<tr><td width="30%">总金额</td><td><input type="text" name="flags[totalAmt]" value=""/></td></tr>
<tr><td width="30%">总笔数</td><td><input type="text" name="flags[totalQty]" value=""/></td></tr>
<tr><td width="30%">保留域</td><td><input type="text" name="flags[reserved]" value=""/></td></tr>
<tr><td width="30%">终端号</td><td><input type="text" name="flags[termId]" value=""/></td></tr>
<tr><td width="30%">订单超时时间间隔</td><td><input type="text" name="flags[orderTimeoutInterval]" value=""/></td></tr>
<tr><td width="30%">默认支付方式</td><td><input type="text" name="flags[supPayType]" value=""/></td></tr>
<tr><td width="30%">支付方式</td><td><input type="text" name="flags[payType]" value=""/></td></tr>
<tr><td width="30%">预授权号</td><td><input type="text" name="fla[gspreAuthId]" value=""/></td></tr>
<tr><td width="30%">发卡机构代码</td><td><input type="text" name="flags[issInsCode]" value=""/></td></tr>
<tr><td width="30%">开户行省</td><td><input type="text" name="flags[issInsProvince]" value=""/></td></tr>
<tr><td width="30%">开户行市</td><td><input type="text" name="flags[issInsCity]" value=""/></td></tr>
<tr><td width="30%">开户行名称</td><td><input type="text" name="flags[issInsName]" value=""/></td></tr>
<tr><td width="30%">余额</td><td><input type="text" name="flags[balance]" value=""/></td></tr>
<tr><td width="30%">地区代码</td><td><input type="text" name="flags[districtCode]" value=""/></td></tr>
<tr><td width="30%">附加地区代码</td><td><input type="text" name="flags[additionalDistrictCode]" value=""/></td></tr>
<tr><td width="30%">账单月份</td><td><input type="text" name="flags[billMonth]" value=""/></td></tr>
<tr><td width="30%">账单查询要素</td><td><input type="text" name="flags[billQueryInfo]" value=""/></td></tr>
<tr><td width="30%">账单详情</td><td><input type="text" name="flags[billDetailInfo]" value=""/></td></tr>
<tr><td width="30%">账单金额</td><td><input type="text" name="flags[billAmt]" value=""/></td></tr>
<tr><td width="30%">账单金额符号</td><td><input type="text" name="flags[billAmtSign]" value=""/></td></tr>
<tr><td width="30%">绑定信息条数</td><td><input type="text" name="flags[bindInfoQty]" value=""/></td></tr>
<tr><td width="30%">绑定信息集</td><td><input type="text" name="flags[bindInfoList]" value=""/></td></tr>
<tr><td width="30%">文件类型</td><td><input type="text" name="flags[fileType]" value=""/></td></tr>
<tr><td width="30%">文件名</td><td><input type="text" name="flags[fileName]" value=""/></td></tr>
<tr><td width="30%">批量文件内容</td><td><input type="text" name="flags[fileContent]" value=""/></td></tr>
<tr><td width="30%">商户摘要</td><td><input type="text" name="flags[merNote]" value=""/></td></tr>
<tr><td width="30%">发卡机构识别模式</td><td><input type="text" name="flags[issuerIdentifyMode]" value=""/></td></tr>
<tr><td width="30%">持卡人IP</td><td><input type="text" name="flags[customerIp]" value=""/></td></tr>
<tr><td width="30%">查询流水号</td><td><input type="text" name="flags[queryId]" value=""/></td></tr>
<tr><td width="30%">原交易查询流水号</td><td><input type="text" name="flags[origQryId]" value=""/></td></tr>
<tr><td width="30%">系统跟踪号</td><td><input type="text" name="flags[traceNo]" value=""/></td></tr>
<tr><td width="30%">文件传输日期</td><td><input type="text" name="flags[traceTime]" value=""/></td></tr>
<!--<tr><td width="30%">清算日期</td><td><input type="text" name="flags[settleDate]" value=""/></td></tr>
  <tr><td width="30%">清算币种</td><td><input type="text" name="flags[settleCurrencyCode]" value=""/></td></tr>
 <tr><td width="30%">清算金额</td><td><input type="text" name="flags[settleAmt]" value=""/></td></tr>
 <tr><td width="30%">兑换日期</td><td><input type="text" name="flags[exchangeDate]" value=""/></td></tr>
<tr><td width="30%">响应时间</td><td><input type="text" name="flags[respTime]" value=""/></td></tr>
 <tr><td width="30%">应答码</td><td><input type="text" name="flags[respCode]" value=""/></td></tr>
<tr><td width="30%">应答信息</td><td><input type="text" name="flags[respMsg]" value=""/></td></tr>-->
<tr><td width="30%">请求方保留域</td><td><input type="text" name="flags[reqReserved]" value=""/></td></tr>
<tr><td width="30%">验证标识</td><td><input type="text" name="flags[checkFlag]" value=""/></td></tr>
<tr><td width="30%">开通状态</td><td><input type="text" name="flags[activateStatus]" value=""/></td></tr>
<tr><td width="30%">加密证书ID</td><td><input type="text" name="flags[encryptCertId]" value=""/></td></tr>
<tr><td width="30%">终端信息域</td><td><input type="text" name="flags[userMac]" value=""/></td></tr>
<!--  <tr><td width="30%">关联交易</td><td><input type="text" name="flags[relationTxnType]" value=""/></td></tr>-->
<tr><td width="30%">文件时间</td><td><input type="text" name="flags[traceTime]" value=""/></td></tr>

<tr><td><input type="submit" id="submit" value="BackSend"  /></td>
    <td><input type="button" id="button1" value="FrontSend"  onclick="test()"/></td>
</tr>

</table>
</form>	

</body>
</html>