<?php
    /**
    * Created by NextPay.ir
    * author: FreezeMan
    * ID: @FreezeMan
    * Date: 7/29/16
    * Time: 7:05 PM
    * Website:
    * Email:
    * @copyright 2016
    */

    include_once "./nextpay_payment.php";

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


    $CallbackURL = $_POST['systemurl'] .'/modules/gateways/callback/nextpay.php?invoiceid='. $_POST['invoiceid'] .'&Amount='. $Amount;

    $params_nextpay = array(
        "api_key"=>$api_key,
        "amount"=>$Amount,
        "callback_uri"=>$CallbackURL
    );

    $nextpay = new Nextpay_Payment($params_nextpay);
    $trans_id = $nextpay->verify();
    $nextpay->send($trans_id);

