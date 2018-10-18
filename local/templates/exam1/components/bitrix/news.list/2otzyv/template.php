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
<div class="rew-footer-carousel">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<?//echo "<pre>", var_dump($arItem), "</pre>"?>
	<div class="item">
		<div class="side-block side-opin">
			<div class="inner-block">
				<div class="title">
					<div class="photo-block">
					<?
					//изменили размер.
					$newWidth = 39;
					$newHeight = 39;
					$renderImage = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array("width" => $newWidth, "height" => $newHeight));
	//echo "<pre>", var_dump($renderImage), "</pre>"
					
					echo CFile::ShowImage($renderImage['src'], $newWidth, $newHeight, "border=0", "", true);?>
					 <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
							<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
								<img									
										src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"/></a>
							<?else:?>
								<img								
									src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"/>
							<?endif;?>
						<?else:?>
							<img src="<?=SITE_TEMPLATE_PATH?>/components/bitrix/news.list/2otzyv/image/no_photo_left_block.jpg"/>
					<?endif?>
					</div>
					<div class="name-block"><a href=""><?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="/rew/index.php?ELEMENT_ID=<?echo $arItem["ID"]?>"><?echo $arItem["NAME"]?></a>
			<?else:?>
				<?echo $arItem["NAME"]?>
			<?endif;?>
		<?endif;?></a></div>
					<div class="pos-block">
					<?if(isset($arItem[DISPLAY_PROPERTIES])):?><?=$arItem['DISPLAY_PROPERTIES']['POSITION']['DISPLAY_VALUE'] . ", "?><?endif?>
					<?if(isset($arItem[DISPLAY_PROPERTIES])):?><?=$arItem['DISPLAY_PROPERTIES']['COMPANY']['DISPLAY_VALUE']?><?endif?>
					</div>
				</div>
				<div class="text-block">
					<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
					<?echo $arItem["PREVIEW_TEXT"];?>
					<?endif;?>
				</div>
			</div>
		</div>
	</div>
<?endforeach;?>
</div>
