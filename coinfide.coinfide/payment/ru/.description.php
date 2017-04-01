<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
global $MESS;
$MESS['COINFIDE_PSTITLE'] = 'CoinFide Payment';
$MESS['COINFIDE_PSDESCR'] = 'Приём платежей с помощью Coinfide <a href="https://www.coinfide.com/" target="_blank">https://www.coinfide.com/</a> <br>
Для функционирования IPN (мгновенное уведомление об оплате) в личном кабинете Coinfide в настройках Вашего аккаунта укажите<br>
<b>COINFIDE_IPN_LINK</b><br>';
$MESS["COINFIDE_MERCHANT"] = "Идентификатор мерчанта (Login-name)";
$MESS["COINFIDE_API_USERNAME"] = "API username";
$MESS["COINFIDE_API_PASS"] = "API password";
$MESS["COINFIDE_API_KEY"] = "API secret key";

$MESS["COINFIDE_IPN_LINK"] = "Сcылка для IPN протокола";
$MESS["COINFIDE_IPN_LINK_DESC"] = "<b>Поле только для чтения. Полный путь до скрипта IPN.</b> Необходимо указать эту ссылку в Личном кабинете мерчанта.\";";

$MESS["COINFIDE_SUCCESS_URL"] = "Ссылка возврата клиента после успешного платежа";
$MESS["COINFIDE_DESC_SUCCESS_URL"] = "<b>Поле только для чтения.</b>Ссылка, на которую вернется клиент после завершения платежа.";

$MESS["COINFIDE_FAIL_URL"] = "Ссылка возврата клиента при отмене платежа";
$MESS["COINFIDE_DESC_FAIL_URL"] = "<b>Поле только для чтения.</b>Ссылка, на которую вернется клиент после не удачного платежа или отмены платежа.";

$MESS["COINFIDE_PRICE_CURRENCY"] = "Валюта платежа";
$MESS["COINFIDE_DESC_PRICE_CURRENCY"] = "<b style='color=#aeaeae;'>Внимание!</b> Это значение должно соответствовать валюте вашего мерчанта: (TS1 для тестового мерчанта)";
$MESS["SHOULD_PAY"] = "Сумма заказа";
$MESS["SHOULD_PAY_DESCR"] = "Сумма к оплате";
$MESS["COINFIDE_DEBUG_MODE"] = "Включить режим отладки";
$MESS["COINFIDE_DESC_DEBUG_MODE"] = "(1 - отладка включена, 0 - отладка выключена)";
$MESS['COINFIDE_YES'] = "Да";
$MESS['COINFIDE_NO'] = "Нет";

$MESS["COINFIDE_LANGUAGE"] = "Язык страницы платежной системы";
$MESS["COINFIDE_DESC_LANGUAGE"] = "Например : ru";


$MESS['COINFIDE_BILL_FNAME'] = "Ваше имя:";
$MESS['COINFIDE_BILL_LNAME'] = "Ваша фамилия:";
$MESS['COINFIDE_BILL_EMAIL'] = "Ваш E-mail:";
$MESS['COINFIDE_BILL_PHONE'] = "Ваш Телефон:";
$MESS['COINFIDE_BILL_COUNTRYCODE'] = '<span style="display:inline-block;max-width: 100px;vertical-align: middle;">Код страны в международном формате(RU,UK,KZ):</span>';


$MESS['COINFIDE_DESCRIPTION_PS'] = 'Вы хотите оплатить через систему';
$MESS['COINFIDE_DESCRIPTION_SUM'] = 'Сумма к оплате по счету';
$MESS["COINFIDE_PAY"] = "Оплатить";
$MESS['COINFIDE_ORDER_PAYED'] = 'Заказ уже оплачен';

?>