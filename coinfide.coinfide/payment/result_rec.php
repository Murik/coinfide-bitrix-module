<?php
use \Bitrix\Main\Loader;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) { die(); }

try {
    if ($_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST)) {
        throw new Exception('Invalid IPN request');
    }

    if (!Loader::includeModule('coinfide.coinfide')) {
        throw new Exception('Can\'t load module coinfide.coinfide');
    }

    /* ��������� ������� */
    $order = explode('_', $_POST['externalOrderId']);

    $order = CSaleOrder::getById($order['1']);


    if (!$order) {
        throw new Exception('Invalid Order ID '. $_POST['externalOrderId']);
    }
    CSalePaySystemAction::InitParamArrays($order, $order["ID"]);


    if ($order['PAYED'] == 'Y') { echo 'OK'; die(); }

//    $checksum = $_POST['checksum'];

//    unset($_POST['checksum']);

    $part_pay = (strlen(CSalePaySystemAction::GetParamValue('PART_PAY')) > 0) && CSalePaySystemAction::GetParamValue('PART_PAY')=='Y';

    if (md5(http_build_query($_POST) . CSalePaySystemAction::GetParamValue('API_KEY')) != $_SERVER['HTTP_X_BODY_CHECKSUM']) {
//            echo 'Callback valid! You may process the order. Order data: ';
        throw new Exception('Callback invalid! You may not process the order. Order data: ' . serialize($this->request->post));
    }

        if (isset($_POST['transactionUid'])) {
            $transaction_id = $_POST['transactionUid'];
        } else {
            $transaction_id = '';
        }

    $amount = $_POST['amountTotal'];
    $currency = $_POST['currencyCode'];
    $status = $_POST['status'];
    $paymentMethodCode = $_POST['paymentMethodCode'];
    $orderNumber = $_POST['orderNumber'];


    $paymentStatusSuccess = array('PA');
    $paymentStatusFiled = array('CA', 'DE', 'EX');

    $sDescription = '';
    $sStatusMessage = '';

    $sDescription .= 'payment Method: '.$paymentMethodCode.'; ';
    $sDescription .= 'amount: '.$amount.'; ';
    $sDescription .= 'currency: '.$currency.'; ';

    $sStatusMessage .= 'status: '.$status.'; ';
    $sStatusMessage .= 'transaction_id: '.$transaction_id.'; ';
    $sStatusMessage .= 'order_id: '.$order['ID'].'; ';
    $sStatusMessage .= 'Coinfide order number: '.$orderNumber.'; ';



    $arFields = array(
//        'PS_STATUS' => 'Y',
        'PS_STATUS_CODE' => $status,
        'PS_STATUS_DESCRIPTION' => $sDescription,
        'PS_STATUS_MESSAGE' => $sStatusMessage,
        'PS_SUM' => $amount,
        'PS_CURRENCY' => $currency,
        'PS_RESPONSE_DATE' =>  date( "d.m.Y H:i:s" ),
    );

//    CSaleOrder::PayOrder($arOrder['ID'], 'Y');
//    CSaleOrder::Update($arOrder['ID'], $arFields);
    if (in_array($status, $paymentStatusSuccess)) {
        $arFields['PS_STATUS'] = 'Y';
        $result = CSaleOrder::PayOrder($order['ID'], 'Y', false, null, 0, $arFields);
        if ($part_pay) {
            CSaleOrder::StatusOrder($orderID, "ZK");
        }
        echo 'OK';
    } elseif (in_array($status, $paymentStatusFiled)) {
        $arFields['PS_STATUS'] = 'N';
        $result = CSaleOrder::PayOrder($order['ID'], 'N', false, null, 0, $arFields);
        echo 'OK';
    } else {
        throw new Exception('Invalid Order Status');
    }

    CSaleOrder::update($order['ID'], $arFields, true);

} catch (Exception $e) {
    echo $e->getMessage();
}