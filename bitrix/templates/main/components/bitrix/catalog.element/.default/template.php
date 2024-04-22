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
 * @var string $templateFolder
 */

$this->setFrameMode(true);
$this->addExternalCss('/bitrix/css/main/bootstrap.css');

$templateLibrary = array('popup', 'fx', 'ui.fonts.opensans');
$currencyList = '';

if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$haveOffers = !empty($arResult['OFFERS']);

$templateData = [
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList,
	'ITEM' => [
		'ID' => $arResult['ID'],
		'IBLOCK_ID' => $arResult['IBLOCK_ID'],
	],
];
if ($haveOffers)
{
	$templateData['ITEM']['OFFERS_SELECTED'] = $arResult['OFFERS_SELECTED'];
	$templateData['ITEM']['JS_OFFERS'] = $arResult['JS_OFFERS'];
}
unset($currencyList, $templateLibrary);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
	'ID' => $mainId,
	'DISCOUNT_PERCENT_ID' => $mainId.'_dsc_pict',
	'STICKER_ID' => $mainId.'_sticker',
	'BIG_SLIDER_ID' => $mainId.'_big_slider',
	'BIG_IMG_CONT_ID' => $mainId.'_bigimg_cont',
	'SLIDER_CONT_ID' => $mainId.'_slider_cont',
	'OLD_PRICE_ID' => $mainId.'_old_price',
	'PRICE_ID' => $mainId.'_price',
	'DESCRIPTION_ID' => $mainId.'_description',
	'DISCOUNT_PRICE_ID' => $mainId.'_price_discount',
	'PRICE_TOTAL' => $mainId.'_price_total',
	'SLIDER_CONT_OF_ID' => $mainId.'_slider_cont_',
	'QUANTITY_ID' => $mainId.'_quantity',
	'QUANTITY_DOWN_ID' => $mainId.'_quant_down',
	'QUANTITY_UP_ID' => $mainId.'_quant_up',
	'QUANTITY_MEASURE' => $mainId.'_quant_measure',
	'QUANTITY_LIMIT' => $mainId.'_quant_limit',
	'BUY_LINK' => $mainId.'_buy_link',
	'ADD_BASKET_LINK' => $mainId.'_add_basket_link',
	'BASKET_ACTIONS_ID' => $mainId.'_basket_actions',
	'NOT_AVAILABLE_MESS' => $mainId.'_not_avail',
	'COMPARE_LINK' => $mainId.'_compare_link',
	'TREE_ID' => $mainId.'_skudiv',
	'DISPLAY_PROP_DIV' => $mainId.'_sku_prop',
	'DISPLAY_MAIN_PROP_DIV' => $mainId.'_main_sku_prop',
	'OFFER_GROUP' => $mainId.'_set_group_',
	'BASKET_PROP_DIV' => $mainId.'_basket_prop',
	'SUBSCRIBE_LINK' => $mainId.'_subscribe',
	'TABS_ID' => $mainId.'_tabs',
	'TAB_CONTAINERS_ID' => $mainId.'_tab_containers',
	'SMALL_CARD_PANEL_ID' => $mainId.'_small_card_panel',
	'TABS_PANEL_ID' => $mainId.'_tabs_panel'
);
$obName = $templateData['JS_OBJ'] = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);
$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
	: $arResult['NAME'];
$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']
	: $arResult['NAME'];
$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
	: $arResult['NAME'];

if ($haveOffers)
{
	$actualItem = $arResult['OFFERS'][$arResult['OFFERS_SELECTED']] ?? reset($arResult['OFFERS']);
	$showSliderControls = false;

	foreach ($arResult['OFFERS'] as $offer)
	{
		if ($offer['MORE_PHOTO_COUNT'] > 1)
		{
			$showSliderControls = true;
			break;
		}
	}
}
else
{
	$actualItem = $arResult;
	$showSliderControls = $arResult['MORE_PHOTO_COUNT'] > 1;
}

