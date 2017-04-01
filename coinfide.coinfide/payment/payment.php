<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

\Bitrix\Main\Loader::includeModule('coinfide.coinfide');

include(GetLangFileName(dirname(__FILE__) . "/", "/.description.php"));
if(!CModule::IncludeModule("coinfide.coinfide")) return;


if (isset($arResult['ORDER_ID'] )) {
	$ORDER_ID = $arResult['ORDER_ID'];
} else if ( isset( $arResult['ID'] ) ) {
    $ORDER_ID = $arResult['ID'];
} else {
    $ORDER_ID = (int) $_GET['ORDER_ID'];
}

#------------------------------------------------
# Recive all items data
#------------------------------------------------
$amount = (strlen(CSalePaySystemAction::GetParamValue('AMOUNT')) > 0)
    ? CSalePaySystemAction::GetParamValue('AMOUNT')
    : $GLOBALS['SALE_INPUT_PARAMS']['ORDER']['SHOULD_PAY'];

$currency = (strlen(CSalePaySystemAction::GetParamValue('PRICE_CURRENCY')) > 0)
    ? CSalePaySystemAction::GetParamValue('PRICE_CURRENCY')
    : $GLOBALS['SALE_INPUT_PARAMS']['ORDER']['CURRENCY'];


//echo json_encode($GLOBALS['SALE_INPUT_PARAMS']['PROPERTY']);

$arBasketItems = array();

$dbBasketItems = CSaleBasket::GetList(
	array("NAME" => "ASC", "ID" => "ASC"),
	array("LID" => SITE_ID, "ORDER_ID" => $ORDER_ID),
	false,
	false,
	array("ID", "NAME", "CALLBACK_FUNC", "MODULE", "PRODUCT_ID", "QUANTITY", "DELAY", "VAT_RATE", "CAN_BUY", "PRICE", "WEIGHT"
));

while ($arItems = $dbBasketItems->Fetch())
{
	if (strlen($arItems["CALLBACK_FUNC"]) > 0) {
		CSaleBasket::UpdatePrice($arItems["ID"], $arItems["CALLBACK_FUNC"], $arItems["MODULE"], $arItems["PRODUCT_ID"], $arItems["QUANTITY"]);
		$arItems = CSaleBasket::GetByID($arItems["ID"]);
	}

	$arBasketItems[] = $arItems;
}

if (count($arBasketItems) == 0) {
	$basket = CSaleBasket::GetList(array("ID" => "ASC"), array("ORDER_ID" => $ORDER_ID));
}

#--------------------------------------------
$arOrder = CSaleOrder::GetByID($ORDER_ID);
$rsProps = CSaleOrderPropsValue::GetList(($b = ""), ($o = ""), array("ORDER_ID" => $ORDER_ID));

if ($arOrder["PAYED"] == "Y") {
	print GetMessage('COINFIDE_ORDER_PAYED');
	return;
}

while ($arProp = $rsProps->Fetch()) {
	$key = strlen($arProp['CODE']) > 0 ? $arProp["CODE"] : $arProp["ID"];
	$arCurOrderProps[$key] = $arProp["VALUE"];
}

$orderID = "CoinfideOrder_" . $ORDER_ID . "_" . CSaleBasket::GetBasketUserID();


global $USER;
$userData = $USER->GetByID($USER->GetID())->Fetch();
// echo json_encode($userData);

 $user_phone = !empty($userData['PERSONAL_PHONE'])?$userData['PERSONAL_PHONE']:$userData['PERSONAL_MOBILE'];

if(!empty($arCurOrderProps['PHONE']))
	$user_phone = $arCurOrderProps['PHONE'];

$class = 'Coinfide\\Client';
//        $client = new Coinfide\Client(array('trace'=>true));
if (class_exists($class)){
//            $client = new $class()
//            $client = new Coinfide\Client(array('trace'=>true));
    $client = new Coinfide\Client();
}  else {
    throw new \Exception('Error: load Coinfide\Client!');
}

$client->setMode("prod");
$client->setCredentials(CSalePaySystemAction::GetParamValue("API_USERNAME"),CSalePaySystemAction::GetParamValue("API_PASS"));

