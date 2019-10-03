<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StorageLessons */

$this->title = Yii::t('app', 'Create Storage Lessons');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Storage Lessons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="storage-lessons-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
