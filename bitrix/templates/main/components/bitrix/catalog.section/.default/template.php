<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Catalog\ProductTable;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 *
 *  _________________________________________________________________________
 * |	Attention!
 * |	The following comments are for system use
 * |	and are required for the component to work correctly in ajax mode:
 * |	<!-- items-container -->
 * |	<!-- pagination-container -->
 * |	<!-- component-end -->
 */

$this->setFrameMode(true);
$this->addExternalCss('/bitrix/css/main/bootstrap.css');

if (!empty($arResult['NAV_RESULT']))
{
	$navParams =  array(
		'NavPageCount' => $arResult['NAV_RESULT']->NavPageCount,
		'NavPageNomer' => $arResult['NAV_RESULT']->NavPageNomer,
		'NavNum' => $arResult['NAV_RESULT']->NavNum
	);
}
else
{
	$navParams = array(
		'NavPageCount' => 1,
		'NavPageNomer' => 1,
		'NavNum' => $this->randString()
	);
}

$showTopPager = false;
$showBottomPager = false;
$showLazyLoad = false;

if ($arParams['PAGE_ELEMENT_COUNT'] > 0 && $navParams['NavPageCount'] > 1)
{
	$showTopPager = $arParams['DISPLAY_TOP_PAGER'];
	$showBottomPager = $arParams['DISPLAY_BOTTOM_PAGER'];
	$showLazyLoad = $arParams['LAZY_LOAD'] === 'Y' && $navParams['NavPageNomer'] != $navParams['NavPageCount'];
}

$templateLibrary = array('popup', 'ajax', 'fx');
$currencyList = '';

if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList,
	'USE_PAGINATION_CONTAINER' => $showTopPager || $showBottomPager,
);
unset($currencyList, $templateLibrary);

$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
$elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

$positionClassMap = array(
	'left' => 'product-item-label-left',
	'center' => 'product-item-label-center',
	'right' => 'product-item-label-right',
	'bottom' => 'product-item-label-bottom',
	'middle' => 'product-item-label-middle',
	'top' => 'product-item-label-top'
);

$discountPositionClass = '';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION']))
{
	foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos)
	{
		$discountPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$labelPositionClass = '';
if (!empty($arParams['LABEL_PROP_POSITION']))
{
	foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos)
	{
		$labelPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$arParams['~MESS_BTN_BUY'] = ($arParams['~MESS_BTN_BUY'] ?? '') ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_BUY');
$arParams['~MESS_BTN_DETAIL'] = ($arParams['~MESS_BTN_DETAIL'] ?? '') ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_DETAIL');
$arParams['~MESS_BTN_COMPARE'] = ($arParams['~MESS_BTN_COMPARE'] ?? '') ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_COMPARE');
$arParams['~MESS_BTN_SUBSCRIBE'] = ($arParams['~MESS_BTN_SUBSCRIBE'] ?? '') ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_SUBSCRIBE');
$arParams['~MESS_BTN_ADD_TO_BASKET'] = ($arParams['~MESS_BTN_ADD_TO_BASKET'] ?? '') ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_ADD_TO_BASKET');
$arParams['~MESS_NOT_AVAILABLE'] = ($arParams['~MESS_NOT_AVAILABLE'] ?? '') ?: Loc::getMessage('CT_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE');
$arParams['~MESS_NOT_AVAILABLE_SERVICE'] = ($arParams['~MESS_NOT_AVAILABLE_SERVICE'] ?? '') ?: Loc::getMessage('CP_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE_SERVICE');
$arParams['~MESS_SHOW_MAX_QUANTITY'] = ($arParams['~MESS_SHOW_MAX_QUANTITY'] ?? '') ?: Loc::getMessage('CT_BCS_CATALOG_SHOW_MAX_QUANTITY');
$arParams['~MESS_RELATIVE_QUANTITY_MANY'] = ($arParams['~MESS_RELATIVE_QUANTITY_MANY'] ?? '') ?: Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = ($arParams['MESS_RELATIVE_QUANTITY_MANY'] ?? '') ?: Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['~MESS_RELATIVE_QUANTITY_FEW'] = ($arParams['~MESS_RELATIVE_QUANTITY_FEW'] ?? '') ?: Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_FEW');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = ($arParams['MESS_RELATIVE_QUANTITY_FEW'] ?? '') ?: Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_FEW');

$arParams['MESS_BTN_LAZY_LOAD'] = $arParams['MESS_BTN_LAZY_LOAD'] ?: Loc::getMessage('CT_BCS_CATALOG_MESS_BTN_LAZY_LOAD');

$obName = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $this->GetEditAreaId($navParams['NavNum']));
$containerName = 'container-'.$navParams['NavNum'];
$value = (empty($_REQUEST["sort_by"])) ? "price" : "";
?>		
		
