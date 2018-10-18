<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
?>
<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
<div class="review-block">
	<div class="review-text">
		<div class="review-text-cont">
		<?if($arResult["NAV_RESULT"]):?>
			<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
			<?echo $arResult["NAV_TEXT"];?>
			<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
		<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
			<?echo $arResult["DETAIL_TEXT"];?>
		<?else:?>
			<?echo $arResult["PREVIEW_TEXT"];?>
		<?endif?>
		</div>
		<div class="review-autor">
		<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		<?=$arResult["NAME"]?>
	<?endif;?>, <?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<?=$arResult["DISPLAY_ACTIVE_FROM"]?>
	<?endif;?>,
	<?if(isset($arResult['DISPLAY_PROPERTIES'])):?><?echo $arResult['DISPLAY_PROPERTIES']['COMPANY']['DISPLAY_VALUE']?><?endif?>, 
	<?if(isset($arResult['DISPLAY_PROPERTIES'])):?><?echo $arResult['DISPLAY_PROPERTIES']['POSITION']['DISPLAY_VALUE']?><?endif?>.
		</div>
	</div>
	<div style="clear: both;" class="review-img-wrap">
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		<img
			src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
			alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
			/>
		<?else:?>
		<img
				src="<?echo SITE_TEMPLATE_PATH . '/components/bitrix/news/rew/images/no_photo.jpg'?>"					
				alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"					
				/>
	<?endif?></div>
</div>
<?if(isset($arResult['DISPLAY_PROPERTIES']['FILES'])):?>
	<div class="exam-review-doc">
	<p>Документы:</p>
	<?foreach($arResult['DISPLAY_PROPERTIES']['FILES']['FILE_VALUE'] as $arItem):?>
		<div  class="exam-review-item-doc"><img class="rew-doc-ico" src="<?=SITE_TEMPLATE_PATH?>/img/icons/pdf_ico_40.png"><a href="<?echo $arItem['SRC']?>"><?echo $arItem['ORIGINAL_NAME']?></a></div>
	<?endforeach?>
	</div>
	<hr>
	<!-- <a href="" class="review-block_back_link"> &larr; К списку отзывов</a> -->
<?endif?>
