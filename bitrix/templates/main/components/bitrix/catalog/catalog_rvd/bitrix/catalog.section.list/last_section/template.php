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
<div class="container container_big">
	<div class="accordion" id="accordionExample1">
		<div class="accordion-item">
			<h2 class="accordion-header" id="headingOne">
				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
					Название категории
				</button>
			</h2>
			<div id="collapse1" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample1">
				<div class="accordion-body">
					<ul>														
						<li>категори</li>
						<li>категори</li>
						<li>категори</li>
						<li>категори</li>
						<li>категори</li>
						<li>категори</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="accordion-item">
			<h2 class="accordion-header" id="headingOne">
				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
					Название категории
				</button>
			</h2>
			<div id="collapse2" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample1">
				<div class="accordion-body">
					<ul>														
						<li>категори</li>
						<li>категори</li>
						<li>категори</li>
						<li>категори</li>
						<li>категори</li>
						<li>категори</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="accordion-item">
			<h2 class="accordion-header" id="headingOne">
				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
					Название категории
				</button>
			</h2>
			<div id="collapse3" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample1">
				<div class="accordion-body">
					<ul>														
						<li>категори</li>
						<li>категори</li>
						<li>категори</li>
						<li>категори</li>
						<li>категори</li>
						<li>категори</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="accordion-item">
			<h2 class="accordion-header" id="headingOne">
				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
					Название категории
				</button>
			</h2>
			<div id="collapse4" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample1">
				<div class="accordion-body">
					<ul>														
						<li>категори</li>
						<li>категори</li>
						<li>категори</li>
						<li>категори</li>
						<li>категори</li>
						<li>категори</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="accordion-item">
			<h2 class="accordion-header" id="headingOne">
				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
					Название категории
				</button>
			</h2>
			<div id="collapse5" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample1">
				<div class="accordion-body">
					<ul>														
						<li>категори</li>
						<li>категори</li>
						<li>категори</li>
						<li>категори</li>
						<li>категори</li>
						<li>категори</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="image_wrapper">
		<img src="/bitrix/templates/main/img/rukav_card-nfhydsn2.png (7).png" alt="">
	</div>
	<div class="text_container">
		<p class="title"><?foreach ($arResult["SECTION"]["PATH"] as $sec) { echo $sec["NAME"]." ";}?></p>
		<p class="description"><?=$arResult["SECTION"]["DESCRIPTION"]?></p>
		<ul class="characteristics">
			<p class="title">Технические характеристики</p>
			<li>
				<span>Армирование:</span>
				<span><?=$arResult["SECTION"]["UF_ARM"]?></span>
			</li>
			<li>
				<span>Оболочка:</span>
				<span><?=$arResult["SECTION"]["UF_SHELL"]?></span>
			</li>
			<li>
				<span>Температура:</span>
				<span><?=$arResult["SECTION"]["UF_TEMP"]?></span>
			</li>
			<li>
				<span>Давление:</span>
				<span><?=$arResult["SECTION"]["UF_PRESSURE"]?></span>
			</li>
			<li>
				<span>Применение:</span>
				<span><?=$arResult["SECTION"]["UF_APPLICATION"]?></span>
			</li>
			<li>
				<span>Диаметр:</span>
				<span><?=$arResult["SECTION"]["UF_DIAMETER"]?></span>
			</li>
		</ul>
	</div>
</div>


	
