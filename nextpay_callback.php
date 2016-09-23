<?php
/**
 * Created by NextPay.ir
 * author: Nextpay Company
 * ID: @nextpay
 * Date: 09/22/2016
 * Time: 5:05 PM
 * Website: NextPay.ir
 * Email: info@nextpay.ir
 * @copyright 2016
 * @package NextPay_Gateway
 * @version 1.0
 */

//---- params
include_once "nextpay_payment.php";
$nextpay = new Nextpay_Payment();
$params = array_merge($_GET,$_POST);

if(isset($params['trans_id']))
{
    $trans_id = $params['trans_id'];
    $order_id = $params['order_id'];
    $api_key = $params['api_key'];
    $amount = $params['amount'];
    $res = $nextpay->verify_request(false,$api_key,$order_id,$trans_id,$amount);
}
else
    echo "پارامتر شماره تراکنش ارسال نشده است";