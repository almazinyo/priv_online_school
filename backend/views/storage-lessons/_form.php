<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\StorageLessons */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="storage-lessons-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'lesson_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'pdf' => 'Pdf', 'image' => 'Image', 'video' => 'Video', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'is_status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