<div class="products">
	<div class="sort">
		<h2 style="font-size: 24px; margin-right: auto; margin-bottom: 0;">Таблица модификаций <?=CIBlockSection::GetByID($arResult["ITEMS"][0]["IBLOCK_SECTION_ID"])->GetNext()['NAME']?></h2>
		<div class="dropdown">
			<button id="sort_menu_title" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
				Сортировать по
			</button>
			<ul class="dropdown-menu" id="sort_menu" aria-labelledby="dropdownMenuButton1">
				<li><a class="dropdown-item" href="<?=$APPLICATION->GetCurPageParam("sort_by=".$value, array("sort_by"))?>">Цене</a></li>				
			</ul>
		</div>
		<p>Количество товаров: <span id="count_products"><?=count($arResult["ITEMS"])?></span></p>
	</div>
	<div class="row big_row">
		<div class="col">
			Название
			
		</div>
		<div class="col">
			Артикул
		</div>
		<div class="col">
			Бренд
		</div>		
		<div class="col">
			DN, мм
			<p class="aditeonal_text" style="width: 215px;">DN - внутренний диаметр</p>
		</div>
		<div class="col">
			D (внутр),"
			<p class="aditeonal_text" style="width: 110px;">D - диаметр</p>
		</div>
		<div class="col">
			Bar
			<p class="aditeonal_text" style="width: 130px;">Bar - давление</p>
		</div>
		<div class="col">
			Bar<br>На разрыв
			<p class="aditeonal_text" style="width: 300px;">Bar на разрыв - давление на разрыв</p>
		</div>
		<div class="col">
			R(min),<br>мм
			<p class="aditeonal_text" style="width: 335px;">R min - Минимальный радиус изгиба, мм</p>
		</div>
		<div class="col">
			Вес,кг/м
		</div>
		<div class="col">
			Цена
		</div>
	</div>
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<div class="row row_products big_row">
			<div class="col">
				<div class="row">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
						<?=$arItem["NAME"]?>
					</a> 
				</div>
			</div>
			<div class="col">
				<div class="row">
					<?=$arItem["CODE"]?>
				</div>
			</div>
			<div class="col">
				<div class="row">
					<?=$arItem["PROPERTIES"]["MANUFACTURER"]["VALUE"]?>
				</div>
			</div>			
			<div class="col">
				<div class="row">
					<?=$arItem["PROPERTIES"]["DN"]["VALUE"]?>
				</div>
			</div>
			<div class="col">
				<div class="row">
					<?=$arItem["PROPERTIES"]["DIAM_IN"]["VALUE"]?>
				</div>
			</div>
			<div class="col">
				<div class="row">
					<?=$arItem["PROPERTIES"]["BAR"]["VALUE"]?>
				</div>
			</div>
			<div class="col">
				<div class="row">
					<?=$arItem["PROPERTIES"]["BAR_GAP"]["VALUE"]?>
				</div>
			</div>
			<div class="col">
				<div class="row">
					<?=$arItem["PROPERTIES"]["R_MIN"]["VALUE"]?>
				</div>
			</div>
			<div class="col">
				<div class="row">
					<?=$arItem["PROPERTIES"]["WEIGHT"]["VALUE"]?>
				</div>
			</div>
			<div class="col">
				<div class="row">
					<?=$arItem["PROPERTIES"]["PRICE"]["VALUE"]?> <?=(!empty($arItem["PROPERTIES"]["PRICE"]["VALUE"])) ? 'руб.' : ''?>
				</div>
			</div>
		</div>	
	<?endforeach?>			
</div>