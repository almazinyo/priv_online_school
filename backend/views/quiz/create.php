<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Quiz */

$this->title = Yii::t('app', 'Create Quiz');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Quizzes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quiz-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
