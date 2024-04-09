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

<div class="">
	<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
		<div class="carousel-inner">
			<?foreach($arResult["ITEMS"] as $key=>$arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<div class="carousel-item <?=($key==0) ? "active" : "" ?>">
					<img src="<?=SITE_TEMPLATE_PATH?>/img/back-top-kz.jpg" class="d-block w-100" alt="...">
					<div class="carousel-caption d-md-block">
						<h5><?=$arItem["NAME"]?></h5>
						<p><?=$arItem["DETAIL_TEXT"]?> <span><?=$arItem["PREVIEW_TEXT"]?></span></p>
					</div>
				</div>				
			<?endforeach;?>
		</div>
		<div class="">
			<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			</button>
			<div class="navigation">
				<span class="current" id="current_slide">01</span>
				/
				<span class="total_count"><?=(count($arResult["ITEMS"]) > 9) ? count($arResult["ITEMS"]) : "0".count($arResult["ITEMS"])?></span>
			</div>
			<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			</button>
		</div>
	</div>
	<div class="cards">
		<div class="card">
			<img src="<?=SITE_TEMPLATE_PATH?>/img/small-img_1.png" alt="">
			<?$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				Array(
				"AREA_FILE_SHOW" => "file",
				"AREA_FILE_SUFFIX" => "inc",
				"EDIT_TEMPLATE" => "",
				"PATH" => "/include/rvd/slider_head_1.php"
				)
			);?>
		</div>
		<div class="card">
			<img src="<?=SITE_TEMPLATE_PATH?>/img/small-img_9.png" alt="">
			<?$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				Array(
				"AREA_FILE_SHOW" => "file",
				"AREA_FILE_SUFFIX" => "inc",
				"EDIT_TEMPLATE" => "",
				"PATH" => "/include/rvd/slider_head_2.php"
				)
			);?>
		</div>
		<div class="card">
			<img src="<?=SITE_TEMPLATE_PATH?>/img/small-img_33.png" alt="">
			<?$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				"",
				Array(
				"AREA_FILE_SHOW" => "file",
				"AREA_FILE_SUFFIX" => "inc",
				"EDIT_TEMPLATE" => "",
				"PATH" => "/include/rvd/slider_head_3.php"
				)
			);?>
		</div>
	</div>
</div>


<script type="text/javascript">
        var myCarousel = document.getElementById('carouselExampleCaptions');
        myCarousel.addEventListener('slide.bs.carousel', function (slide) {
          document.getElementById('current_slide').innerHTML = (slide.to + 1) > 9 ? (slide.to + 1) : "0"+(slide.to + 1);
        });
      </script>