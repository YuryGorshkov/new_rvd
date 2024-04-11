$(document).ready(function(){
  $('#main_request').submit(function(evt){
      evt.preventDefault();        
      var $that = $(this),
      formData = new FormData($that.get(0));
      $.ajax({
        url: "/bitrix/templates/main/ajax/save_form_mess.php", // путь к php-обработчику
        type: 'POST', // метод передачи данных
        contentType: false,
        processData: false,
        data: formData,
        success: function(data){
          if(data){
            alert('Спасибо! Заявка успешно отправлена. После рассмотрения заявки ответственным сотрудником с вами свяжутся');
          }
        }
      });
      evt.target.reset();
      return false;
  });

  $('#catalog_modal_form').submit(function(evt){
    evt.preventDefault();        
    var $that = $(this),
    formData = new FormData($that.get(0));
    $.ajax({
      url: "/bitrix/templates/main/ajax/save_form_kp.php", // путь к php-обработчику
      type: 'POST', // метод передачи данных
      contentType: false,
      processData: false,
      data: formData,
      success: function(data){
        if(data){
          alert('Спасибо! Заявка успешно отправлена. После рассмотрения заявки ответственным сотрудником с вами свяжутся');
        }
      }
    });
    evt.target.reset();
    return false;
  });

  $('#product_request').submit(function(evt){
    evt.preventDefault();            
    $('#footerModal2').modal('hide');
    
    var myModal = new bootstrap.Modal(document.getElementById('footerModal3'), {
      keyboard: false
    });
    myModal.toggle();

    //ajax

    evt.target.reset();
    return false;
  });

  $('#certificate_request').submit(function(evt){
    evt.preventDefault();        
    var $that = $(this),
    formData = new FormData($that.get(0));
    $.ajax({
      url: "/bitrix/templates/main/ajax/save_form_discount.php", // путь к php-обработчику
      type: 'POST', // метод передачи данных
      contentType: false,
      processData: false,
      data: formData,
      success: function(data){
        if(data){
          alert('Спасибо! Заявка успешно отправлена. После рассмотрения заявки ответственным сотрудником с вами свяжутся');
        }
      }
    });
    evt.target.reset();
    return false;
  });

  $('#application_request').submit(function(evt){
    evt.preventDefault();        
    var $that = $(this),
    formData = new FormData($that.get(0));
    $.ajax({
      url: "/bitrix/templates/main/ajax/save_form_application.php", // путь к php-обработчику
      type: 'POST', // метод передачи данных
      contentType: false,
      processData: false,
      data: formData,
      success: function(data){
        if(data){
          alert('Спасибо! Заявка успешно отправлена. После рассмотрения заявки ответственным сотрудником с вами свяжутся');
        }
      }
    });
    evt.target.reset();
    return false;
  });

  $('#cosultation_request').submit(function(evt){
    evt.preventDefault();        
    var $that = $(this),
    formData = new FormData($that.get(0));
    $.ajax({
      url: "/bitrix/templates/main/ajax/save_form_faq.php", // путь к php-обработчику
      type: 'POST', // метод передачи данных
      contentType: false,
      processData: false,
      data: formData,
      success: function(data){
        if(data){
          console.log(data);
          alert('Спасибо! Заявка успешно отправлена. После рассмотрения заявки ответственным сотрудником с вами свяжутся');
        }
      }
    });
    evt.target.reset();
    return false;
  });

  $('#call_request').submit(function(evt){
    evt.preventDefault();        
    var $that = $(this),
    formData = new FormData($that.get(0));
    $.ajax({
      url: "/bitrix/templates/main/ajax/save_form_callback.php", // путь к php-обработчику
      type: 'POST', // метод передачи данных
      contentType: false,
      processData: false,
      data: formData,
      success: function(data){
        if(data){
          console.log(data);
          alert('Спасибо! Заявка успешно отправлена. После рассмотрения заявки ответственным сотрудником с вами свяжутся');
        }
      }
    });
    evt.target.reset();
    return false;
  });
});