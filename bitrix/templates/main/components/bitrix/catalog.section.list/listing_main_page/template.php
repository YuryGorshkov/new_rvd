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

$arViewModeList = $arResult['VIEW_MODE_LIST'];

$arViewStyles = array(
	'LIST' => array(
		'CONT' => 'bx_sitemap',
		'TITLE' => 'bx_sitemap_title',
		'LIST' => 'bx_sitemap_ul',
	),
	'LINE' => array(
		'CONT' => 'bx_catalog_line',
		'TITLE' => 'bx_catalog_line_category_title',
		'LIST' => 'bx_catalog_line_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/line-empty.png'
	),
	'TEXT' => array(
		'CONT' => 'bx_catalog_text',
		'TITLE' => 'bx_catalog_text_category_title',
		'LIST' => 'bx_catalog_text_ul'
	),
	'TILE' => array(
		'CONT' => 'bx_catalog_tile',
		'TITLE' => 'bx_catalog_tile_category_title',
		'LIST' => 'bx_catalog_tile_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/tile-empty.png'
	)
);
$arCurView = $arViewStyles[$arParams['VIEW_MODE']];

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

?>
<a name="catalog"></a>
<section class="catalog">
	<div class="container">
		<h2>Каталог</h2>
	</div>
	<div class="container container_items">
		<div class="js-brands-slider swiper">
			<div class="swiper-wrapper">
				<?
				if (0 < $arResult["SECTIONS_COUNT"])
				{
					switch ($arParams['VIEW_MODE'])
					{
						case 'LINE':
							foreach ($arResult['SECTIONS'] as &$arSection)
							{
								
								$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
								$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

								if (false === $arSection['PICTURE'])
									$arSection['PICTURE'] = array(
										'SRC' => $arCurView['EMPTY_IMG'],
										'ALT' => (
											'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
											? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
											: $arSection["NAME"]
										),
										'TITLE' => (
											'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
											? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
											: $arSection["NAME"]
										)
									);
								?><li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
								<a
									href="<? echo $arSection['SECTION_PAGE_URL']; ?>"
									class="bx_catalog_line_img"
									style="background-image: url('<? echo $arSection['PICTURE']['SRC']; ?>');"
									title="<? echo $arSection['PICTURE']['TITLE']; ?>"
								></a>
								<h2 class="bx_catalog_line_title"><a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><? echo $arSection['NAME']; ?></a><?
								if ($arParams["COUNT_ELEMENTS"] && $arSection['ELEMENT_CNT'] !== null)
								{
									?> <span>(<? echo $arSection['ELEMENT_CNT']; ?>)</span><?
								}
								?></h2><?
								if ('' != $arSection['DESCRIPTION'])
								{
									?><p class="bx_catalog_line_description"><? echo $arSection['DESCRIPTION']; ?></p><?
								}
								?><div style="clear: both;"></div>
								</li><?
							}
							unset($arSection);
							break;
						case 'TEXT':
							foreach ($arResult['SECTIONS'] as &$arSection)
							{
								$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
								$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

								?><li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>"><h2 class="bx_catalog_text_title"><a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><? echo $arSection['NAME']; ?></a><?
								if ($arParams["COUNT_ELEMENTS"] && $arSection['ELEMENT_CNT'] !== null)
								{
									?> <span>(<? echo $arSection['ELEMENT_CNT']; ?>)</span><?
								}
								?></h2></li><?
							}
							unset($arSection);
							break;
						case 'TILE':
							foreach ($arResult['SECTIONS'] as &$arSection)
							{
								$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
								$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

								if (false === $arSection['PICTURE'])
									$arSection['PICTURE'] = array(
										'SRC' => $arCurView['EMPTY_IMG'],
										'ALT' => (
											'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
											? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
											: $arSection["NAME"]
										),
										'TITLE' => (
											'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
											? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
											: $arSection["NAME"]
										)
									);
								?><li id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
								<a
									href="<? echo $arSection['SECTION_PAGE_URL']; ?>"
									class="bx_catalog_tile_img"
									style="background-image:url('<? echo $arSection['PICTURE']['SRC']; ?>');"
									title="<? echo $arSection['PICTURE']['TITLE']; ?>"
									> </a><?
								if ('Y' != $arParams['HIDE_SECTION_NAME'])
								{
									?><h2 class="bx_catalog_tile_title"><a href="<? echo $arSection['SECTION_PAGE_URL']; ?>"><? echo $arSection['NAME']; ?></a><?
									if ($arParams["COUNT_ELEMENTS"] && $arSection['ELEMENT_CNT'] !== null)
									{
										?> <span>(<? echo $arSection['ELEMENT_CNT']; ?>)</span><?
									}
								?></h2><?
								}
								?></li><?
							}
							unset($arSection);
							break;
						case 'LIST':
							$intCurrentDepth = 1;
							$boolFirst = true;
							foreach ($arResult['SECTIONS'] as &$arSection)
							{
								$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
								$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);?>
								<?if(!empty($arSection["UF_MAIN_PAGE"])):?>
								<div class="swiper-slide">
									<div class="item">
										<div class="img_wrapper">
											<img src="<?=$arSection["PICTURE"]["SRC"]?>" alt="">
										</div>
										<p class="title"><a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a></p>
										
									</div>
								</div>
								<?endif;?>
							<?}
							unset($arSection);			
							break;
					}	
				}
				?>
			</div>
			<div class="swiper-scrollbar"></div>
		</div>
	</div>
</section>

