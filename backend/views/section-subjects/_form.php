<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;
use yii\redactor\widgets\Redactor;
use yii\helpers\Url;
use kartik\select2\Select2;
use common\models\Subjects;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Subjects */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subjects-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="col-xs-12">
        <?= $form->field($model, 'is_status')
            ->widget(
                SwitchInput::classname(),
                [
                    'value' => true,
                    'pluginOptions' =>
                        [
                            'size' => 'large',
                            'onColor' => 'success',
                            'offColor' => 'danger',
                            'onText' => 'Active',
                            'offText' => 'Inactive',
                        ],
                ]
            )
        ;
        ?>
    </div>

    <div class="col-xs-12">
        <?= $form->field($model, 'subject_id')->widget(
            Select2::classname(), [
            'data' =>
                ArrayHelper::map(
                    Subjects::find()
                        ->select('id,title')
                        ->asArray()
                        ->all(),
                    "id", "title"),
            'options' => ['placeholder' => 'Parent'],
            'pluginOptions' => ['allowClear' => true],
        ])
        ;
        ?>
    </div>
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-6"><?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?></div>
            <div class="col-xs-6"><?= $form->field($model, 'short_description')->textarea(['row' => 3]) ?></div>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-6"><?= $form->field($model, 'seo_keywords')->textInput(['maxlength' => true]) ?></div>
            <div class="col-xs-6"><?= $form->field($model, 'seo_description')->textarea(['row' => 3]) ?></div>
        </div>
    </div>
    <div class="col-xs-12">
        <?= $form->field($model, 'description')
            ->widget(
                Redactor::className(),
                [
                    'clientOptions' =>
                        [
                            'imageUpload' => Url::to(['/redactor/upload/image']),
                            'fileUpload' => false,
                            'plugins' => ['fontcolor', 'imagemanager', 'table', 'undoredo', 'clips', 'fullscreen'],
                        ],
                ]
            )
        ; ?>
    </div>
    <div class="form-group">
        <?=
        Html::submitButton(
            $model->isNewRecord
                ? Yii::t('app', 'Create')
                : Yii::t('app', 'Update'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
