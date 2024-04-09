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

<section class="functional">
	<div class="container">
		<h2>Надежные рукава высокого давления</h2>
		<p class="description">запатентованная технология производства</p>
		<div class="wrapper">			
			<?foreach($arResult["ITEMS"] as $key=>$arItem):?>				
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<?if($key == count($arResult["ITEMS"])/2 || $key == 0):?>
				<div class="col">
			<?endif;?>
			<p>
				<img src="<?=CFile::GetPath($arItem["PROPERTIES"]["SVG_IMAGE"]["VALUE"])?>">
				<span>
					<span class="title"><?=$arItem["NAME"]?></span>
					<?=$arItem["PREVIEW_TEXT"]?>
				</span>
			</p>
			<?if($key == count($arResult["ITEMS"])/2-1 || $key == count($arResult["ITEMS"]) - 1):?>
			</div >
			<?endif;?>
			<?endforeach;?>				
		</div>
	</div>
</section>