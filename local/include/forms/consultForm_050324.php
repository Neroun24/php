<div class="container px-2">
    <form class="consult-form" action="/ajax/forms/saveConsultForm.php" id="footerConsultingForm">
        <h2 class="consult-form__heading">Заполните анкету</h2>
        <div class="row mb-lg-2 mb-2">
            <div class="d-flex flex-column-reverse col-12 col-lg">
                <select
                    required
                    name="direction"
                    class="custom-select"
                    data-placeholder="Направление*"
                    title="Обязательно для заполнения"
                >
                    <option></option>
                    <option value="Растениеводство">Растениеводство</option>
                    <option value="Животноводство">Животноводство</option>
                    <option value="Мелиорация">Мелиорация</option>
                    <option value="с/х страхование">с/х страхование</option>
                    <option value="с/х техника">с/х техника</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg">
                <div class="form-group" data-field-holder>
                    <input
                        class="form-control"
                        type="text"
                        name="full_name"
                        required
                        title="Обязательно для заполнения"
                        placeholder="ФИО*"
                    />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg">
                <div class="form-group" data-field-holder>
                    <input
                        class="form-control"
                        type="tel"
                        name="phone_number"
                        required
                        title="Обязательно для заполнения"
                        placeholder="Номер телефона*"
                    />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg">
                <div class="form-group" data-field-holder>
                    <input
                        class="form-control"
                        type="email"
                        name="email"
                        required
                        title="Обязательно для заполнения"
                        placeholder="Email*"
                    />
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div
                class="d-flex flex-column col-12 col-lg autocomplete-input-wrap"
            >
                <button
                    type="button"
                    class="autocomplete-input-wrap__cross"
                    aria-label="Сбросить выбор"
                    title="Сбросить выбор"
                >
                    <span aria-hidden="true">×</span>
                </button>
                <input
                    placeholder="Выбор области*"
                    id="question_form_country"
                    name="city"
                    required
                    class="autocomplete-input"
                    title="Обязательно для заполнения"
                />
            </div>
        </div>
        <div class="row mb-3">
            <div class="d-flex flex-column-reverse col-12 col-lg">
                <select
                    name="grown_cultures"
                    class="custom-select"
                    required
                    data-placeholder="Выращиваемые культуры*"
                    title="Обязательно для заполнения"
                >
                    <option></option>
                    <option value="Тест 1">Тест 1</option>
                    <option value="Тест 2">Тест 2</option>
                </select>
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
        <div class="row mb-3">
            <div class="d-flex col-12 col-lg">
                <button
                    class="bg-danger text-white p-2 flex-grow-1 b-0 radius-md"
                >
                    Отправить
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg order-lg-1 pr-lg-3">
                <div>
                    <label
                        class="d-flex align-items-center mb-2 form-check gap-lg-2 gap-1"
                    >
                        <input
                            data-consent-checkbox
                            id="consent"
                            type="checkbox"
                            name="has_digit_signature"
                            class="form-check-input"
                        />
                        <label
                            for="consent"
                            class="form-check-checkbox"
                        ></label>
                        <span class="text-style-body-large-regular"
                        >Даю <a class="text-underline" href="#consent-modal">согласие</a> на
                    обработку
                    <a class="text-underline" href="https://magnit.ru/pdn/" target="_blank"
                    >персональных данных</a
                    >
                    *</span
                        >
                    </label>
                </div>
            </div>
        </div>
    </form>
</div>