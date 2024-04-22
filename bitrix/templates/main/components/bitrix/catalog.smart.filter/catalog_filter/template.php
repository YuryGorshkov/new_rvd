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

use Bitrix\Iblock\SectionPropertyTable;

$this->setFrameMode(true);

$templateData = array(
	'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/colors.css',
	'TEMPLATE_CLASS' => 'bx-'.$arParams['TEMPLATE_THEME']
);

if (isset($templateData['TEMPLATE_THEME']))
{
	$this->addExternalCss($templateData['TEMPLATE_THEME']);
}
$this->addExternalCss("/bitrix/css/main/bootstrap.css");
$this->addExternalCss("/bitrix/css/main/font-awesome.css");
?>

<div class="filter">
	<p class="title">Фильтр</p>
	<div class="filter_body">
		<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
			<?foreach($arResult["HIDDEN"] as $arItem):?>
			<input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
			<?endforeach;?>				
				<?foreach($arResult["ITEMS"] as $key=>$arItem)
				{
					if(
						empty($arItem["VALUES"])
						|| isset($arItem["PRICE"])
					)
						continue;

					if (
						$arItem["DISPLAY_TYPE"] === SectionPropertyTable::NUMBERS_WITH_SLIDER
						&& ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
					)
						continue;
					?>
					<div class="filter_prop">
						<p class="title"><?=$arItem["NAME"]?></p>
						<?
						$arCur = current($arItem["VALUES"]);
						switch ($arItem["DISPLAY_TYPE"])
						{
							case SectionPropertyTable::NUMBERS_WITH_SLIDER://NUMBERS_WITH_SLIDER
								?>
								<?/*<div class="range-slider">
									<span class="price_inputs_container">
										<input type="number" value="25000" min="0" max="120000">	
										<input type="number" value="50000" min="0" max="120000">
									</span>
									<input value="25000" min="0" max="120000" step="500" type="range">
									<input value="50000" min="0" max="120000" step="500" type="range">
								</div>*/?>
								
								<div class="range-slider">
									<span class="price_inputs_container">										
										<input
											type="number"
											name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
											id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
											value="<?=(!empty($arItem["VALUES"]["MIN"]["HTML_VALUE"])) ? $arItem["VALUES"]["MIN"]["HTML_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ?>"
										/>
									
										<input
											type="number"
											name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
											id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
											value="<?=(!empty($arItem["VALUES"]["MAX"]["HTML_VALUE"])) ? $arItem["VALUES"]["MAX"]["HTML_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"] ?>"
										/>
									</span>
									<input 
										value="<?=(!empty($arItem["VALUES"]["MIN"]["HTML_VALUE"])) ? $arItem["VALUES"]["MIN"]["HTML_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ?>" 
										min="<?echo $arItem["VALUES"]["MIN"]["VALUE"]?>" 
										max="<?echo $arItem["VALUES"]["MAX"]["VALUE"]?>" 
										step="1" 
										type="range"
									>
									<input 
										value="<?=(!empty($arItem["VALUES"]["MAX"]["HTML_VALUE"])) ? $arItem["VALUES"]["MAX"]["HTML_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"] ?>" 
										min="<?echo $arItem["VALUES"]["MIN"]["VALUE"]?>" 
										max="<?echo $arItem["VALUES"]["MAX"]["VALUE"]?>" 
										step="1" 
										type="range"
									>
								</div>
					
								<?
								break;
							default://CHECKBOXES
							?>
							<div class="values_container">
								<?if(count($arItem["VALUES"]) <= 8):?>
									<?foreach($arItem["VALUES"] as $val => $ar):?>
										<span data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label <? echo $ar["DISABLED"] ? 'disabled': '' ?>" for="<? echo $ar["CONTROL_ID"] ?>">											
											<input
												type="checkbox"
												value="<? echo $ar["HTML_VALUE"] ?>"
												name="<? echo $ar["CONTROL_NAME"] ?>"
												id="<? echo $ar["CONTROL_ID"] ?>"
												<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
												onclick="smartFilter.click(this)"
											/>
											<label style="font-weight: 400;" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?
											if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
												?>&nbsp;(<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
											endif;?></label>											
										</span>										
									<?endforeach;?>
								<?else:?>
									<?$i = 0;?>		
									<div class="more" id="more_<?=$arItem["ID"]?>">							
										<?foreach($arItem["VALUES"] as $val => $ar):?>
											<?$i++;?>
											<?if($i <= 8):?>
												<?if($i == 1):?>
													<div class="base_filters" id="base_filters_<?=$arItem["ID"]?>">
												<?endif;?>
												<span data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label <? echo $ar["DISABLED"] ? 'disabled': '' ?>" for="<? echo $ar["CONTROL_ID"] ?>">											
													<input
														type="checkbox"
														value="<? echo $ar["HTML_VALUE"] ?>"
														name="<? echo $ar["CONTROL_NAME"] ?>"
														id="<? echo $ar["CONTROL_ID"] ?>"
														<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
														onclick="smartFilter.click(this)"
													/>
													<label style="font-weight: 400;" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?
													if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
														?>&nbsp;(<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
													endif;?></label>											
												</span>			
											<?else:?>
												<?if($i == 9):?>
													</div>
													<p class="see_more_filters" data-target="<?=$arItem["ID"]?>">Развернуть</p>
													<div class="more_filters" id="more_filters_<?=$arItem["ID"]?>">
												<?endif;?>
												<span data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label <? echo $ar["DISABLED"] ? 'disabled': '' ?>" for="<? echo $ar["CONTROL_ID"] ?>">											
													<input
														type="checkbox"
														value="<? echo $ar["HTML_VALUE"] ?>"
														name="<? echo $ar["CONTROL_NAME"] ?>"
														id="<? echo $ar["CONTROL_ID"] ?>"
														<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
														onclick="smartFilter.click(this)"
													/>
													<label style="font-weight: 400;" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?
													if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
														?>&nbsp;(<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
													endif;?></label>											
												</span>			
												<?if($i == count($arItem["VALUES"])):?>
													</div>
												<?endif;?>
											<?endif;?>
										<?endforeach;?>
									</div>
								<?endif;?>
							</div>
						<?
						}
						?>
					</div>					
				<?
				}
				?>
			<!--//row-->
			

			<button class="show_products bx-filter-popup-result <?if ($arParams["FILTER_VIEW_MODE"] == "VERTICAL") echo $arParams["POPUP_POSITION"]?>" type="submit" id="modef"	name="set_filter">
				Подобрать&nbsp;<span id="modef_num"><?=$arResult["ELEMENT_COUNT"]?></span>&nbsp;товаров
			</button>
			<button
				class="dell_all_filters"
				type="submit"
				id="del_filter"
				name="del_filter"
				
			><?=GetMessage("CT_BCSF_DEL_FILTER")?></button>
			
						
		</form>
	</div>
</div>
<script type="text/javascript">
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>