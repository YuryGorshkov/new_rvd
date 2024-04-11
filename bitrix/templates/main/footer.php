</main>
    <footer>
      <div class="footer_coopirate">
        <div class="container">
          <div class="logo">
            <img src="<?=SITE_TEMPLATE_PATH?>/img/logo.png" alt="">
            <p>
              <span>Политика конфиденциальности</span><br>
              Копирование материалов сайта запрещено<br>
              © 2002 - 2024
            </p>
          </div>
          <div class="delivery">
            <ul>
              <li> <a href="">Каталог</a> </li>
              <li> <a href="">О компании</a> </li>
              <li> <a href="">Оплата</a> </li>
              <li> <a href="">Доставка</a> </li>
              <li> <a href="">Контакты</a> </li>
            </ul>
          </div>
          <div class="telephone">
            <button class="btn btn-primary btn_head" data-bs-toggle="modal" data-bs-target="#footerModal" type="button" name="button">Отправить заявку</button>
            <div class="buttons_wrapper">
              <a class="button_item" href="#"></a>
              <a class="button_item" href="#"></a>
              <a class="button_item" href="#"></a>
            </div>
          </div>
          <div class="contacts">
            <ul class="contacts_wrapper">
              <li>
                Телефон в Москве
                <a href="mailto:zakaz@ooorvd.ru">+7 (499) 393-03-80</a>
              </li>
              <li>
                Бесплатный звонок<br> по всей России
                <a href="mailto:zakaz@ooorvd.ru">8 800 350-98-01</a>
              </li>
              <li>
                <a href="mailto:zakaz@ooorvd.ru">zakaz@ooorvd.ru</a>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="footerModal" tabindex="-1" aria-labelledby="footerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              <p class="title">Заказать звонок</p>
              <p class="description">Наш специалист свяжется с Вами<br> в ближайшее время</p>
              <form id="call_request">
                <input type="name" name="name" placeholder="Введите Ваше имя">
                <input type="phone" name="phone" class="phone" placeholder="Введите Ваш телефон*" required>
                <button type="submit" name="button">Получить бонус</button>
              </form>
              <p class="privat_policy">Нажимая на кнопку, вы принимаете условия <a href="#">политики конфиденциальности</a></p>
            </div>
          </div>
        </div>
      </div>

      <div class="modal product_modal fade" id="footerModal2" tabindex="-1" aria-labelledby="footerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              <p class="title">Отправить заявку</p>
              <form id="product_request">
                <input type="hidden" name="model" id="modal_product_id">
                <p>Имя <span>*</span></p>
                <input type="name" name="name" placeholder="Введите имя" required>
                <p>Номер телефона <span>*</span></p>
                <input class="phone" type="phone" name="phone" placeholder="Введите номер телефона" required>
                <p>Комментарий</p>
                <input type="phone" name="comment" placeholder="Введите комментарий">
                <button type="submit" name="button">Заказать</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal product_modal fade" id="footerModal3" tabindex="-1" aria-labelledby="footerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              <img src="<?=SITE_TEMPLATE_PATH?>/img/check_circle.png" alt="">
              <p class="title title2">Ваш заказ успешно оформлен</p>
              <button data-bs-dismiss="modal" aria-label="Close" name="button">Закрыть</button>
            </div>
          </div>
        </div>
      </div>

      <?$APPLICATION->AddHeadScript("https://code.jquery.com/jquery-3.6.3.js");?> 
      <?$APPLICATION->AddHeadScript("https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js");?>
      <?$APPLICATION->AddHeadScript("https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js");?>
      <?$APPLICATION->AddHeadScript("https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js");?>
      <?$APPLICATION->AddHeadScript("https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js");?>
      <?$APPLICATION->AddHeadScript("https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js");?>
      <script src="<?=SITE_TEMPLATE_PATH?>/js/fslightbox.js"></script>
      <script src="<?=SITE_TEMPLATE_PATH?>/js/animations.js"></script>
      <script src="<?=SITE_TEMPLATE_PATH?>/js/configuration.js"></script>
      <script src="<?=SITE_TEMPLATE_PATH?>/js/forms.js"></script>
    </footer>

  </body>
</html>
