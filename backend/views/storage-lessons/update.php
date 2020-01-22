<?php

use yii\helpers\Html;
use common\models\Lessons;

/* @var $this yii\web\View */
/* @var $model common\models\StorageLessons */

$name = Lessons::findOne($model->lesson_id)->name;
$this->title = Yii::t('app', 'Update Storage Lessons: {name}', [
    'name' => $name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Storage Lessons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' =>$name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="storage-lessons-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
