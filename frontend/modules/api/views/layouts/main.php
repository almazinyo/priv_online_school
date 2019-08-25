<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
$homeUrl = Yii::$app->homeUrl;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <link rel="preload" href="<?= $homeUrl ?>/fonts/Gilroy-300/Gilroy-300.woff" as="font" type="font/woff" crossorigin>
    <link rel="preload" href="<?= $homeUrl ?>/fonts/Gilroy-400/Gilroy-400.woff" as="font" type="font/woff" crossorigin>
    <link rel="preload" href="<?= $homeUrl ?>/fonts/Gilroy-600/Gilroy-600.woff" as="font" type="font/woff" crossorigin>
    <link rel="preload" href="<?= $homeUrl ?>/fonts/Gilroy-800/Gilroy-800.woff" as="font" type="font/woff" crossorigin>
    <link rel="preload" href="<?= $homeUrl ?>/fonts/Icons/examator.woff" as="font" type="font/woff" crossorigin>
    <?php $this->head() ?>
</head>
<body class=" d-flex flex-column">
<?php $this->beginBody(); ?>
<?= $this->render('/partials/header', ['homeUrl' => $homeUrl]) ?>
<?= $content ?>
<?= $this->render('/partials/footer', ['homeUrl' => $homeUrl]) ?>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
