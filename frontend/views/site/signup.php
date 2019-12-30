<?= yii\authclient\widgets\AuthChoice::widget([
    'baseAuthUrl' => ['site/auth'],
    'popupMode' => false,
]) ?>
<a target="_blank"
   href="https://sp-money.yandex.ru/oauth/authorize?client_id=3D5B0CC4FEE00E201B331D31F8406F8AF42F7EA7DFC2294F9D074AC7249BA304&response_type=code&redirect_uri=http://api.examator.ru/site/signup&scope=payment-shop account-info operation-history operation-details">
    yandex
</a>
<?php

use  yii\authclient\clients\Yandex;
use  YandexMoney\API;

$client_id = '3D5B0CC4FEE00E201B331D31F8406F8AF42F7EA7DFC2294F9D074AC7249BA304';
$redirect_uri = 'http://api.examator.ru/site/signup';
$scope = [
    'payment-shop',
//    'payment',
//    'payment-p2p',
    'account-info',
    'operation-history',
    'operation-details',
    'incoming-transfers',
    'money-source',
];
$client_secret = '786A6C9B982A92BD1D79113B4DF233699D67ACE909CFFC2D141FCDFF4F8F0927FB39B15841EBF3EC20D897D5384D08C6057D8044AF97D2ECADB6C28FA6F163DB';

//$auth_url = API::buildObtainTokenUrl($client_id, $redirect_uri, $scope);

if (!empty($_GET['code'])) {
    var_dump($_GET['code']);
    $access_token_response =
        API::getAccessToken(
            $client_id,
            $_GET['code'],
            $redirect_uri,
            $client_secret
        );
    var_dump($access_token_response);
//
//    $api = new API($client_secret);
//
//    $request_payment = $api->requestPayment([
//        "pattern_id" => "p2p",
//        "to" => '410013781874599',
//        "amount_due" => 123,
//        "comment" => '$comment',
//        "message" => '$message',
//        "label" => '$label',
//    ]);

//    var_dump($request_payment);
}
if (!empty($_POST)) {
    $hash =
        sha1(
            sprintf(
                '%s&%s&%s&%s&%s&%s&%s&%s&%s',
                $_POST['notification_type'],
                $_POST['operation_id'],
                $_POST['amount'],
                $_POST['currency'],
                $_POST['datetime'],
                $_POST['sender'],
                $_POST['codepro'],
                'Du9j+ADcTDWjPbB24I4Mm3BP',
                $_POST['label']
            )
        );

    if ($_POST['sha1_hash'] != $hash || $_POST['codepro'] === true || $_POST['unaccepted'] === true) {
        file_put_contents('error.php', $_POST['sha1_hash'] != $hash, FILE_APPEND);
    }
    //Du9j+ADcTDWjPbB24I4Mm3BP
    file_put_contents('history.php', $_POST['operation_id'] . '---' . $_POST['title'], FILE_APPEND);
    exit();
}

var_dump($_POST);
var_dump($_GET);

?>
<form method="POST" action="https://money.yandex.ru/quickpay/confirm.xml">
    <input type="hidden" name="receiver" value="410013781874599">
    <input type="hidden" name="label" value="test-test-label">
    <input type="hidden" name="operation_id" value="1">
    <input type="hidden" name="operation-details" value="true">
    <input type="hidden" name="formcomment" value="Examator">
    <input type="hidden" name="short-dest" value="Онлайн школа examator.ru">
    <input type="hidden" name="quickpay-form" value="shop">
    <input type="hidden" name="targets" value="Examator">
    <input type="hidden" name="sum" value="2" data-type="number">
    <input type="hidden" name="comment" value="Платеж  за  урока ">
    <input type="hidden" name="message" value="Платеж  за  урока ">
    <input type="hidden" name="codepro" value="true">
    <input type="hidden" name="successURL" value="http://dev.examator.ru/">

    <input type="hidden" name="paymentType" value="payment-shop">
    <input type="submit" value="Перевести">
</form>
