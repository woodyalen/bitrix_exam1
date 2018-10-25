<?
use Bitrix\Main\Localization\Loc,
    Bitrix\Main\Entity;

Loc::loadMessenges(__FILE__);

class idleo_ormtest extends CModule
{
    function __construct()
    {
        $arModuleVersion = [];
        include(__DIR__ . "/version.php");

        $this->MODULE_ID = 'idleo.ormtest';
        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_NAME = $arModuleVersion['VERSION_DATE'];
        $this->
    }
}

?>