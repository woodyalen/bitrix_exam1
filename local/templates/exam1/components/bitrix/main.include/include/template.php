<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$file_in = file_get_contents($arResult['FILE']);

if($arResult["FILE"] <> ''):?>
<?if(strlen($file_in) > 0):?>
	<div class="side-block side-anonse">
		<div class="title-block"><span class="i i-title01"></span>Полезная информация!</div>
		<div class="item">
			<p>
				<?include($arResult["FILE"]);?>
			</p>
		</div>
	</div>
<?endif?>
<?endif?>