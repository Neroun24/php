<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Информация о грантах");
?><?php require($_SERVER["DOCUMENT_ROOT"]."/local/include/forms/grantsForm.php");?> <main> <section class="intro intro--grants">
<div class="container intro__container">
	<div class="intro__img">
 <picture class="intro__img-inner">
<source media="(min-width: 552px) and (max-width: 1199px)" srcset="/assets/img/intro-img--grants-tablet.png ">
<source srcset="/assets/img/intro-img--grants.png ">
 <img src="null" class="intro__img-inner" alt="">
</picture>
	</div>
	<div class="intro__text">
		<h1 class="intro__heading">
		Расскажем как получить поддержку от государства </h1>
		<p class="intro__paragraph">
			 Актуальная информация о доступных грантах, субсидиях, условиях их получения и необходимых для оформления документах.
		</p>
	</div>
</div>
 </section> <section class="grants">
<div class="container">
	<form class="grants-form" id="grantsForm" action="/ajax/forms/saveGrantsForm.php">
		<div class="row grants-radio-grid mb-3" id="grants-form-radios">
		</div>
		<div class="row flex-xl-nowrap align-items-start mb-4 gap-2">
			<div class="d-flex flex-column col-12 col-lg autocomplete-input-wrap">
                <button type="button" class="autocomplete-input-wrap__cross" aria-label="Сбросить выбор" title="Сбросить выбор">
                    <span aria-hidden="true">×</span>
                </button>
                <input placeholder="Выбор области" id="question_form_country" required="" class="autocomplete-input" title="Обязательно для заполнения" name="city_autocomplete">
			</div>
			<div class="d-flex flex-column-reverse col-12 col-lg">
				<select name="question_form_documents" class="custom-select" data-placeholder="Организационно-правовая форма" title="Обязательно для заполнения" id="grants-form-select">
					<option></option>
					<option value="Тест 1">Тест 1</option>
					<option value="Тест 2">Тест 2</option>
					<option value="Тест 3">Тест 3</option>
					<option value="Тест 4">Тест 4</option>
					<option value="Тест 5">Тест 5</option>
				</select>
			</div>
			<div class="d-flex flex-column-reverse col-12 col-lg">
				<select name="question_form_direction" class="custom-select" data-placeholder="Направление поддержки" title="Обязательно для заполнения" id="grants-vector-select">
					<option></option>
					<option value="Тест 1">Тест 1</option>
					<option value="Тест 2">Тест 2</option>
				</select>
			</div>
		</div>
		<div class="row flex-xl-nowrap">
			<div class="d-flex col-12 col-lg">
 <button type="submit" class="p-2 bg-danger text-white flex-grow-1 b-0 radius-md text-style-body-large-regular mb-2 mb-lg-0">
				Подобрать </button>
			</div>
			<div class="d-flex col-lg">
 <button type="reset" id="resetGrantsButton" class="p-2 bg-white text-black flex-grow-1 b-0 radius-md text-style-body-large-regular">
				Сбросить </button>
			</div>
			<div class="col-12 col-lg">
			</div>
		</div>
	</form>
	<div class="grants-description" id="grantsDescription">
		<h2 class="grants-description__heading">
		Проконсультируем по подготовке документов для подачи заявки на получение государственной поддержки </h2>
		<p class="grants-description__paragraph">
			 Наша команда экспертов готова ответить на ваши вопросы и предоставить необходимую поддержку на всех этапах процесса:
		</p>
		<ul class="grants-description__list">
			<li class="grants-description__list-item">
			Предоставим актуальные шаблоны документов и поможем в их заполнении </li>
			<li class="grants-description__list-item">
			Разъясним, как зарегистрироваться и работать в ГИС "Электронный бюджет"</li>
			<li class="grants-description__list-item">
			Проконсультируем по составлению отчета </li>
		</ul>
	</div>
	<div id="grantsDocuments" style="display: none">
	</div>
	<div class="grants-application">
		<h3 class="grants-application__heading">
		Подайте заявку для дальнейшей консультации </h3>
 <button class="grants-application__button" id="openModal">
		Подать заявку </button>
	</div>
</div>
 </section> </main><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
