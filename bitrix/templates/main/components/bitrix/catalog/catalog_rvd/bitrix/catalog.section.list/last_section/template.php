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
		<?
		$arFilter = Array('IBLOCK_ID'=>$arParams["IBLOCK_ID"], 'GLOBAL_ACTIVE'=>'Y');
		$db_list = CIBlockSection::GetList(Array(), $arFilter, true);
		
		?>
		<?while($ar_result = $db_list->GetNext()){?>
			<?if($ar_result["DEPTH_LEVEL"] == 1):?>			
			<div class="accordion-item">
				<h2 class="accordion-header" id="<?=$ar_result["ID"]?>">								
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?=$ar_result["ID"]?>" aria-expanded="false" aria-controls="collapse<?=$ar_result["ID"]?>">
						<?=$ar_result["NAME"]?>
					</button>					
				</h2>
				<div id="collapse<?=$ar_result["ID"]?>" class="accordion-collapse collapse" aria-labelledby="<?=$ar_result["ID"]?>" data-bs-parent="#accordionExample1">
					<div class="accordion-body">
						<ul>
							<?
							$arFilter_c = Array('IBLOCK_ID'=>$arParams["IBLOCK_ID"], 'GLOBAL_ACTIVE'=>'Y');
							$db_list_c = CIBlockSection::GetList(Array(), $arFilter_c, true);							
							?>
							<?while($arSection_c = $db_list_c->GetNext()){?>
								<?if($arSection_c["DEPTH_LEVEL"] == 2 && $arSection_c["IBLOCK_SECTION_ID"] == $ar_result["ID"]):?>
									<li>
										<div class="accordion" id="accordionExample<?=$arSection_c["ID"]?>">			
											<div class="accordion-item">
												<h2 class="accordion-header" id="<?=$arSection_c["ID"]?>">								
													<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?=$arSection_c["ID"]?>" aria-expanded="false" aria-controls="collapse<?=$arSection_c["ID"]?>">
														<?=$arSection_c["NAME"]?>
													</button>					
												</h2>
												<div id="collapse<?=$arSection_c["ID"]?>" class="accordion-collapse collapse" aria-labelledby="<?=$arSection_c["ID"]?>" data-bs-parent="#accordionExample<?=$arSection_c["ID"]?>">
													<div class="accordion-body">
														<ul>
															<?
															$arFilter_cc = Array('IBLOCK_ID'=>$arParams["IBLOCK_ID"], 'GLOBAL_ACTIVE'=>'Y');
															$db_list_cc = CIBlockSection::GetList(Array(), $arFilter_cc, true);							
															?>
															<?while($arSection_cc = $db_list_cc->GetNext()){?>
																<?if($arSection_cc["DEPTH_LEVEL"] == 3 && $arSection_cc["IBLOCK_SECTION_ID"] == $arSection_c["ID"]):?>	
																	<li><a href="<?=$arSection_cc["SECTION_PAGE_URL"]?>"><?=$arSection_cc["NAME"]?></a></li>	
																<?endif;?>								
															<?}?>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</li>	
								<?endif;?>								
							<?}?>
						</ul>
					</div>
				</div>
			</div>
			<?endif;?>
		<?}?>				
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


	
