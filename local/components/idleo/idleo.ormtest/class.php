<?php
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Query\Join;
use Bitrix\Main;
use Bitrix\Main\Entity;
use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Grid\Options as GridOptions;
use Bitrix\Main\UI\PageNavigation;

include('classes/archiveItem.php');

class idleo_ormtest extends CBitrixComponent
{
    public function test()
    {
        $er['Test'] = 'TEST';
        return $ar;
    }

    public function executeComponent()
    {
        $this->arResult = array_merge($this->arResult, $this->test());
        $this->includeComponentTemplate();
    }
};
