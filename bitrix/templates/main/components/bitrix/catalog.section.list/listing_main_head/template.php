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

<div class="menu">
	<ul class="selector">
		<?$parent_section = array();?>
		<?foreach ($arResult['SECTIONS'] as $arSection):?>
			<?if($arSection["DEPTH_LEVEL"] == 1):?>
				<?$parent_section[] = $arSection["ID"];?>
				<li class="controller" data-current="<?=$arSection["ID"]?>"><?=$arSection["NAME"]?></li>
			<?endif;?>
		<?endforeach;?>	
	</ul>
	<?foreach ($parent_section as $section):?>
		<div class="accordion" id="accordionExample<?=$section?>">
			<ul class="dop_menu" id="dop_menu_<?=$section?>" style="display: none;">
				<?foreach ($arResult['SECTIONS'] as $arSection):?>
					<?if($arSection["DEPTH_LEVEL"] == 2 && $arSection["IBLOCK_SECTION_ID"] == $section):?>
						<li>
							<div class="accordion-item">
								<h2 class="accordion-header" id="headingOne">
									<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?=$arSection["ID"]?>" aria-expanded="false" aria-controls="collapse<?=$arSection["ID"]?>">
										<?=$arSection["NAME"]?>
									</button>
								</h2>
								<div id="collapse<?=$arSection["ID"]?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample<?=$section?>">
									<div class="accordion-body">
										<ul>
											<?$i = 0;?>
											<?foreach ($arResult['SECTIONS'] as $arChildSection):?>
												<?if($arChildSection["DEPTH_LEVEL"] == 3 && $arChildSection["IBLOCK_SECTION_ID"] == $arSection["ID"]):?>
													<?$i++;?>
													<?if($i <= 5):?>										
														<li><?=$arChildSection["NAME"]?></li>										
													<?else:?>
														<li>Показать ещё</li>
														<?break;?>
													<?endif;?>
												<?endif;?>
											<?endforeach;?>
										</ul>
									</div>
								</div>
							</div>
						</li>
					<?endif;?>
			<?endforeach;?>	
			</ul>
		</div>
	<?endforeach;?>	
</div>



