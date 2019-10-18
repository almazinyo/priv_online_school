<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\grid\models\GridSort */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Grid Sort',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Grid Sorts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="grid-sort-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
