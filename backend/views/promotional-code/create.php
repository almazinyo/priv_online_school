<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PromotionalCode */

$this->title = 'Create Promotional Code';
$this->params['breadcrumbs'][] = ['label' => 'Promotional Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promotional-code-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
