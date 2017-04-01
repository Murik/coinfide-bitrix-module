<?php
$root = $_SERVER["DOCUMENT_ROOT"];
require($root."/bitrix/header.php");

IncludeModuleLangFile(__FILE__);

use \Bitrix\Main\Loader;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) { die(); }

try {
//    if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST)) {
//        throw new Exception('Invalid IPN request');
//    }

    if (!Loader::includeModule('coinfide.coinfide')) {
        throw new Exception('Can\'t load module coinfide.coinfide');
    }

    /* ��������� ������� */
    $order = explode('_', $_GET['externalOrderId']);

    $order = CSaleOrder::getById($order['1']);
    $message = ' '.GetMessage("COINFIDE_PAYMENT_NE_UDALOSQ_OBRABOTAT");

    if (!$order) {
        throw new Exception($message. $_GET['externalOrderId']);
    }

    if ($order['PAYED'] == 'Y') { die(); }

//    $checksum = $_POST['checksum'];

//    unset($_POST['checksum']);

//    if (md5(http_build_query($_POST) . CSalePaySystemAction::GetParamValue('API_KEY')) != $checksum) {
//            echo 'Callback valid! You may process the order. Order data: ';
//        throw new Exception('Callback invalid! You may not process the order. Order data: ' . serialize($this->request->post));
//    }

//    if (isset($_POST['transactionUid'])) {
//        $transaction_id = $_POST['transactionUid'];
//    } else {
//        $transaction_id = '';
//    }

//    $amount = $_POST['amountTotal'];
//    $currency = $_POST['currencyCode'];
//    $status = $_POST['status'];
//    $paymentMethodCode = $_POST['paymentMethodCode'];
//    $orderNumber = $_POST['orderNumber'];


//    $paymentStatusSuccess = array('PA');
//    $paymentStatusFiled = array('CA', 'DE', 'EX');

    $amount = (strlen(CSalePaySystemAction::GetParamValue('AMOUNT')) > 0)
        ? CSalePaySystemAction::GetParamValue('AMOUNT')
        : $GLOBALS['SALE_INPUT_PARAMS']['ORDER']['SHOULD_PAY'];

    $currency = (strlen(CSalePaySystemAction::GetParamValue('PRICE_CURRENCY')) > 0)
        ? CSalePaySystemAction::GetParamValue('PRICE_CURRENCY')
        : $GLOBALS['SALE_INPUT_PARAMS']['ORDER']['CURRENCY'];

    $sDescription = '';
    $sStatusMessage = '';

    $sDescription .= 'payment Method: '.$paymentMethodCode.'; ';
    $sDescription .= 'amount: '.$amount.'; ';
    $sDescription .= 'currency: '.$currency.'; ';

    $sStatusMessage .= 'status: FAIL by Gateway; ';
    $sStatusMessage .= 'order_id: '.$order['ID'].'; ';


    $arFields = array(
        'PS_STATUS' => 'N',
        'PS_STATUS_CODE' => 'CA',
        'PS_STATUS_DESCRIPTION' => $sDescription,
        'PS_STATUS_MESSAGE' => $sStatusMessage,
        'PS_SUM' => $amount,
        'PS_CURRENCY' => $currency,
        'PS_RESPONSE_DATE' =>  date( "d.m.Y H:i:s" ),
    );

        $result = CSaleOrder::PayOrder($order['ID'], 'N', false, null, 0, $arFields);


    CSaleOrder::update($order['ID'], $arFields, true);

} catch (Exception $e) {
//    echo $e->getMessage();
}
?>

    <div>
        <h1> <?=GetMessage("COINFIDE_PAYMENT_INFORMACIA_O_STATUSE")?></h1>
        <h4> <?=GetMessage("COINFIDE_PAYMENT_UVAJAEMYY_POKUPATELQ")?></h4>
        <p> <?= $message ?> </p>
    </div>

<?php
require($root."/bitrix/footer.php");
?>