$corder = new \Coinfide\Entity\Order();
                //seller
                $seller = new \Coinfide\Entity\Account();
                $seller->setEmail(CSalePaySystemAction::GetParamValue("MERCHANT"));
                $corder->setSeller($seller);

                //buyer
                $buyer = new \Coinfide\Entity\Account();
                $buyer->setEmail($USER->GetEmail());
                $buyer->setName($USER->GetFirstName());
                $buyer->setSurname($USER->GetLastName());
                $buyer->setLanguage(CSalePaySystemAction::GetParamValue("LANGUAGE"));
                $buyer->setBirthDate('19750101000000');
                $phone = new \Coinfide\Entity\Phone();
                $phone ->setFullNumber((string)preg_replace('/[^\d]+/','',$user_phone));
                $buyer->setPhone($phone);
        $baddress = new \Coinfide\Entity\Address();
        //todo adress!!!
        $baddress->setCity('MOSCOW');

//        $baddress->setCity($GLOBALS['SALE_INPUT_PARAMS']['PROPERTY']['LOCATION_CITY']);
        $baddress->setFirstAddressLine("Test Street 1");
//        $baddress->setFirstAddressLine($GLOBALS['SALE_INPUT_PARAMS']['PROPERTY']['LOCATION']);
//        $baddress->setPostalCode($userData['PERSONAL_ZIP']);
$baddress->setPostalCode($GLOBALS['SALE_INPUT_PARAMS']['PROPERTY']['ZIP']);

        $baddress->setCountryCode("RU");
        $buyer->setAddress($baddress);
        $corder->setBuyer($buyer);
        $corder->setCurrencyCode($currency);

        $corder->setExternalOrderId($orderID);

//$successUrl = CSalePaySystemAction::GetParamValue("SUCCESS_URL");
//if (empty($successUrl)) {
    $successUrl = ($_SERVER['HTTPS'] ? 'https' : 'http' ) . '://' . $_SERVER['HTTP_HOST'] .  '/bitrix/tools/coinfide.coinfide/result_payment.php';
//}
//$failUrl = CSalePaySystemAction::GetParamValue("FAIL_URL");
//if (empty($successUrl)) {
    $failUrl = ($_SERVER['HTTPS'] ? 'https' : 'http' ) . '://' . $_SERVER['HTTP_HOST'] .  '/bitrix/tools/coinfide.coinfide/fail.php?externalOrderId='.$orderID;
//}

         $corder->setSuccessUrl($successUrl);
        $corder->setFailUrl($failUrl);


//$useVat = CSalePaySystemAction::GetParamValue("USE_VAT");
//$vatRate = CSalePaySystemAction::GetParamValue("VAT_RATE");

//if (empty($useVat)) {
//    $useVat = 'NET';
//}

foreach ($arBasketItems as $val)
{
//    if ($val['VAT_RATE'] != '0.00') {
//        $useVat = 'GROSS';
//        $vatRate = '19';
//    }

//    $forSend['ORDER_VAT'][]   = $vatRate;
//    $forSend['ORDER_PRICE_TYPE'][] = $useVat;
    $citem = new \Coinfide\Entity\OrderItem();
    $citem->setName($val['NAME'] ?: 'unknown');
    $citem->setType('I');
    $citem->setQuantity($val['QUANTITY']);

    $citem->setPriceUnit(number_format($val['PRICE'], 2, '.', ''));
    $corder->addOrderItem($citem);
}

$citem = new \Coinfide\Entity\OrderItem();
$citem->setName('Shipping');
$citem->setType('S');
$citem->setQuantity(1);
$citem->setPriceUnit(number_format($arOrder['PRICE_DELIVERY'], 2, '.', ''));
$corder->addOrderItem($citem);



$corder->validate();
//echo json_encode((array)$corder);
$response_data = $client->submitOrder($corder);

?>

<?//=GetMessage('COINFIDE_DESCRIPTION_PS')?><!-- <b>www.coinfide.com</b>.<br /><br />-->
<?//=GetMessage('COINFIDE_DESCRIPTION_SUM')?><!--: <b>--><?//=CurrencyFormat($amount, $currency).' '.$currency ?><!--</b><br /><br />-->
<!--<form method="POST" action="--><?//=$response_data->getRedirectUrl()?><!--" accept-charset="utf-8">-->
<!--    <input type="submit" value="--><?//=GetMessage("COINFIDE_PAY")?><!--"/>-->
<!--</form>-->
<a href="<?=$response_data->getRedirectUrl()?>" class="button"><?=GetMessage("COINFIDE_PAY")?></a>

<style>
    a.button {
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
    }
</style>