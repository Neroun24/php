<div class="grants-modal" style="display: none">
    <img
        src="data:image/svg+xml,%3csvg%20width='12'%20height='12'%20viewBox='0%200%2012%2012'%20fill='none'%20xmlns='http://www.w3.org/2000/svg'%3e%3cpath%20d='M0.292918%2010.2922C-0.09762%2010.6827%20-0.0976421%2011.3158%200.292869%2011.7064C0.683379%2012.0969%201.31654%2012.0969%201.70708%2011.7064L5.99981%207.41401L10.2914%2011.7056C10.6819%2012.0961%2011.3151%2012.0961%2011.7056%2011.7056C12.0961%2011.3151%2012.0961%2010.6819%2011.7056%2010.2914L7.41407%205.99985L11.7071%201.70713C12.0976%201.31662%2012.0976%200.683456%2011.7071%200.292918C11.3166%20-0.0976204%2010.6835%20-0.0976419%2010.2929%200.292869L5.99986%204.58563L1.70712%200.292895C1.31659%20-0.0976292%200.683429%20-0.0976292%200.292905%200.292895C-0.0976195%200.683419%20-0.0976195%201.31658%200.292905%201.70711L4.58559%205.9998L0.292918%2010.2922Z'%20fill='%232A2A2A'/%3e%3c/svg%3e"
        alt="Закрыть модальное окно"
        class="grants-modal__cross"
        id="closeModal"
    />
    <h3 class="grants-modal__heading">Заполните анкету</h3>
    <form class="grants-modal-form" action="#" data-validate-form>
        <div class="row grants-radio-grid mb-3">
            <div class="col-12 col-lg">
                <label class="form-check radio radio-btn">
                    <input
                        class="form-check-input"
                        type="radio"
                        id="question_product_type-vegs"
                        name="product_type"
                        checked
                    />
                    <span class="form-check-name">Растениеводство</span>
                </label>
            </div>
            <div class="col-12 col-lg">
                <label class="form-check radio radio-btn">
                    <input
                        class="form-check-input"
                        type="radio"
                        id="question_product_type-fruits"
                        name="product_type"
                    />
                    <span class="form-check-name">Животноводство</span>
                </label>
            </div>
            <div class="col-12 col-lg">
                <label class="form-check radio radio-btn">
                    <input
                        class="form-check-input"
                        type="radio"
                        id="question_product_type-meat"
                        name="product_type"
                    />
                    <span class="form-check-name text-nowrap">Мелиорация</span>
                </label>
            </div>
            <div class="col-12 col-lg">
                <label class="form-check radio radio-btn">
                    <input
                        class="form-check-input"
                        type="radio"
                        id="question_product_type-other"
                        name="product_type"
                    />
                    <span class="form-check-name">с/х страхование</span>
                </label>
            </div>
            <div class="col-12 col-lg">
                <label class="form-check radio radio-btn">
                    <input
                        class="form-check-input"
                        type="radio"
                        id="question_product_type-other"
                        name="product_type"
                    />
                    <span class="form-check-name">с/х техника</span>
                </label>
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
                        type="text"
                        name="test"
                        placeholder="Тест"
                    />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg">
                <div class="form-group" data-field-holder>
                    <input
                        class="form-control"
                        type="text"
                        name="company_site"
                        placeholder="Сайт компании"
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
                        name="phone"
                        required
                        title="Обязательно для заполнения"
                        placeholder="Номер телефона*"
                    />
                </div>
            </div>
        </div>

        <div class="row mb-lg-2 mb-1">
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

        <div class="row">
            <div class="col-12 col-lg order-lg-1 pr-lg-3">
                <div>
                    <label class="d-flex align-items-center mb-2 form-check gap-lg-2 gap-1">
                        <input
                            id="question_check_1"
                            type="checkbox"
                            name="received_support"
                            class="form-check-input"
                        />
                        <label for="question_check_1" class="form-check-checkbox"></label>
                        <span class="text-style-body-large-regular">Получал ли ранее гос поддержку</span>
                    </label>
                </div>
            </div>
        </div>

		<div class="row">
            <div class="col-12 col-lg order-lg-1 pr-lg-3">
                <div>
                    <label class="d-flex align-items-center mb-2 form-check gap-lg-2 gap-1">
                        <input
                            id="question_check_4"
                            type="checkbox"
                            name="test2"
                            class="form-check-input"
                        />
                        <label for="question_check_4" class="form-check-checkbox"></label>
                        <span class="text-style-body-large-regular">Тест2</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg order-lg-1 pr-lg-3">
                <div>
                    <label class="d-flex align-items-center mb-2 form-check gap-lg-2 gap-1">
                        <input
                            id="question_check_2"
                            type="checkbox"
                            name="is_registered"
                            class="form-check-input"
                        />
                        <label for="question_check_2" class="form-check-checkbox"></label>
                        <span class="text-style-body-large-regular">Зарегистрирован ли в системе электронный бюджет</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-12 col-lg order-lg-1 pr-lg-3">
                <div>
                    <label class="d-flex align-items-center mb-2 form-check gap-lg-2 gap-1">
                        <input
                            id="question_check_3"
                            type="checkbox"
                            name="consent"
                            class="form-check-input"
                        />
                        <label for="question_check_3" class="form-check-checkbox"></label>
                        <span class="text-style-body-large-regular">Имеет ли цифровую подпись</span>
                    </label>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <div style="height: 100px" id="captcha-container" class="smart-captcha" data-sitekey="ysc1_TKeZQUujZQS6hZmSeU8U1I633q4wg8SMh2FSWzKw8be9665d"></div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="d-flex col-12 col-lg">
                <button class="bg-danger text-white p-2 flex-grow-1 b-0 radius-md">
                    Отправить
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg order-lg-1 pr-lg-3">
                <div>
                    <label class="d-flex align-items-center mb-2 form-check gap-lg-2 gap-1">
                        <input
                            data-consent-checkbox
                            id="consent"
                            type="checkbox"
                            name="has_digit_signature"
                            class="form-check-input"
                        />
                        <label for="consent" class="form-check-checkbox"></label>
                        <span class="text-style-body-large-regular">
                            Даю <a class="text-underline" href="https://magnit.ru/pdn/" target="_blank">согласие</a> на обработку <a class="text-underline" href="https://magnit.ru/pdn/" target="_blank">персональных данных</a>*
                        </span>
                    </label>
                </div>
            </div>
        </div>
    </form>
</div>