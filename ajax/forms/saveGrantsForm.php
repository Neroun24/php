<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

// Для отправки почты: START
require $_SERVER["DOCUMENT_ROOT"].'/local/libs/phpmailer/src/PHPMailer.php';
require $_SERVER["DOCUMENT_ROOT"].'/local/libs/phpmailer/src/SMTP.php';
require $_SERVER["DOCUMENT_ROOT"].'/local/libs/phpmailer/src/Exception.php';
// Для отправки почты: END

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

include 'smartCaptcha.php';


CModule::IncludeModule('iblock');

// заводимся
$el = new CIBlockElement;
$iblock_id = 1;
$iblock_section_id = 89;

$postTmp[] = '';
foreach ($_POST as $key => $item) {
    $item = htmlspecialchars($item, ENT_QUOTES, 'UTF-8');
    $postTmp[$key] = $item;
}
$_POST = $postTmp;


$agree = false;
if($_POST['data_consent'])
    $agree = 'Есть';

// Получал ли ранее гос поддержку
$received_support = 'Нет';
if($_POST['received_support'])
    $received_support = 'Есть';

// Зарегистрирован ли в системе электронный бюджет
$is_registered = 'Нет';
if($_POST['is_registered'])
    $is_registered = 'Есть';

// Имеет ли цифровую подпись
$consent = 'Нет';
if($_POST['consent'])
    $consent = 'Есть';

$PROPS = array();
$PROPS['FIO'] = $_POST['full_name'];
$PROPS['PHONE'] = $_POST['phone'];
$PROPS['EMAIL'] = $_POST['email'];
$PROPS['PRODUCTION'] = $_POST['product_type'];
$PROPS['COMPANY_SITE'] = $_POST['company_site'];
$PROPS['RECEIVED_SUPPORT'] = $_POST['received_support'];
$PROPS['IS_REGISTERED'] = $_POST['is_registered'];
$PROPS['CONSENT'] = $_POST['consent'];
$PROPS['AGREE'] = $agree;

// основные поля элемента
$fields = array(
    "DATE_CREATE" => date("d.m.Y H:i:s"),
    "CREATED_BY" => $GLOBALS['USER']->GetID(),
    "IBLOCK_ID" => $iblock_id,
    "IBLOCK_SECTION_ID" => $iblock_section_id,
    "PROPERTY_VALUES" => $PROPS,
    "NAME" => 'Заявка со страницы грантов: '.$PROPS['FIO'],
    "ACTIVE" => "Y",
);

$smartCaptchaCode = $_POST['smart-token'];
$res = check_captcha($smartCaptchaCode);

$return = ['success' => false];


// погнали
if(validation($PROPS) && $res) {
    if ($ID = $el->Add($fields)) {
        $return['success'] = true;
    }
    sendEmail($PROPS, $ID);
} elseif (!$res) {
    $return['msg'] = 'Пройдите проверку SmartCaptcha';
}

// отдаем ответ
echo json_encode($return);

function validation($array){
    $result = true;
    if (
        empty($array["FIO"]) ||
        empty($array["PHONE"]) ||
        empty($array["EMAIL"]) ||
        empty($array["PRODUCTION"]) ||
        empty($array["AGREE"])
    )
        $result = false;

    return $result;
}

function sendEmail($fields, $id) {
    $mail = new PHPMailer(true);
    $mail->IsHTML(true);
    try {
        // Настройки SMTP
        $mail->isSMTP();
        $mail->Host       = '10.8.53.53';  // Укажите адрес вашего SMTP-сервера
        $mail->SMTPAuth   = true;
        $mail->Username   = 'svc_agrofermer';    // Укажите ваше имя пользователя SMTP
        $mail->Password   = 'R52Rqgudwffr';    // Укажите ваш пароль SMTP
        $mail->Port       = 25;                 // Порт вашего SMTP-сервера
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
//        $mail->SMTPDebug  = 2;
        $mail->Timeout    = 5;    // Таймаут в секундах

        // Отправитель и получатель
        $mail->setFrom('svc_agrofermer@magnit.ru', 'Agro');
        $mail->addAddress('raz_sh@magnit.ru', 'raz_sh');
        $mail->addAddress('osmanov_bg@magnit.ru', 'osmanov_bg');
        $mail->addAddress('maksimtcov_dv@magnit.ru', 'maksimtcov_dv');

        // Тема и тело письма
        $mail->Subject = 'Заявка со страницы грантов. ID: '.$id;

        $msg = "
            ФИО: {$fields['FIO']}
            Телефон: {$fields['PHONE']}
            E-mail: {$fields['EMAIL']}
            Сайт компании: {$fields['COMPANY_SITE']}
            Получал ли ранее гос поддержку: {$fields['RECEIVED_SUPPORT']}
            Зарегистрирован ли в системе электронный бюджет: {$fields['IS_REGISTERED']}
            Имеет ли цифровую подпись: {$fields['CONSENT']}
        ";
        // Шаблон Email
//        require $_SERVER["DOCUMENT_ROOT"].'/local/include/emails/questionFormEmail.php';
        $mail->Body = $msg;

        // Отправка письма
        if ($mail->send())
            $return['success'] = true;
        else
            $return['success'] = false;
//        echo json_encode($return);
    } catch (Exception $e) {
        $return['success'] = false;
//        echo json_encode($return);
//        echo "Email not sent. Error: {$mail->ErrorInfo}";
    }
}

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
