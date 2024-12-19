<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$lang = mb_strtoupper(LANGUAGE_ID);

$arUri = parse_url($_SERVER['REQUEST_URI'])['path'];
$arUri = explode('/', $arUri);
$arUri = array_diff($arUri, array('', 'en'));

// система переключения языка на ту-же страницу для пары RU/EN
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$uri = new \Bitrix\Main\Web\Uri($request->getRequestUri());

$arUrlParams = $uri->getQuery();
$search = "/?" . $arUrlParams;
$uriWithoutParams = str_replace($search, "/", $uri);

$arLangs = array('/en/');
$uriWithoutLang = str_replace($arLangs, "/", $uriWithoutParams);

// Проверка на главную страницу
$isHomePage = empty($arUri[1]);

$rootPath = "/";
if ($lang != 'RU')
    $rootPath = "/".LANGUAGE_ID.'/';

$appVersion = '11';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <?$APPLICATION->ShowHead();?>
    <meta charset="utf-8" />
    <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, maximum-scale=1.0"
    />
    <!--favicon-->
    <link rel="shortcut icon" href="/assets/favicon.ico" type="image/x-icon" />
    <link
            rel="apple-touch-icon"
            sizes="180x180"
            href="/assets/apple-touch-icon.png"
    />
    <link
            rel="icon"
            type="image/png"
            sizes="32x32"
            href="/assets/favicon-32x32.png"
    />
    <link
            rel="icon"
            type="image/png"
            sizes="16x16"
            href="/assets/favicon-16x16.png"
    />
    <link rel="manifest" href="/site.webmanifest" />
    <link
            rel="mask-icon"
            href="/assets/safari-pinned-tab.svg"
            color="#5bbad5"
    />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="theme-color" content="#ffffff" />
    <!-- meta-->
    <title>Сотрудничайте с Магнит по агроконтракту</title>
    <meta
            name="description"
            content="Расширяйте возможности вашего бизнеса с Магнит. Оставьте заявку на заключение агроконтракта"
    />
    <meta
            name="keywords"
            content="Агроконтракт, агроконтрактация, заключить контракт с Магнит, поставщик, поставка сельхоз продукции, сотрудничество с магнит"
    />
    <meta property="og:url" content="https://agro.magnit.ru" />
    <meta
            property="og:title"
            content="Сотрудничайте с Магнит по агроконтракту"
    />
    <meta
            property="og:description"
            content="Расширяйте возможности вашего бизнеса с Магнит. Оставьте заявку на заключение агроконтракта"
    />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="" />
    <link rel="canonical" href="https://agro.magnit.ru" />
    <!-- css-->

    <link
            href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
            rel="stylesheet"
    />
    <link rel="stylesheet" href="/js/jquery-ui.min.css" />
    <link rel="stylesheet" crossorigin href="/assets/css/styles.css?v=<?=$appVersion?>">

    <script src="https://cdn.jsdelivr.net/npm/hls.js@1"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/swiper-bundle.min.js"></script>
    <script src="/assets/js/jquery.3.3.1.min.js"></script>
    <script src="/assets/js/jquery.mask.js"></script>
    <script src="/assets/js/jquery.validate.js"></script>
    <script src="/assets/js/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="/assets/js/scripts.js?v=<?=$appVersion?>"></script>
    <script src="/assets/js/scripts-grant.js?v=<?=$appVersion?>"></script>
    <script src="/assets/js/scripts-consult.js?v=<?=$appVersion?>"></script>

    <script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>
</head>
<body>
<? $APPLICATION->ShowPanel();?>

