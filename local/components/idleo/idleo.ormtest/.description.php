<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("T_IBLOCK_ORMTEST_LIST"),
	"DESCRIPTION" => GetMessage("T_IBLOCK_ORMTEST_DESC"),
	"CACHE_PATH" => "Y",
	"SORT" => 40,
	"PATH" => array(
		"ID" => "content",
		"CHILD" => array(
			"ID" => "ormtest",
			"NAME" => GetMessage("T_IBLOCK_ORMTEST"),
			"SORT" => 20,
		)
	),
);
?>