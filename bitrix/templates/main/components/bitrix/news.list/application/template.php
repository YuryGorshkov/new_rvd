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


<a name="configur"></a>
<section class="configuration">
	<div class="container">
		<div class="configuration_wrapper">
		<div class="col">
			<p>
			<span class="title">Конфигуратор<br> промышленных<br> рукавов</span><br>
			Подберите нужную<br> конфигурацию и узнайте <br>точную стоимость
			</p>
		</div>
		<div class="col">
			<p class="title">Ответьте на 4 простых вопроса и получите:</p>
			<p class="description">консультацию эксперта + расчет стоимости РВД + скидку 5 000 руб.</p>
			<img src="<?=SITE_TEMPLATE_PATH?>/img/gates-tube.png" alt="">
			<div class="buttons_wrapper">
			<p><img src="<?=SITE_TEMPLATE_PATH?>/img/quiz-prop.png" alt=""> Расчет стоимости рукава</p>
			<p><img src="<?=SITE_TEMPLATE_PATH?>/img/quiz-title2.png" alt=""> Сертификат<br> на скидку 5 000 руб.* <span class="privat_policy" style="margin: 50px 0px 0px 30px; position: absolute;"> <a href="#">*Условия сертификата</a> </span></p>
			<p><img src="<?=SITE_TEMPLATE_PATH?>/img/teamcall.png" alt=""> Консультация эксперта </p>
			<button type="button" data-bs-toggle="modal" data-bs-target="#configurationModal" name="button">Пройти тест и<br> получить скидку</button>
			</div>
		</div>
		</div>
	</div>
	<div class="modal fade" id="configurationModal" tabindex="-1" aria-labelledby="configurationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="col">
                  <div class="proggressbar_wrapper">
                    <p class="description">шаг <span id="modal_index">1</span> из 5</p>
                    <span class="proggressbar"><span class="proggressbar_inner" id="proggressbar_inner"></span></span>
                  </div>
                  <form id="application_request">
                    <?						
                  $arFilter = Array('IBLOCK_ID'=>4, 'GLOBAL_ACTIVE'=>'Y');
                  $db_list = CIBlockSection::GetList(Array(), $arFilter, true, array('ID','UF_*', "DESCRIPTION", "NAME"));
                  $i = 0;
                  while($ar_result = $db_list->GetNext())
                  { $i++;?>
                    <div id="configurationModal_block_<?=$i?>" class="<?=($i == 1) ? 'show' : ''?>" data-question="<?=$ar_result["DESCRIPTION"]?>">
                      <p class="title"><?=$ar_result["UF_DESCRIPTION_2"]?></p>
                      <p class="description">Выберите один вариант</p>
                      <div class="inputs_container">
					  	<?foreach($arResult["ITEMS"] as $key=>$arItem):?>                
                <?if($arItem["IBLOCK_SECTION_ID"] == $ar_result["ID"]):?>
                  <span>
                    <input type="checkbox" name="direction_<?=$arItem["ID"]?>" value="Y">
                    <label for="direction_<?=$arItem["ID"]?>"><?=$arItem["NAME"]?></label>
                  </span>
                <?endif;?>
						  <?endforeach;?>
                      </div>
                    </div>
					<?}?>
                    
                    <div id="configurationModal_block_4" data-question="Из какого Вы города?">
                      <p class="title">В какой город необходима доставка?</p>
                      <p class="description">Укажите Ваш город</p>
                      <div class="inputs_container">
                        <input type="text" name="city" value="" class="text_input" placeholder="Ваш город">
                      </div>
                    </div>
                    <div id="configurationModal_block_5" data-question="Мы приняли в работу Ваш запрос, оставьте контактный номер для получения консультации и уточнения деталей">
                      <p class="title_1">Спасибо за ответы!</p>
                      <p class="title">По Вашим критериям у нас осталось<br> несколько горячих предложений!</p>
                      <p class="description">Оставьте свои контактные данные, чтобы получить консультацию эксперта и забронировать скидку 5 000 руб.</p>
                      <div class="images_block">
                        <p>
                          <img src="<?=SITE_TEMPLATE_PATH?>/img/quiz-prop.png" alt="">
                          Расчет<br>
                          стоимости рукава
                        </p>
                        +
                        <p>
                          <img src="<?=SITE_TEMPLATE_PATH?>/img/quiz-call.png" alt="">
                          Консультация<br>
                          эксперта
                        </p>
                        +
                        <p>
                          <img src="<?=SITE_TEMPLATE_PATH?>/img/quiz-ser.png" alt="">
                          Сертификат<br>
                          на скидку 5 000 руб
                          <span class="privat_policy"><a href="#">*Условия сертификата</a></span>
                        </p>
                      </div>
                      <div class="inputs_container">
                        <span><input type="text" name="name" value="" class="text_input" placeholder="Введите Ваше имя"></span>
                        <span><input type="text" name="phone" value="" class="text_input phone" placeholder="Введите Ваш телефон*" required></span>
                        <span><input type="text" name="mail" value="" class="text_input" placeholder="Введите Ваше e-mail*" required></span>
                      </div>
                      <p class="privat_policy">Нажимая на кнопку, вы принимаете условия <a href="#">политики конфиденциальности</a></p>
                    </div>
                    <div class="buttons_container">
                      <button type="button" id="back" style="display: none;">НАЗАД</button>
                      <button type="button" id="next">ПЕРЕЙТИ К СЛЕДУЮЩЕМУ ВОПРОСУ</button>
                      <button type="submite" id="form_submite" style="display: none;">ОСТАВИТЬ ЗАЯВКУ И ПОЛУЧИТЬ СКИДКУ 5%</button>
                    </div>
                  </form>
                </div>
                <div class="col">
                  <p class="title">Для получения скидки начните отвечать на вопросы</p>
                  <div class="question_wrapper">
                    <div class="wrapper">
                      <img src="<?=SITE_TEMPLATE_PATH?>/img/teamcall-150x150.png" alt="">
                      <p>
                        <span class="title">Светлана Юшина</span>
                        Руководитель отдела продаж
                      </p>
                    </div>
                    <div class="question" id="quest">Куда вам необходимо РВД?</div>
                    <div class="wrapper_2">
                      <p>
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/quiz-prop.png" alt="">
                        Расчет<br>
                        стоимости рукава
                      </p>
                      +
                      <p>
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/quiz-ser.png" alt="">
                        Сертификат<br>
                        на скидку 5 000 руб
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
</section>