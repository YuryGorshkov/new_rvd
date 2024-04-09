$(document).ready(function(){
    $('#consultation_request').submit(function(evt){
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
              alert('Спасибо! Заявка успешно отправлена. После рассмотрения заявки ответственным сотрудником с вами свяжутся');
            }
          }
        });
        evt.target.reset();
        return false;
    });
});