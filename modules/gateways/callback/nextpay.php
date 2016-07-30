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

	# Required File Includes
	if(file_exists('../../../init.php'))
		require( '../../../init.php' );
	else
		require("../../../dbconnect.php");

	include("../../../includes/functions.php");
	include("../../../includes/gatewayfunctions.php");
	include("../../../includes/invoicefunctions.php");
	include_once ("../../../nextpay_payment.php");

	$gatewaymodule = 'nextpay'; # Enter your gateway module name here replacing template

	$GATEWAY = getGatewayVariables($gatewaymodule);
	if (!$GATEWAY['type']) die('Module Not Activated'); # Checks gateway module is active before accepting callback

	# Get Returned Variables - Adjust for Post Variable Names from your Gateway's Documentation
	$invoiceid  = $_GET['invoiceid'];
	$Amount 	= $_GET['Amount'];
	$trans_id	= (isset($_POST['trans_id'])) ? $_POST['trans_id'] : $_GET['trans_id'];
	$invoiceid  = checkCbInvoiceID($invoiceid, $GATEWAY['name']); # Checks invoice ID is a valid invoice number or ends processing

	$CaculatedFee = round($Amount*0.01);
	
	if($GATEWAY['afp'] == 'on'){
		$PaidFee 	= 0;
		$HiddenFee  = $CaculatedFee;
	} else {
		$PaidFee 	= $CaculatedFee;
		$HiddenFee  = 0;
	}

	$result = -77;
	$resultO = new stdClass();

	if(strlen($trans_id) > 32 && strpos($trans_id, '-') !== false) {

		try {
			$api_key = $GATEWAY['api_key'];

			$nextpay = new Nextpay_Payment();
			$nextpay->setAmount($Amount);
			$nextpay->setApiKey($api_key);
			$nextpay->setTransId($trans_id);
			$result = intval($nextpay->verify_request());
			$resultO = $nextpay->getParams();
			$resultO['status'] = $result;

			checkCbTransID($trans_id); # Checks transaction number isn't already in the database and ends processing if it does
		}catch (Exception $e) {
			echo '<h2>وقوع خطا!</h2>';
			print_r($e);
		}
	}

	if($GATEWAY['Currencies'] == 'Rial'){
		$Amount  *= 10;
		$PaidFee *= 10;
	}
	
	if ($result == 0) {
		addInvoicePayment($invoiceid, $trans_id, $Amount, $PaidFee, $gatewaymodule); # Apply Payment to Invoice: invoiceid, transactionid, amount paid, fees, modulename
		logTransaction($GATEWAY['name'], array('Get' => $_GET, 'Websevice' => (array) $resultO), 'Successful'); # Save to Gateway Log: name, data array, status
	} else {
		logTransaction($GATEWAY['name'], array('Get' => $_GET, 'Websevice' => (array) $resultO), 'Unsuccessful'); # Save to Gateway Log: name, data array, status
	}
	Header('Location: '.$CONFIG['SystemURL'].'/clientarea.php?action=invoices');
    
?>
