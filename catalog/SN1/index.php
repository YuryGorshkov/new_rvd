<?
define("HIDE_SIDEBAR", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
<section class="breadcrumb">
	<div class="container container_big">
		<ul>
			<li>
				<a href="/">Главная</a>
			</li>
			<li>
				<a href="/">Каталог</a>
			</li>
			<li>
				<a href="/">Гидравлические рукава</a>
			</li>
			<li>
				<a href="/">SN1</a>
			</li>
		</ul>
	</div>
</section>
<section class="catalog catalog_list">
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
							<li>категория</li>
							<li>категория</li>
							<li>категория</li>
							<li>категория</li>
							<li>категория</li>
							<li>категория</li>
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
							<li>категория</li>
							<li>категория</li>
							<li>категория</li>
							<li>категория</li>
							<li>категория</li>
							<li>категория</li>
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
							<li>категория</li>
							<li>категория</li>
							<li>категория</li>
							<li>категория</li>
							<li>категория</li>
							<li>категория</li>
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
							<li>категория</li>
							<li>категория</li>
							<li>категория</li>
							<li>категория</li>
							<li>категория</li>
							<li>категория</li>
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
							<li>категория</li>
							<li>категория</li>
							<li>категория</li>
							<li>категория</li>
							<li>категория</li>
							<li>категория</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="image_wrapper">
			<img src="/bitrix/templates/main/img/rukav_card-nfhydsn2.png (7).png" alt="">
		</div>
		<div class="text_container">
			<p class="title">Рукав гидравлический 1SN</p>
			<p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam quis aliquam nisi. Sed dignissim efficitur mi, sollicitudin maximus nisi feugiat nec.</p>
			<ul class="characteristics">
				<p class="title">Технические характеристики</p>
				<li>
					<span>Армирование:</span>
					<span>Синтетический каучук, стойкий к гидравлическим жидкостям.</span>
				</li>
				<li>
					<span>Оболочка:</span>
					<span>Стойкий к воздействию абразивов и озона синтетический каучук.</span>
				</li>
				<li>
					<span>Температура:</span>
					<span>от -40 °C до +100 °C (кратковременно макс +120 °C)</span>
				</li>
				<li>
					<span>Давление:</span>
					<span>10 бар</span>
				</li>
				<li>
					<span>Применение:</span>
					<span>Песок</span>
				</li>
				<li>
					<span>Диаметр:</span>
					<span>10 мм</span>
				</li>
			</ul>
		</div>
	</div>
	<div class="container container_big">
		<div class="filter">
			<p class="title">Фильтр</p>
			<div class="filter_body">
				<div class="filter_prop">
					<p class="title">Цена</p>
					<div class="range-slider">
						<span class="price_inputs_container">
							<input type="number" value="25000" min="0" max="120000">	
							<input type="number" value="50000" min="0" max="120000">
						</span>
						<input value="25000" min="0" max="120000" step="500" type="range">
						<input value="50000" min="0" max="120000" step="500" type="range">
					</div>
				</div>
				<div class="filter_prop">
					<p class="title">Название фильтра</p>
					<div class="values_container">
						<span>
							<input type="checkbox" name="" value="">
							<label for="">1</label>
						</span>
						<span>
							<input type="checkbox" name="" value="">
							<label for="">2</label>
						</span>
						<span>
							<input type="checkbox" name="" value="">
							<label for="">3</label>
						</span>
						<span>
							<input type="checkbox" name="" value="">
							<label for="">4</label>
						</span>
						<span>
							<input type="checkbox" name="" value="">
							<label for="">5</label>
						</span>
						<span>
							<input type="checkbox" name="" value="">
							<label for="">6</label>
						</span>
						<span>
							<input type="checkbox" name="" value="">
							<label for="">7</label>
						</span>
						<span>
							<input type="checkbox" name="" value="">
							<label for="">8</label>
						</span>
					</div>
				</div>
				<div class="filter_prop">
					<p class="title">Название фильтра</p>
					<div class="values_container">
						<span>
							<input type="checkbox" name="" value="">
							<label for="">1</label>
						</span>
						<span>
							<input type="checkbox" name="" value="">
							<label for="">2</label>
						</span>
						<span>
							<input type="checkbox" name="" value="">
							<label for="">3</label>
						</span>
						<span>
							<input type="checkbox" name="" value="">
							<label for="">4</label>
						</span>
						<span>
							<input type="checkbox" name="" value="">
							<label for="">5</label>
						</span>
						<span>
							<input type="checkbox" name="" value="">
							<label for="">6</label>
						</span>
						<span>
							<input type="checkbox" name="" value="">
							<label for="">7</label>
						</span>
						<span>
							<input type="checkbox" name="" value="">
							<label for="">8</label>
						</span>
					</div>
				</div>

				<button class="show_products">Показать 10 товаров</button>
				<button class="dell_all_filters">Сбросить фильтры</button>
			</div>
		</div>
		<div class="products">
			<div class="sort">
				<div class="dropdown">
					<button id="sort_menu_title" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
						Сортировать по
					</button>
					<ul class="dropdown-menu" id="sort_menu" aria-labelledby="dropdownMenuButton1">
						<li><a class="dropdown-item" href="#">Цене</a></li>
						<li><a class="dropdown-item" href="#">Популярности</a></li>
					</ul>
				</div>
				<p>Количество товаров: 999</p>
			</div>
			<div class="row big_row">
				<div class="col">
					Диаметр
				</div>
				<div class="col">
					Название
				</div>
				<div class="col">
					Цена
				</div>
				<div class="col">
					В корзину
				</div>
			</div>
			<div class="row row_products big_row">
				<div class="col title">
					DN 06
				</div>
				<div class="col">
					<div class="row">
						Название рукава, возможно длинное написание Название рукава, возможно длинное написание Название рукава, возможно длинное написание 
					</div>
					<div class="row">
						Название рукава, возможно длинное написание Название рукава, возможно длинное написание Название рукава, возможно длинное написание 
					</div>
				</div>
				<div class="col">
					<div class="row">
						999 руб.
					</div>
					<div class="row">
						999 руб. 
					</div>
				</div>
				<div class="col">
					<div class="row">
						<button class="to_cart"></button>
					</div>
					<div class="row">
						<button class="to_cart"></button>
					</div>
				</div>
			</div>
			<div class="row row_products big_row">
				<div class="col title">
					DN 06
				</div>
				<div class="col">
					<div class="row">
						Название рукава, возможно длинное написание Название рукава, возможно длинное написание Название рукава, возможно длинное написание 
					</div>
					<div class="row">
						Название рукава, возможно длинное написание Название рукава, возможно длинное написание Название рукава, возможно длинное написание 
					</div>
				</div>
				<div class="col">
					<div class="row">
						999 руб.
					</div>
					<div class="row">
						999 руб. 
					</div>
				</div>
				<div class="col">
					<div class="row">
						<button class="to_cart"></button>
					</div>
					<div class="row">
						<button class="to_cart"></button>
					</div>
				</div>
			</div>
			<div class="row row_products big_row">
				<div class="col title">
					DN 06
				</div>
				<div class="col">
					<div class="row">
						Название рукава, возможно длинное написание Название рукава, возможно длинное написание Название рукава, возможно длинное написание 
					</div>
					<div class="row">
						Название рукава, возможно длинное написание Название рукава, возможно длинное написание Название рукава, возможно длинное написание 
					</div>
				</div>
				<div class="col">
					<div class="row">
						999 руб.
					</div>
					<div class="row">
						999 руб. 
					</div>
				</div>
				<div class="col">
					<div class="row">
						<button class="to_cart"></button>
					</div>
					<div class="row">
						<button class="to_cart"></button>
					</div>
				</div>
			</div>
			<div class="row row_products big_row">
				<div class="col title">
					DN 06
				</div>
				<div class="col">
					<div class="row">
						Название рукава, возможно длинное написание Название рукава, возможно длинное написание Название рукава, возможно длинное написание 
					</div>
					<div class="row">
						Название рукава, возможно длинное написание Название рукава, возможно длинное написание Название рукава, возможно длинное написание 
					</div>
				</div>
				<div class="col">
					<div class="row">
						999 руб.
					</div>
					<div class="row">
						999 руб. 
					</div>
				</div>
				<div class="col">
					<div class="row">
						<button class="to_cart"></button>
					</div>
					<div class="row">
						<button class="to_cart"></button>
					</div>
				</div>
			</div>
			<div class="row row_products big_row">
				<div class="col title">
					DN 06
				</div>
				<div class="col">
					<div class="row">
						Название рукава, возможно длинное написание Название рукава, возможно длинное написание Название рукава, возможно длинное написание 
					</div>
					<div class="row">
						Название рукава, возможно длинное написание Название рукава, возможно длинное написание Название рукава, возможно длинное написание 
					</div>
				</div>
				<div class="col">
					<div class="row">
						999 руб.
					</div>
					<div class="row">
						999 руб. 
					</div>
				</div>
				<div class="col">
					<div class="row">
						<button class="to_cart"></button>
					</div>
					<div class="row">
						<button class="to_cart"></button>
					</div>
				</div>
			</div>
		</div>
		
	</div>
</section>

<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => "/include/rvd/catalog_seo_text.php"
	)
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>