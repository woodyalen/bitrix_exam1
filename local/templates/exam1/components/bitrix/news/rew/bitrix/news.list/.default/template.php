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


<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>	
	<?//echo SITE_TEMPLATE_PATH?>
	<?//echo "<pre>", var_dump($arItem), "</pre>"?>
	<div class="review-block">
		<div class="review-text">
		
			<div class="review-block-title"><span class="review-block-name"><?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a>
			<?else:?>
				<?echo $arItem["NAME"]?>
			<?endif;?>
		<?endif;?></span><span class="review-block-description"><?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
			<?echo $arItem["DISPLAY_ACTIVE_FROM"]. ", "?>
		<?endif?>
		<?if(isset($arItem['DISPLAY_PROPERTIES']['POSITION']['VALUE'])):?><?echo $arItem['DISPLAY_PROPERTIES']['POSITION']['VALUE'] . ", "?><?endif?>
		<?if(isset($arItem['DISPLAY_PROPERTIES']['COMPANY']['VALUE'])):?><?echo $arItem['DISPLAY_PROPERTIES']['COMPANY']['VALUE']?><?endif?>		
		</span></div>
			
			<div class="review-text-cont">
				<?echo $arItem['DETAIL_TEXT']?>
			</div>
		</div>
		<div style="clear: both;"  class="review-img-wrap"><?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
				<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
					<img
						src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
						alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
						/></a>
				<?else:?>
					<img
						src="<?echo SITE_TEMPLATE_PATH . '/components/bitrix/news/rew/images/no_photo.jpg'?>"
						alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
						/>
				<?endif;?>
			<?else:?>
			<img
					src="<?echo SITE_TEMPLATE_PATH . '/components/bitrix/news/rew/images/no_photo.jpg'?>"					
					alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"					
					/>
		<?endif?></div>
	</div>
	
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>

