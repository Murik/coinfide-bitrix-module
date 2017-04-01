<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule('sale');

/* Обработка запроса */
$order = explode('_', $_POST['externalOrderId']);
$order = CSaleOrder::getById($order['1']);

$APPLICATION->IncludeComponent('bitrix:sale.order.payment.receive', '.default', array(
	'PAY_SYSTEM_ID'  => $order ? $order['PAY_SYSTEM_ID']  : false,
	'PERSON_TYPE_ID' => $order ? $order['PERSON_TYPE_ID'] : false,
));

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");