<div class="form-submission-modal" style="display: none">
    <h3 class="form-submission-modal__heading">
        <a href="https://magnit.ru/pdn/" target="_blank"
        >Согласие на обработку персональных данных</a
        >
    </h3>
    <button
            class="form-submission-modal__cross"
            data-role="form-modal-close-button"
    >
        <img
                class="form-submission-modal__cross-image"
                src="data:image/svg+xml,%3csvg%20width='12'%20height='12'%20viewBox='0%200%2012%2012'%20fill='none'%20xmlns='http://www.w3.org/2000/svg'%3e%3cpath%20d='M0.292918%2010.2922C-0.09762%2010.6827%20-0.0976421%2011.3158%200.292869%2011.7064C0.683379%2012.0969%201.31654%2012.0969%201.70708%2011.7064L5.99981%207.41401L10.2914%2011.7056C10.6819%2012.0961%2011.3151%2012.0961%2011.7056%2011.7056C12.0961%2011.3151%2012.0961%2010.6819%2011.7056%2010.2914L7.41407%205.99985L11.7071%201.70713C12.0976%201.31662%2012.0976%200.683456%2011.7071%200.292918C11.3166%20-0.0976204%2010.6835%20-0.0976419%2010.2929%200.292869L5.99986%204.58563L1.70712%200.292895C1.31659%20-0.0976292%200.683429%20-0.0976292%200.292905%200.292895C-0.0976195%200.683419%20-0.0976195%201.31658%200.292905%201.70711L4.58559%205.9998L0.292918%2010.2922Z'%20fill='%232A2A2A'/%3e%3c/svg%3e"
                alt="Закрыть модальное окно"
        />
    </button>
    <div class="form-submission-modal__text">
        <span
        >В соответствии с требованиями Федерального закона от 27.07.2006 № 152
          - ФЗ «О персональных данных», я, действуя свободно, своей волей и в
          своем интересе, даю согласие</span
        >
        <br />
        <span
        >Оператору персональных данных (далее – «Оператор») акционерному
          обществу «Тандер», (ИНН 2310031475, ОГРН 1022301598549, адрес: 350072,
          Краснодарский край, г. Краснодар, ул. Леваневского, д. 185), на
          обработку персональных данных с использованием средств автоматизации
          или без использования таких средств,</span
        >
        <br />
        <span>в целях:</span>
        <br />
        <ul>
            <li>Установления делового партнерства;</li>
        </ul>
        <span
        >Перечень персональных данных, на обработку которых я даю согласие,
          включает:</span
        >
        <br />
        <ul>
            <li>фамилия, имя, отчество;</li>
            <li>абонентский (мобильный) номер телефона;</li>
            <li>адрес электронной почты;</li>
        </ul>
        <span
        >Я даю согласие на передачу в объеме и содержании, необходимом для
          достижения целей, перечисленных выше, моих персональных данных третьим
          лицам:</span
        >
        <br />
        <ul>
            <li>
                Наименование третьих лиц: ООО &quot;ТД-ХОЛДИНГ&quot; (ИНН
                2310057787, адрес: 350024, Краснодарский край, город Краснодар,
                Солнечная ул., д. 15/4); ООО &quot;Магнит Агро Фермер&quot; (ИНН
                2311351020, адрес: 350024 Краснодарский край, г. Краснодар, ул.
                Московская, д.104, помещ.336); ООО ИТМ (ИНН 2311168514, адрес:
                Краснодарский кр., г. Краснодар, ул. Солнечная, д. 15/5)
            </li>
        </ul>
        <br />
        <span
        >Перечень действий с персональными данными: сбор, запись,
          систематизация, накопление, хранение, уточнение (обновление,
          изменение), извлечение, использование, передачу (предоставление,
          доступ), блокирование, удаление, уничтожение,</span
        >
        <br />
        <span
        >Настоящее согласие действует со дня его подписания до достижения
          целей обработки.</span
        >
        <br />
        <span
        >Согласие может быть отозвано вами или вашим представителем путем
          направления АО «Тандер» письменного заявления или электронного
          заявления, подписанного согласно законодательству Российской Федерации
          в области электронной подписи, по адресу, указанному в начале
          Согласия.</span
        >
    </div>
</div>
<header class="header">
    <div class="container">
        <a class="header__logo" href="<?=$rootPath?>"
        ><img height="40" src="/assets/img/logo.png" alt="Магнит"
            /></a>
        <nav class="header__nav">
            <?php
            $jsNavStyle = '';
            if ($isHomePage)
                $jsNavStyle = 'js-nav-link';
            ?>
            <ul>
                <li><a class="<?=$jsNavStyle?>" href="/#advantages">Преимущества</a></li>
                <li><a href="/consult">Консалтинг</a></li>
                <li><a class="<?=$jsNavStyle?>" href="/#whodowework">С кем мы работаем</a></li>
                <li><a href="/grant-information">Информация о грантах</a></li>
            </ul>
        </nav>
        <button class="btn header__toggle js-nav-toggle" type="button">
            <img src="data:image/svg+xml,%3csvg%20width='24'%20height='24'%20viewBox='0%200%2024%2024'%20fill='none'%20xmlns='http://www.w3.org/2000/svg'%3e%3cpath%20d='M22%207C22%207.55228%2021.5523%208%2021%208L3%208C2.44772%208%202%207.55228%202%207C2%206.44771%202.44772%206%203%206H21C21.5523%206%2022%206.44772%2022%207Z'%20fill='%232A2A2A'/%3e%3cpath%20d='M22%2012C22%2012.5523%2021.5523%2013%2021%2013L3%2013C2.44772%2013%202%2012.5523%202%2012C2%2011.4477%202.44772%2011%203%2011L21%2011C21.5523%2011%2022%2011.4477%2022%2012Z'%20fill='%232A2A2A'/%3e%3cpath%20d='M21%2018C21.5523%2018%2022%2017.5523%2022%2017C22%2016.4477%2021.5523%2016%2021%2016L3%2016C2.44772%2016%202%2016.4477%202%2017C2%2017.5523%202.44772%2018%203%2018L21%2018Z'%20fill='%232A2A2A'/%3e%3c/svg%3e" alt="" />
        </button>
    </div>
</header>
