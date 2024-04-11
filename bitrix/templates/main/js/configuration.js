$(document).ready(function() {
    $("#sort_menu li a").click(function() {
      $("#sort_menu_title").html(this.innerHTML);
    });

    var index = 1;
    $("#next").click(function() {
        document.getElementById("configurationModal_block_"+index).classList.remove("show");
        index += 1;
        document.getElementById("configurationModal_block_"+index).classList.add("show");
        document.getElementById("back").style.display = "block";
        if (index == 5) {
            document.getElementById("next").style.display = "none";
            document.getElementById("form_submite").style.display = "block";
            document.getElementById("proggressbar_inner").style.backgroundColor = "#0867AD";
        }
        document.getElementById("modal_index").innerHTML = index;
        document.getElementById("proggressbar_inner").style.width = 4 - 24 + 24 * index + "%";
        document.getElementById("quest").innerHTML = document.getElementById("configurationModal_block_"+index).dataset.question;
    });
    $("#back").click(function() {
        document.getElementById("configurationModal_block_"+index).classList.remove("show");
        index -= 1;
        document.getElementById("configurationModal_block_"+index).classList.add("show");
        document.getElementById("next").style.display = "block";
        if (index == 1) {
            document.getElementById("back").style.display = "none";
        }
        document.getElementById("modal_index").innerHTML = index;
        document.getElementById("form_submite").style.display = "none";
        document.getElementById("proggressbar_inner").style.width = 4 - 24 + 24 * index + "%";
        document.getElementById("proggressbar_inner").style.backgroundColor = "#FFD35E";
        document.getElementById("quest").innerHTML = document.getElementById("configurationModal_block_"+index).dataset.question;
    });
    $(".controller").click(function() {
      var dop_menues = document.querySelectorAll(".dop_menu");
      var controllers = document.querySelectorAll(".controller");
      if (this.classList.contains('active')) {
        Array.prototype.forEach.call(dop_menues, function(item) {
          item.style.display = "none";
        });
        this.classList.remove('active');
      } else {
        Array.prototype.forEach.call(dop_menues, function(item) {
          item.style.display = "none";
        });
        Array.prototype.forEach.call(controllers, function(item) {
          item.classList.remove('active');
        });
        document.getElementById('dop_menu_'+this.dataset.current).style.display = "grid";
        this.classList.add('active');
      }
    });
    $("#catalog_btn_head").click(function() {
      if (this.dataset.active != "Y") {
        this.dataset.active = "Y";
        this.style.position = "absolute";
        this.style.right = "10px";
        this.innerHTML = "закрыть";
        document.getElementById("accordion_head").style = "display: absolute";
      } else {
        this.dataset.active = "none";
        this.style = "position: realative";
        this.innerHTML = "каталог";
        document.getElementById("accordion_head").style = "display: none";
      }
    });
    $("#menu_btn_head").click(function() {
      if (this.dataset.active != "Y") {
        this.dataset.active = "Y";
        document.getElementById("menu_mobile_head").style = "display: absolute";
      } else {
        this.dataset.active = "none";
        document.getElementById("menu_mobile_head").style = "display: none";
      }
    });
    $(document).mouseup( function(e){ // событие клика по веб-документу
      var dop_menues = document.querySelectorAll(".dop_menu");
      var controllers = document.querySelectorAll(".controller");
  		var div = $( ".dop_menu" ); // тут указываем ID элемента
  		if ( !div.is(e.target) && div.has(e.target).length === 0 ) { // и не по его дочерним элементам
        Array.prototype.forEach.call(dop_menues, function(item) {
          item.style.display = "none";
        });
        Array.prototype.forEach.call(controllers, function(item) {
          item.classList.remove('active');
        });
  		}
  	});
    if (document.getElementById("max_price")) {
      document.getElementById("max_price").addEventListener("change", (event) => {
        document.getElementById('price').value = event.target.value;
      });
    }
    var brandsSlider = new Swiper(".js-brands-slider", {
    slidesPerView: 10,
    grid: {
      rows: 6,
      fill: "row"
    },
    spaceBetween: 80,
    scrollbar: {
      el: '.swiper-scrollbar',
      draggable: true,
      snapOnRelease: true,
      dragSize: 'auto',
    },
    breakpoints: {
      0: {
        spaceBetween: 20,
        slidesPerView: 1.9,
        grid: {
          rows: 1,
          fill: "row"
        },
      },
      768: {
        spaceBetween: 20,
        slidesPerView: 3,
        grid: {
          rows:1,
          fill: "row"
        },
      },
      960: {
        spaceBetween: 80,
        slidesPerView: 4,
        grid: {
          rows: 6,
          fill: "row"
        },
      },
    }
  });
  var brandsSlider = new Swiper(".js-brands_2-slider", {
    slidesPerView: 10,
    grid: {
      rows: 6,
      fill: "row"
    },
    spaceBetween: 80,
    scrollbar: {
      el: '.swiper-scrollbar',
      draggable: true,
      snapOnRelease: true,
      dragSize: 'auto',
    },
    breakpoints: {
      0: {
        spaceBetween: 20,
        slidesPerView: 1.9,
        grid: {
          rows: 1,
          fill: "row"
        },
      },
      768: {
        spaceBetween: 20,
        slidesPerView: 3,
        grid: {
          rows:1,
          fill: "row"
        },
      },
      960: {
        spaceBetween: 40,
        slidesPerView: 5,
        grid: {
          rows: 6,
          fill: "row"
        },
      },
    }
  });
  var brandsSlider = new Swiper(".js-see-more-slider", {
    slidesPerView: 10,
    spaceBetween: 40,
    breakpoints: {
      0: {
        spaceBetween: 20,
        slidesPerView: 1.9,
      },
      768: {
        spaceBetween: 20,
        slidesPerView: 3,
      },
      960: {
        spaceBetween: 20,
        slidesPerView: 5,
      },
    }
  });
  $(".phone").mask("+7 (999) 999-9999");

  if(document.getElementById("count_products")) {
    document.getElementById("modef_num").innerHTML = document.getElementById("count_products").innerHTML;
  }

  $(".switch").click(function() {
    var swithes = document.querySelectorAll(".switch");
    var boxes = document.querySelectorAll(".box");
    if (!this.classList.contains('active')) {
      Array.prototype.forEach.call(swithes, function(item) {
        item.classList.remove('active');
      });
      Array.prototype.forEach.call(boxes, function(item) {
        item.classList.remove('active');
      });
      document.getElementById('box_'+this.dataset.target).classList.add('active');
      this.classList.add('active');
    }
  });

  var parent = document.querySelector(".range-slider");
  if (!parent) return;

  var rangeS = parent.querySelectorAll("input[type=range]"),
    numberS = parent.querySelectorAll("input[type=number]");

  rangeS.forEach(function (el) {
    el.oninput = function () {
      var slide1 = parseFloat(rangeS[0].value),
        slide2 = parseFloat(rangeS[1].value);

      if (slide1 > slide2) {
        [slide1, slide2] = [slide2, slide1];
        // var tmp = slide2;
        // slide2 = slide1;
        // slide1 = tmp;
      }

      numberS[0].value = slide1;
      numberS[1].value = slide2;
    };
  });

  $("#add_to_cart").click(function() {
    document.getElementById('modal_product_id').value = this.dataset.prodid;
  });

  numberS.forEach(function (el) {
    el.oninput = function () {
      var number1 = parseFloat(numberS[0].value),
        number2 = parseFloat(numberS[1].value);

      if (number1 > number2) {
        var tmp = number1;
        numberS[0].value = number2;
        numberS[1].value = tmp;
      }

      rangeS[0].value = number1;
      rangeS[1].value = number2;
    };
  });
    
});
