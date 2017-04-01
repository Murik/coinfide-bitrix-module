<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

//IncludeModuleLangFile(__FILE__);
include(GetLangFileName(dirname(__FILE__) . "/", "/.description.php"));

// echo GetLangFileName(dirname(__FILE__) . "/", "/.description.php");

$coinfidePublicPath = ($_SERVER['HTTPS'] ? 'https' : 'http' ) . '://' . $_SERVER['HTTP_HOST'] .  '/bitrix/tools/coinfide.coinfide';

$IPNDefaultScript = $coinfidePublicPath . '/ipn.php';
$ResultDefaultScript = $coinfidePublicPath . '/result_payment.php';
$FailDefaultScript = $coinfidePublicPath . '/fail.php';


$psTitle = GetMessage('COINFIDE_PSTITLE');
$psDescription = GetMessage('COINFIDE_PSDESCR', array('COINFIDE_IPN_LINK' => $IPNDefaultScript));


$arPSCorrespondence = array(

    "API_KEY" => array(
        "NAME"  => GetMessage("COINFIDE_API_KEY"),
        "DESCR" => GetMessage("COINFIDE_API_KEY"),
        "VALUE" => "",
        "TYPE"  => "VALUE"
    ),
    "API_PASS" => array(
        "NAME"  => GetMessage("COINFIDE_API_PASS"),
        "DESCR" => GetMessage("COINFIDE_API_PASS"),
        "VALUE" => "",
        "TYPE"  => "VALUE"
    ),
    "API_USERNAME" => array(
        "NAME"  => GetMessage("COINFIDE_API_USERNAME"),
        "DESCR" => GetMessage("COINFIDE_API_USERNAME"),
        "VALUE" => "",
        "TYPE"  => "VALUE"
    ),
	"MERCHANT"       => array(
		"NAME"  => GetMessage("COINFIDE_MERCHANT"),
		"DESCR" => GetMessage("COINFIDE_MERCHANT"),
		"VALUE" => "",
		"TYPE"  => "VALUE"
	),


//    "IPN_URL" => array(
//        "NAME" => GetMessage("COINFIDE_IPN_LINK"),
//        "DESCR" => GetMessage("COINFIDE_IPN_LINK_DESC"),
//        "VALUE" => $IPNDefaultScript,
//        "TYPE" => "STRING",
//    ),
//    "SUCCESS_URL"       => array(
//        "NAME"  => GetMessage("COINFIDE_SUCCESS_URL"),
//        "DESCR" => GetMessage("COINFIDE_DESC_SUCCESS_URL"),
//        "VALUE" => $ResultDefaultScript,
//        "TYPE"  => "STRING"
//    ),
//    "FAIL_URL"       => array(
//        "NAME"  => GetMessage("COINFIDE_FAIL_URL"),
//        "DESCR" => GetMessage("COINFIDE_DESC_FAIL_URL"),
//        "VALUE" => $FailDefaultScript,
//        "TYPE"  => "STRING"
//    ),


//	"DEBUG_MODE"     => array(
//		"NAME"  => GetMessage("COINFIDE_DEBUG_MODE"),
//		"DESCR" => GetMessage("COINFIDE_DESC_DEBUG_MODE"),
//		"VALUE" => array(
//			'Y' =>   array('NAME' => GetMessage("COINFIDE_AUTOMODE_YES")),
//			'N' =>   array('NAME' => GetMessage("COINFIDE_AUTOMODE_NO")),
//		),
//		"TYPE"  => "SELECT"
//	),
	"LANGUAGE"       => array(
		"NAME"  => GetMessage("COINFIDE_LANGUAGE"),
		"DESCR" => GetMessage("COINFIDE_DESC_LANGUAGE"),
		"VALUE" => "ru",
		"TYPE"  => "VALUE"
	),
    "PRICE_CURRENCY" => array(
        "NAME"  => GetMessage("COINFIDE_PRICE_CURRENCY"),
        "DESCR" => GetMessage("COINFIDE_DESC_PRICE_CURRENCY"),
        "VALUE" => "CURRENCY",
        "TYPE"  => "ORDER"
    ),
    'AMOUNT' => array(
        'NAME'  => GetMessage('SHOULD_PAY'),
        'DESCR' => GetMessage('SHOULD_PAY_DESCR'),
        'VALUE' => 'SHOULD_PAY',
        'TYPE'  => 'ORDER'
    ),
);
?>
