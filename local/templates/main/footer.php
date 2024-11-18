<?php
$style = 'footer--main';
if ($arUri[1] == 'grant-information')
    $style = 'footer--grants';
elseif ($arUri[1] == 'consult')
    $style = 'footer--consulting';

?><footer class="footer <?=$style?>">

    <?php if (empty($arUri[1])):?>
        <?php require($_SERVER["DOCUMENT_ROOT"]."/local/include/forms/mainForm.php");?>
    <?php elseif($arUri[1] == 'consult'):?>
        <?php require($_SERVER["DOCUMENT_ROOT"]."/local/include/forms/consultForm.php");?>
    <?php endif;?>



    <div class="container px-2">
        <hr class="footer__separator" />
        <p class="footer__paragraph footer__paragraph--leading">
            Остались вопросы? Позвоните нам по вопросам:
        </p>
        <div class="footer-contacts">
            <a href="tel:88612109810" class="footer__heading"
            >8 (861) 210-98-10</a
            >
            <ul class="footer-contacts-list">
                <li class="footer-contacts-list-item">
                    <p class="footer__heading">доб. 15474</p>
                    <p class="footer__paragraph">Овощи</p>
                </li>
                <li class="footer-contacts-list-item">
                    <p class="footer__heading">доб. 41462</p>
                    <p class="footer__paragraph">Плодовые культуры</p>
                </li>
                <li class="footer-contacts-list-item">
                    <p class="footer__heading">доб. 47785</p>
                    <p class="footer__paragraph">Мясо, молоко, птица, яйцо</p>
                </li>
            </ul>
            <hr class="footer__separator footer__separator--mobile" />
            <div class="footer-location">
                <p class="footer__paragraph footer__paragraph--right">
                    E-mail:
                    <a class="footer__link" href="mailto:raz_sh@magnit.ru"
                    >raz_sh@magnit.ru</a
                    >
                </p>
                <p class="footer__paragraph">
                    Адрес: Краснодарский край,<br />г. Краснодар, п. Дорожный
                </p>
            </div>
        </div>
        <hr class="footer__separator" />
        <ul class="footer-links">
            <li class="footer-link footer-link--heading">
                © Группа компаний «Магнит»
            </li>
            <li class="footer-link footer-link--policies">
                <a
                        class="footer-link__link"
                        href="https://magnit.ru/cookie-policy/"
                        target="_blank"
                >Политика в отношении файлов cookie</a
                >
                <a
                        class="footer-link__link"
                        href="https://magnit.ru/pdn/"
                        target="_blank"
                >Политика обработки персональных данных</a
                >
            </li>
        </ul>
    </div>
</footer>
<div class="cookie js-cookie-alert">
    <div class="cookie__title">Мы используем файлы cookie</div>
    <div class="cookie__body">
        <p>
            «Магнит» использует файлы «cookie» для удобства пользования
            веб-сайтом. «Cookie» представляют собой небольшие файлы, содержащие
            информацию о предыдущих посещениях веб-сайта. Продолжая использовать
            наш сайт, вы даете согласие на их обработку.
        </p>
    </div>
    <div class="cookie__btn">
        <button class="btn btn-gray js-cookie-btn" type="button">
            Хорошо, закрыть</button
        ><a
                class="btn btn-gray js-cookie-btn mt-1"
                href="https://magnit.ru/cookie-policy/"
                target="_blank"
        >Подробнее</a
        >
    </div>
</div>

<svg class="hidden" width="0" height="0">
    <symbol id="arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 24">
        <path
                d="M15.2071 6.29289C14.8166 5.90237 14.1834 5.90237 13.7929 6.29289C13.4024 6.68342 13.4024 7.31658 13.7929 7.70711L17.0858 11L5.5 11C4.94772 11 4.5 11.4477 4.5 12C4.5 12.5523 4.94772 13 5.5 13L17.0858 13L13.7929 16.2929C13.4024 16.6834 13.4024 17.3166 13.7929 17.7071C14.1834 18.0976 14.8166 18.0976 15.2071 17.7071L20.2059 12.7083C20.21 12.7043 20.214 12.7002 20.218 12.6961C20.3919 12.5167 20.4992 12.2724 20.5 12.003L20.5 12L20.5 11.997C20.4996 11.8625 20.4727 11.7343 20.4241 11.6172C20.3753 11.4993 20.303 11.3888 20.2071 11.2929L15.2071 6.29289Z"
        ></path>
    </symbol>
    <symbol
            id="arrow-left"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
    >
        <path
                d="M9.29289 6.29289C9.68342 5.90237 10.3166 5.90237 10.7071 6.29289C11.0976 6.68342 11.0976 7.31658 10.7071 7.70711L7.41421 11L19 11C19.5523 11 20 11.4477 20 12C20 12.5523 19.5523 13 19 13L7.41421 13L10.7071 16.2929C11.0976 16.6834 11.0976 17.3166 10.7071 17.7071C10.3166 18.0976 9.68342 18.0976 9.29289 17.7071L4.29407 12.7083C4.29003 12.7043 4.28602 12.7002 4.28205 12.6961C4.10811 12.5167 4.00079 12.2724 4 12.003L4 12L4 11.997C4.0004 11.8625 4.02735 11.7343 4.07588 11.6172C4.12468 11.4993 4.19702 11.3888 4.29289 11.2929L9.29289 6.29289Z"
        ></path>
    </symbol>
</svg>
</body>
</html>