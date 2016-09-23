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

    include_once "nextpay_payment.php";

    //'29356111-73f9-45b2-8f7f-7c781f3858d6' -> sample api_key
    if(isset($_POST['api_key']))
        $api_key = $_POST['api_key'];
    else
        $api_key = 'Insert Api Key';

    $Amount = intval($_POST['amount']);

    if($_POST['currencies'] == 'Rial')
        $Amount = round($Amount/10);

    if($_POST['afp']=='on')
        $Fee = round($Amount*0.01);
    else
        $Fee = 0;

    $order_id = $_POST['invoiceid'];

    $CallbackURL = $_POST['systemurl'] .'/modules/gateways/callback/nextpay.php?invoiceid='. $order_id .'&Amount='. $Amount;

    $params_nextpay = array(
        "api_key"=>$api_key,
        "order_id"=>$order_id,
        "amount"=>$Amount,
        "callback_uri"=>$CallbackURL
    );

    $nextpay = new Nextpay_Payment($params_nextpay);
    $result = $nextpay->token();
    if(intval($result->code) == -1)
        $nextpay->send($result->trans_id);
    else {
        echo "<h2>تراکنش ناموفق بود</h2>";
        echo "<h3>کد خطا : ".$result->code."</h3>";
    }

