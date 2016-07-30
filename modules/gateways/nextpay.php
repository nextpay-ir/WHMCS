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

function nextpay_config() {
    $configarray = array(
     "FriendlyName" => array("Type" => "System", "Value"=>"درگاه پرداخت - nextpay"),
     "api_key" => array("FriendlyName" => "api_key", "Type" => "text", "Size" => "70", ),
     "Currencies" => array("FriendlyName" => "Currencies", "Type" => "dropdown", "Options" => "Rial,Toman", ),
	 "afp" => array("FriendlyName" => "افزودن کارمزد به قیمت ها", "Type" => "yesno", "Description" => "در صورت انتخاب 1 درصد به هزینه پرداخت شده افزوده می شود.", ),
     );
	return $configarray;
}

function nextpay_link($params) {

	# Gateway Specific Variables
	$api_key = $params['api_key'];
    $currencies = $params['Currencies'];
    $afp = $params['afp'];
    
	# Invoice Variables
	$invoiceid = $params['invoiceid'];
	$description = $params["description"];
    $amount = $params['amount']; # Format: ##.##
    $currency = $params['currency']; # Currency Code

	# Client Variables
	$firstname = $params['clientdetails']['firstname'];
	$lastname = $params['clientdetails']['lastname'];
	$email = $params['clientdetails']['email'];
	$address1 = $params['clientdetails']['address1'];
	$address2 = $params['clientdetails']['address2'];
	$city = $params['clientdetails']['city'];
	$state = $params['clientdetails']['state'];
	$postcode = $params['clientdetails']['postcode'];
	$country = $params['clientdetails']['country'];
	$phone = $params['clientdetails']['phonenumber'];

	# System Variables
	$companyname = $params['companyname'];
	$systemurl = $params['systemurl'];

	# Enter your code submit to the gateway...

	$code = '
    <form method="post" action="nextpay.php">
        <input type="hidden" name="api_key" value="' . $api_key .'" />
        <input type="hidden" name="invoiceid" value="'. $invoiceid .'" />
        <input type="hidden" name="amount" value="'. $amount .'" />
        <input type="hidden" name="currencies" value="'. $currencies .'" />
        <input type="hidden" name="afp" value="'. $afp .'" />
        <input type="hidden" name="systemurl" value="'. $systemurl .'" />
        <input type="submit" name="pay" value=" پرداخت " />
    </form>
    ';

	return $code;
}

