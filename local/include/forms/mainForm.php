<section class="form">
    <section class="container" id="form">
        <div class="toggle__forms">
            <div class="toggle__forms_item toggle__forms-question">
                <form id="question" action="/ajax/forms/saveQuestionForm.php" name="question" data-validate-form>
                    <div class="js-question-body">
                        <h3>Оставить заявку</h3>
                        <div class="d-flex flex-column">
                            <div class="order-1 order-lg-2 mb-2 mt-lg-2">
                                <p class="text-danger">
                                    Поля со звёздочкой* обязательные
                                </p>
                            </div>
                            <div class="order-1">
                                <h5 class="title">Производимая продукция</h5>
                                <div class="row">
                                    <div class="col-12 col-lg">
                                        <label class="form-check radio radio-btn">
                                            <input
                                                class="form-check-input"
                                                type="radio"
                                                id="question_product_type-vegs"
                                                name="product_type"
                                                checked
                                            /><span class="form-check-name">Овощи</span>
                                        </label>
                                    </div>
                                    <div class="col-12 col-lg">
                                        <label class="form-check radio radio-btn">
                                            <input
                                                class="form-check-input"
                                                type="radio"
                                                id="question_product_type-fruits"
                                                name="product_type"
                                            /><span class="form-check-name">Фрукты</span>
                                        </label>
                                    </div>
                                    <div class="col-12 col-lg">
                                        <label class="form-check radio radio-btn">
                                            <input
                                                class="form-check-input"
                                                type="radio"
                                                id="question_product_type-meat"
                                                name="product_type"
                                            /><span class="form-check-name text-nowrap"
                                            >Мясо, молоко, яйца</span
                                            >
                                        </label>
                                    </div>
                                    <div class="col-12 col-lg">
                                        <label class="form-check radio radio-btn">
                                            <input
                                                class="form-check-input"
                                                type="radio"
                                                id="question_product_type-other"
                                                name="product_type"
                                            /><span class="form-check-name">Другое</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h5 class="title mt-1">Контактные данные</h5>
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="form-group form-floating" data-field-holder>
                                    <input
                                        class="form-control"
                                        id="question_name"
                                        type="text"
                                        name="full_name"
                                        required
                                        title="Обязательно для заполнения"
                                    />
                                    <label for="question_name">ФИО контактного лица*</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group form-floating" data-field-holder>
                                    <input
                                        class="form-control"
                                        id="question_phone"
                                        type="tel"
                                        name="phone"
                                        required
                                        title="Обязательно для заполнения"
                                    />
                                    <label for="question_phone">Номер телефона*</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group form-floating" data-field-holder>
                                    <input
                                        class="form-control"
                                        id="question_email"
                                        type="email"
                                        name="email"
                                        required
                                        title="Обязательно для заполнения"
                                    />
                                    <label for="question_email">E-mail*</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group form-floating" data-field-holder>
                                    <input
                                        class="form-control"
                                        id="question_company"
                                        type="text"
                                        name="company"
                                        required
                                        title="Обязательно для заполнения"
                                    />
                                    <label for="question_company">ИНН компании*</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group form-floating" data-field-holder>
                        <textarea
                            class="form-control"
                            id="question_comment"
                            name="comment"
                            title="Обязательно для заполнения"
                            maxlength="250"
                        ></textarea>
                                    <label for="question_comment"
                                    >Напишите здесь любой вопрос</label
                                    >
                                    <div class="form-group-after">
                                        <div class="form-group-counter">
                                            <span class="js-textarea-counter">0</span>/250
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <div
                                    style="height: 100px"
                                    id="captcha-container"
                                    class="smart-captcha"
                                    data-sitekey="ysc1_TKeZQUujZQS6hZmSeU8U1I633q4wg8SMh2FSWzKw8be9665d"
                                ></div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-auto order-lg-2">
                                <div class="form-group mb-lg-0">
                                    <button class="btn btn-black" type="submit" disabled>
                                        Отправить
                                    </button>
                                </div>
                            </div>
                            <div class="col-12 col-lg order-lg-1 pr-lg-3">
                                <div>
                                    <label
                                        class="d-flex align-items-center mb-3 form-check gap-2"
                                    >
                                        <input
                                            data-consent-checkbox
                                            id="question_data_consent"
                                            type="checkbox"
                                            required
                                            name="data_consent"
                                            class="form-check-input"
                                        />
                                        <label
                                            for="question_data_consent"
                                            class="form-check-checkbox"
                                        ></label>
                                        <span
                                        >Даю <a href="#consent-modal">согласие</a> на
                            обработку
                            <a href="https://magnit.ru/pdn/" target="_blank"
                            >персональных данных</a
                            >
                            *</span
                                        >
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="question__success d-none js-question-success">
                        <img src="data:image/svg+xml,%3csvg%20width='112'%20height='112'%20viewBox='0%200%20112%20112'%20fill='none'%20xmlns='http://www.w3.org/2000/svg'%3e%3crect%20x='24'%20y='23.8599'%20width='64'%20height='64'%20rx='6'%20fill='%23EAF7EB'/%3e%3cpath%20fill-rule='evenodd'%20clip-rule='evenodd'%20d='M25.7574%2025.6172C24%2027.3746%2024%2030.203%2024%2035.8599V75.8599C24%2081.5167%2024%2084.3451%2025.7574%2086.1025C27.5147%2087.8599%2030.3431%2087.8599%2036%2087.8599L65.7263%2087.8599C70.9151%2077.5242%2073.2789%2069.9888%2072.5475%2062.4752C72.1346%2058.2338%2071.0241%2054.0897%2069.261%2050.21C64.9575%2040.7402%2055.5439%2034.1731%2037.9987%2023.8599H36C30.3431%2023.8599%2027.5147%2023.8599%2025.7574%2025.6172Z'%20fill='url(%23paint0_linear_247_41455)'/%3e%3cpath%20d='M24%2057.6355V39.2221C26.114%2039.1218%2028.261%2039.8789%2029.8754%2041.4933L47.2011%2058.819L80.6661%2018.661C83.4184%2015.3583%2088.327%2014.912%2091.6297%2017.6643C94.9325%2020.4166%2095.3787%2025.3252%2092.6264%2028.6279L53.7044%2075.3343C52.3042%2077.0145%2050.2619%2078.0282%2048.077%2078.1273C45.8921%2078.2264%2043.7664%2077.4018%2042.2198%2075.8553L24%2057.6355Z'%20fill='url(%23paint1_linear_247_41455)'/%3e%3cdefs%3e%3clinearGradient%20id='paint0_linear_247_41455'%20x1='81.3342'%20y1='40.7487'%20x2='21.3342'%20y2='70.0821'%20gradientUnits='userSpaceOnUse'%3e%3cstop%20stop-color='%23ACDEB1'/%3e%3cstop%20offset='1'%20stop-color='%23ACDEB1'%20stop-opacity='0'/%3e%3c/linearGradient%3e%3clinearGradient%20id='paint1_linear_247_41455'%20x1='49.581'%20y1='74.5978'%20x2='32.6382'%20y2='27.2748'%20gradientUnits='userSpaceOnUse'%3e%3cstop%20stop-color='%232FAC3B'/%3e%3cstop%20offset='1'%20stop-color='%23ACDEB1'/%3e%3c/linearGradient%3e%3c/defs%3e%3c/svg%3e" alt="Успех!" />
                        <div class="question__success_text">
                            <h5>Заявка отправлена</h5>
                            <p>
                                Ответ придёт вам на&nbsp;почту или&nbsp;по&nbsp;телефону
                            </p>
                        </div>
                        <button class="btn btn-black js-question-again" type="button">
                            Хорошо
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</section>

<script>
    // Скрипт для отправки формы
    $(document).ready(function() {
        $('#question').submit(function(event) {
            event.preventDefault(); // Предотвращаем отправку формы по умолчанию

            var formData = new FormData(this); // Создаем объект FormData из формы

            $.ajax({
                url: '/ajax/forms/demoSaveForm.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Преобразование JSON-строки в объект
                    var responseObject = JSON.parse(response);

                    // Обработка успешного ответа
                    if (responseObject.success) {
                        console.log(responseObject);
                    } else {
                        console.log(responseObject);
                    }

                },
                error: function(xhr, status, error) {
                    // Обработка ошибки
                }
            });
        });
    });
</script>