$skuProps = array();
$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
$measureRatio = $actualItem['ITEM_MEASURE_RATIOS'][$actualItem['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
$showDiscount = $price['PERCENT'] > 0;

if ($arParams['SHOW_SKU_DESCRIPTION'] === 'Y')
{
	$skuDescription = false;
	foreach ($arResult['OFFERS'] as $offer)
	{
		if ($offer['DETAIL_TEXT'] != '' || $offer['PREVIEW_TEXT'] != '')
		{
			$skuDescription = true;
			break;
		}
	}
	$showDescription = $skuDescription || !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
}
else
{
	$showDescription = !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
}

$showBuyBtn = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
$buyButtonClassName = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showAddBtn = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);
$showButtonClassName = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showSubscribe = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($arResult['PRODUCT']['SUBSCRIBE'] === 'Y' || $haveOffers);
$productType = $arResult['PRODUCT']['TYPE'];

$arParams['MESS_BTN_BUY'] = $arParams['MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCE_CATALOG_BUY');
$arParams['MESS_BTN_ADD_TO_BASKET'] = $arParams['MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCE_CATALOG_ADD');

if ($arResult['MODULES']['catalog'] && $arResult['PRODUCT']['TYPE'] === ProductTable::TYPE_SERVICE)
{
	$arParams['~MESS_NOT_AVAILABLE'] = $arParams['~MESS_NOT_AVAILABLE_SERVICE']
		?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE_SERVICE')
	;
	$arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE_SERVICE']
		?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE_SERVICE')
	;
}
else
{
	$arParams['~MESS_NOT_AVAILABLE'] = $arParams['~MESS_NOT_AVAILABLE']
		?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE')
	;
	$arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE']
		?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE')
	;
}

$arParams['MESS_BTN_COMPARE'] = $arParams['MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCE_CATALOG_COMPARE');
$arParams['MESS_PRICE_RANGES_TITLE'] = $arParams['MESS_PRICE_RANGES_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_PRICE_RANGES_TITLE');
$arParams['MESS_DESCRIPTION_TAB'] = $arParams['MESS_DESCRIPTION_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_DESCRIPTION_TAB');
$arParams['MESS_PROPERTIES_TAB'] = $arParams['MESS_PROPERTIES_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_PROPERTIES_TAB');
$arParams['MESS_COMMENTS_TAB'] = $arParams['MESS_COMMENTS_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_COMMENTS_TAB');
$arParams['MESS_SHOW_MAX_QUANTITY'] = $arParams['MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCE_CATALOG_SHOW_MAX_QUANTITY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = $arParams['MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = $arParams['MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_FEW');

$positionClassMap = array(
	'left' => 'product-item-label-left',
	'center' => 'product-item-label-center',
	'right' => 'product-item-label-right',
	'bottom' => 'product-item-label-bottom',
	'middle' => 'product-item-label-middle',
	'top' => 'product-item-label-top'
);

$discountPositionClass = 'product-item-label-big';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION']))
{
	foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos)
	{
		$discountPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$labelPositionClass = 'product-item-label-big';
if (!empty($arParams['LABEL_PROP_POSITION']))
{
	foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos)
	{
		$labelPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}
?>

<div class="catalog">
    <div class="container container_big ">
        <h1><?=$arResult["NAME"]?></h1>
        <div class="catalog_top">
            <div class="slider_container">
                <div id="carouselCatalog" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button style="background-image: url(<?=CFile::GetPath($arResult["PROPERTIES"]["IMAGE_1"]["VALUE"])?>);" type="button" data-bs-target="#carouselCatalog" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button style="background-image: url(<?=CFile::GetPath($arResult["PROPERTIES"]["IMAGE_2"]["VALUE"])?>);" type="button" data-bs-target="#carouselCatalog" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button style="background-image: url(<?=CFile::GetPath($arResult["PROPERTIES"]["IMAGE_3"]["VALUE"])?>);" type="button" data-bs-target="#carouselCatalog" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        <button style="background-image: url(<?=CFile::GetPath($arResult["PROPERTIES"]["IMAGE_4"]["VALUE"])?>);" type="button" data-bs-target="#carouselCatalog" data-bs-slide-to="3" aria-label="Slide 4"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?=CFile::GetPath($arResult["PROPERTIES"]["IMAGE_1"]["VALUE"])?>" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="<?=CFile::GetPath($arResult["PROPERTIES"]["IMAGE_2"]["VALUE"])?>" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="<?=CFile::GetPath($arResult["PROPERTIES"]["IMAGE_3"]["VALUE"])?>" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="<?=CFile::GetPath($arResult["PROPERTIES"]["IMAGE_4"]["VALUE"])?>" class="d-block w-100" alt="...">
                        </div>
                    </div>
                </div>
            </div>
			<?
			function captionF($caption) {
				$encoding = 'UTF-8';
				$needMAXlength = '128'; 
				$caption = $caption . ' '; 
				$capI = 0;
				do {
					$captionarr[$capI] = mb_substr($caption, 0, $needMAXlength, $encoding);
					$captionarr[$capI] = mb_strrchr($captionarr[$capI], ' ', TRUE, $encoding);
					$caption = str_replace($captionarr[$capI], '', $caption);
					$capI++;
				} while (mb_strlen($caption, $encoding) > 1); 
				return $captionarr;
			}
			$new_text = captionF($arResult["DETAIL_TEXT"]);
			?>
            <div class="text_container">
                <div class="accordion" id="accordionExample1">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                <?=$new_text[0]?> 
                            </button>
                        </h2>
                        <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample1">
                            <div class="accordion-body">
                                <p><?for ($i=1; $i < count($new_text); $i++) { 
									echo $new_text[$i];
								}?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion accordion_c" id="accordionExample1">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                            <ul class="characteristics">
                                <p class="title">Технические характеристики</p>
                                <li>
                                    <span>DN:</span>
                                    <span><?=$arResult["PROPERTIES"]["DN"]["VALUE"]?></span>
                                </li>
                                <li>
                                    <span>D (внутр.), ":</span>
                                    <span><?=$arResult["PROPERTIES"]["DIAM_IN"]["VALUE"]?></span>
                                </li>
                                <li>
                                    <span>Bar:</span>
                                    <span><?=$arResult["PROPERTIES"]["BAR"]["VALUE"]?></span>
                                </li>
                                <li>
                                    <span>Bar на разрыв:</span>
                                    <span><?=$arResult["PROPERTIES"]["BAR_GAP"]["VALUE"]?></span>
                                </li>
                                <li>
                                    <span>R min, мм:</span>
                                    <span><?=$arResult["PROPERTIES"]["R_MIN"]["VALUE"]?></span>
                                </li>
                                <li>
                                    <span>Вес, кг/м:</span>
                                    <span><?=$arResult["PROPERTIES"]["WEIGHT"]["VALUE"]?></span>
                                </li>
                            </ul>
                            </button>
                        </h2>
                        <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample3">
                            <div class="accordion-body">
                                <li>
                                    <span>Рабочее давление:</span>
                                    <span><?=$arResult["PROPERTIES"]["WORK_PRESSURE"]["VALUE"]?></span>
                                </li>
                                <li>
                                    <span>Материал:</span>
                                    <span><?=$arResult["PROPERTIES"]["MATERIAL"]["VALUE"]?></span>
                                </li>
                                <li>
                                    <span>Материал внутреннего слоя:</span>
                                    <span><?=$arResult["PROPERTIES"]["MATERIAL_IN"]["VALUE"]?></span>
                                </li>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="prices">
					<?
					$price = $arResult["PROPERTIES"]["PRICE"]["VALUE"];
					if(!empty($arResult["PROPERTIES"]["PRICE"]["VALUE"])){
						$price = ($arResult["PROPERTIES"]["PRICE"]["VALUE"] * (100 - intval($arResult["PROPERTIES"]["DISCOUNT"]["VALUE"])))/100;
					}
					?>					
                    <p class="active"><?=$price?> руб.</p>
					<?if(!empty($arResult["PROPERTIES"]["DISCOUNT"]["VALUE"])):?>
                    <p><?=$arResult["PROPERTIES"]["PRICE"]["VALUE"]?> руб.</p>
					<?endif;?>
                </div>
                <button class="add_to_cart" id="add_to_cart" data-prodid="<?=$arResult["NAME"]."|".$arResult["CODE"]?>" data-bs-toggle="modal" data-bs-target="#footerModal2">Заказать</button>
            </div>
        </div>
        <div class="catalog_middle">
            <div class="buttons_container">
                <button data-target="1" class="switch active">Технические характеристики</button>
                <button data-target="2" class="switch">Описание</button>
            </div>
            <div id="box_1" class="box active">
                <ul class="characteristics">
                    <p class="title">Технические характеристики</p>
					
                    <li>
						<span>DN:</span>
						<span><?=$arResult["PROPERTIES"]["DN"]["VALUE"]?></span>
					</li>
					<li>
						<span>D (внутр.), ":</span>
						<span><?=$arResult["PROPERTIES"]["DIAM_IN"]["VALUE"]?></span>
					</li>
					<li>
						<span>Bar:</span>
						<span><?=$arResult["PROPERTIES"]["BAR"]["VALUE"]?></span>
					</li>
					<li>
						<span>Bar на разрыв:</span>
						<span><?=$arResult["PROPERTIES"]["BAR_GAP"]["VALUE"]?></span>
					</li>
					<li>
						<span>R min, мм:</span>
						<span><?=$arResult["PROPERTIES"]["R_MIN"]["VALUE"]?></span>
					</li>
					<li>
						<span>Вес, кг/м:</span>
						<span><?=$arResult["PROPERTIES"]["WEIGHT"]["VALUE"]?></span>
					</li>
                </ul>
            </div>
            <div id="box_2" class="box">
                <p>
                    <?=$arResult["DETAIL_TEXT"]?> 
                </p>
            </div>
        </div>
		<?
		$res = CIBlockSection::GetByID($arResult["IBLOCK_SECTION_ID"]);
		if($ar_res = $res->GetNext())
			$sec_id = $ar_res['IBLOCK_SECTION_ID'];
		?>
        <?$APPLICATION->IncludeComponent(
			"bitrix:catalog.section", 
			"listing_detail", 
			array(
				"ACTION_VARIABLE" => "action",
				"ADD_PICT_PROP" => "-",
				"ADD_PROPERTIES_TO_BASKET" => "Y",
				"ADD_SECTIONS_CHAIN" => "N",
				"ADD_TO_BASKET_ACTION" => "ADD",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_ADDITIONAL" => "",
				"AJAX_OPTION_HISTORY" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"BACKGROUND_IMAGE" => "-",
				"BASKET_URL" => "/personal/basket.php",
				"BROWSER_TITLE" => "-",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "Y",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"COMPATIBLE_MODE" => "N",
				"CONVERT_CURRENCY" => "N",
				"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
				"DETAIL_URL" => "",
				"DISABLE_INIT_JS_IN_COMPONENT" => "N",
				"DISPLAY_BOTTOM_PAGER" => "Y",
				"DISPLAY_COMPARE" => "N",
				"DISPLAY_TOP_PAGER" => "N",
				"ELEMENT_SORT_FIELD" => "sort",
				"ELEMENT_SORT_FIELD2" => "id",
				"ELEMENT_SORT_ORDER" => "RAND",
				"ELEMENT_SORT_ORDER2" => "desc",
				"ENLARGE_PRODUCT" => "STRICT",
				"FILTER_NAME" => "arrFilter",
				"HIDE_NOT_AVAILABLE" => "N",
				"HIDE_NOT_AVAILABLE_OFFERS" => "N",
				"IBLOCK_ID" => "23",
				"IBLOCK_TYPE" => "catalog",
				"INCLUDE_SUBSECTIONS" => "Y",
				"LABEL_PROP" => array(
				),
				"LAZY_LOAD" => "N",
				"LINE_ELEMENT_COUNT" => "3",
				"LOAD_ON_SCROLL" => "N",
				"MESSAGE_404" => "",
				"MESS_BTN_ADD_TO_BASKET" => "В корзину",
				"MESS_BTN_BUY" => "Купить",
				"MESS_BTN_DETAIL" => "Подробнее",
				"MESS_BTN_LAZY_LOAD" => "Показать ещё",
				"MESS_BTN_SUBSCRIBE" => "Подписаться",
				"MESS_NOT_AVAILABLE" => "Нет в наличии",
				"MESS_NOT_AVAILABLE_SERVICE" => "Недоступно",
				"META_DESCRIPTION" => "-",
				"META_KEYWORDS" => "-",
				"OFFERS_LIMIT" => "5",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => ".default",
				"PAGER_TITLE" => "Товары",
				"PAGE_ELEMENT_COUNT" => "18",
				"PARTIAL_PRODUCT_PROPERTIES" => "N",
				"PERSONAL_SECTION_ID" => "0",
				"PRICE_CODE" => array(
				),
				"PRICE_VAT_INCLUDE" => "Y",
				"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
				"PRODUCT_ID_VARIABLE" => "id",
				"PRODUCT_PROPERTIES" => array(
				),
				"PRODUCT_PROPS_VARIABLE" => "prop",
				"PRODUCT_QUANTITY_VARIABLE" => "quantity",
				"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
				"PRODUCT_SUBSCRIPTION" => "Y",
				"PROPERTY_CODE" => array(
					0 => "BAR",
					1 => "BAR_GAP",
					2 => "DIAM_IN",
					3 => "DN",
					4 => "R_MIN",
					5 => "WEIGHT",
					6 => "MANUFACTURER",
					7 => "DISCOUNT",
					8 => "PRICE",
					9 => "IMAGE_1",
					10 => "",
				),
				"PROPERTY_CODE_MOBILE" => array(
					0 => "BAR",
					1 => "BAR_GAP",
					2 => "DIAM_IN",
					3 => "DN",
					4 => "R_MIN",
					5 => "WEIGHT",
					6 => "MANUFACTURER",
					7 => "DISCOUNT",
					8 => "PRICE",
					9 => "IMAGE_1",
				),
				"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
				"RCM_TYPE" => "personal",
				"SECTION_CODE" => "",
				"SECTION_ID" => $sec_id,
				"SECTION_ID_VARIABLE" => "SECTION_ID",
				"SECTION_URL" => "",
				"SECTION_USER_FIELDS" => array(
					0 => "UF_ARM",
					1 => "UF_SHELL",
					2 => "UF_TEMP",
					3 => "UF_PRESSURE",
					4 => "UF_APPLICATION",
					5 => "UF_DIAMETER",
					6 => "UF_MAIN_PAGE",
					7 => "",
				),
				"SEF_MODE" => "N",
				"SET_BROWSER_TITLE" => "Y",
				"SET_LAST_MODIFIED" => "N",
				"SET_META_DESCRIPTION" => "Y",
				"SET_META_KEYWORDS" => "Y",
				"SET_STATUS_404" => "N",
				"SET_TITLE" => "Y",
				"SHOW_404" => "N",
				"SHOW_ALL_WO_SECTION" => "N",
				"SHOW_CLOSE_POPUP" => "N",
				"SHOW_DISCOUNT_PERCENT" => "N",
				"SHOW_FROM_SECTION" => "N",
				"SHOW_MAX_QUANTITY" => "N",
				"SHOW_OLD_PRICE" => "N",
				"SHOW_PRICE_COUNT" => "1",
				"SHOW_SLIDER" => "Y",
				"SLIDER_INTERVAL" => "3000",
				"SLIDER_PROGRESS" => "N",
				"TEMPLATE_THEME" => "blue",
				"USE_ENHANCED_ECOMMERCE" => "N",
				"USE_MAIN_ELEMENT_SECTION" => "N",
				"USE_PRICE_COUNT" => "N",
				"USE_PRODUCT_QUANTITY" => "N",
				"COMPONENT_TEMPLATE" => "listing_detail"
			),
			false
		);?>
    </div>
</div>
