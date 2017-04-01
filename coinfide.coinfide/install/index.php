<?
IncludeModuleLangFile(__FILE__);

if(class_exists("coinfide_coinfide")) return;

class coinfide_coinfide extends CModule
{
	var $MODULE_ID = "coinfide.coinfide";
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;
	var $strError = '';

	function __construct()
	{
		$arModuleVersion = array();
		include(dirname(__FILE__)."/version.php");
		$this->MODULE_VERSION = $arModuleVersion["VERSION"];
		$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		
		$this->MODULE_NAME        = GetMessage("COINFIDE_PAYMENT_MODULE_NAME");
		$this->MODULE_DESCRIPTION = GetMessage("COINFIDE_PAYMENT_MODULE_DESC");
		$this->PARTNER_NAME       = GetMessage("COINFIDE_PAYMENT_PARTNER_NAME");
		$this->PARTNER_URI        = GetMessage("COINFIDE_PAYMENT_PARTNER_URI");
	}

    function DoInstall()
    {
        $this->InstallFiles();
        RegisterModule($this->MODULE_ID);
        return true;
    }

	function InstallDB()
	{

		return true;
	}

	function rmFolder($dir) {
		foreach(glob($dir . '/*') as $file) {
			if(is_dir($file)){
				$this->rmFolder($file);
			} else {
				$r = unlink($file);
			}
		}
		rmdir($dir);
		return true;
	}

	function copyDir( $source, $destination ) {
		if ( is_dir( $source ) ) {
			@mkdir( $destination, 0755 );
			$directory = dir( $source );
			while ( FALSE !== ( $readdirectory = $directory->read() ) ) {
				if ( $readdirectory == '.' || $readdirectory == '..' ) continue;
				$PathDir = $source . '/' . $readdirectory; 
				if ( is_dir( $PathDir ) ) {
					$this->copyDir( $PathDir, $destination . '/' . $readdirectory );
					continue;
				}
			copy( $PathDir, $destination . '/' . $readdirectory );
			}
			$directory->close();
		} else {
			copy( $source, $destination );
		}
	}

	function InstallFiles($arParams = array())
	{
//		if (is_dir($source = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/install')) {
//			@mkdir($_SERVER['DOCUMENT_ROOT'] . '/bitrix/php_interface/include/sale_payment/', 0777, true);
//
//			$this->copyDir( $source."/payment", $_SERVER['DOCUMENT_ROOT'].'/bitrix/php_interface/include/sale_payment/');
//			$this->copyDir( $source."/tools", $_SERVER['DOCUMENT_ROOT'].'/bitrix/tools/');
//    	}
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/tools", $_SERVER["DOCUMENT_ROOT"]."/bitrix/tools",true,true);
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/sale/payment",  $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/sale/payment",true,true);
        return true;
	}

	function UnInstallFiles()
	{
//		$this->rmFolder($_SERVER['DOCUMENT_ROOT'].'/bitrix/php_interface/include/sale_payment/coinfide/');
        DeleteDirFilesEx('/bitrix/tools/'.$this->MODULE_ID."/");
        DeleteDirFilesEx('/bitrix/modules/sale/payment/coinfide/');

        return true;
	}

	function DoUninstall()
	{
		$this->UnInstallDB();
		$this->UnInstallFiles();
		UnRegisterModule($this->MODULE_ID);
		return true;
	}
	function UnInstallDB()
	{
		return true;
	}
}?>