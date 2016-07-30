<?php
/**
 * Created by NextPay.ir
 * author: FreezeMan
 * ID: @FreezeMan
 * Date: 7/29/16
 * Time: 6:14 PM
 * Website:
 * Email:
 * @copyright 2016
 */

//---- params
include_once "./nextpay_payment.php";
$nextpay = new Nextpay_Payment();
$params = array_merge($_GET,$_POST);

if(isset($params['trans_id']))
{
    $trans_id = $params['trans_id'];
    $api_key = $params['api_key'];
    $amount = $params['amount'];
    $res = $nextpay->verify_request(false,$api_key,$trans_id,$amount);
}
else
    echo "پارامتر شماره تراکنش ارسال نشده است";