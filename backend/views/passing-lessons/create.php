<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PassingLessons */

$this->title = Yii::t('app', 'Create Passing Lessons');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Passing Lessons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="passing-lessons-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
