<?php
/**
 * Add userfields to deal entity
 */
use \Fusion\Tools\Console;
use \Bitrix\Main\Config\Option;

$arFields = [
	[
		'FIELD_NAME'    => 'UF_REGION_CODE',
		'USER_TYPE_ID'  => 'string',
		'XML_ID'        => 'AD_REGION_CODE',
		'MULTIPLE'      => 'N',
		'MANDATORY'     => 'N',
		'SHOW_FILTER'   => 'I',
		'SHOW_IN_LIST'  => '',
		'EDIT_IN_LIST'  => 'Y',
		'IS_SEARCHABLE' => 'Y',
		'SETTINGS'      => [],
		'LABELS'        => [
			'ru' => 'Код региона',
			'en' => 'Region code'
		],
	],
];

$arLabels = [
	'EDIT_FORM_LABEL',
	'LIST_COLUMN_LABEL',
	'LIST_FILTER_LABEL',
	'ERROR_MESSAGE',
	'HELP_MESSAGE'
];

$model = new \CUserTypeEntity();

Console::write("Добавляем пользовательские поля для пользователя", 'green');

foreach ($arFields as $arField)
{
	$arField['ENTITY_ID'] = 'USER';

	$arFields = \Bitrix\Main\UserFieldTable::getRow([
		'select' => ['ID'],
		'filter' => [
			'=ENTITY_ID'  => $arField['ENTITY_ID'],
			'=FIELD_NAME' => $arField['FIELD_NAME'],
		],
	]);

	if ( $arFields )
	{
		Console::write("Поле ".$arField['FIELD_NAME'].' уже существует');
		continue;
	}

	foreach ($arLabels as $labelField)
	{
		$arField[$labelField] = $arField['LABELS'];
	}

	$values = [];
	if (array_key_exists('VALUES',$arField))
	{
		$values = $arField['VALUES'];
		unset($arField['VALUES']);
	}

	$fieldId = $model->Add($arField);

	if ( !$fieldId )
	{
		Console::write("Не удалось добавить поле ".$arField["FIELD_NAME"].": ".$model->LAST_ERROR, 'red');
		continue;
	}

	Console::write("Поле ".$arField["FIELD_NAME"]." добавлено ");
}