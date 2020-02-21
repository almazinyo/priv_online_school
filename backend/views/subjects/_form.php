<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;
use yii\redactor\widgets\Redactor;
use yii\helpers\Url;

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
                    'type' => SwitchInput::RADIO,
                    'items' => [
                        ['label' => Yii::t('app', 'visible to everyone'), 'value' => 1],
                        ['label' => Yii::t('app', 'prohibition of visibility'), 'value' => 2],
                        ['label' => Yii::t('app', 'not visible to anyone'), 'value' => 0],
                    ],
                    'pluginOptions' =>
                        [
                            'size' => 'large',
                            'onColor' => 'success',
                            'offColor' => 'danger',
                            'onText' => Yii::t('app', 'Active'),
                            'offText' => Yii::t('app', 'Inactive'),
                        ],
                ]
            )
        ;
        ?>
    </div>
    <div class="col-xs-12">
        <?= $form->field($model, 'sortable_id')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-6"><?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?></div>
            <div class="col-xs-6"><?= $form->field($model, 'short_description')->textarea(['row' => 3]) ?></div>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-6"><?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?></div>
            <div class="col-xs-6"><?= $form->field($model, 'stock')->textInput(['maxlength' => true]) ?></div>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-6"><?= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?></div>
            <div class="col-xs-6">
                <?= $form->field($model, 'color')->widget(
                    \kartik\color\ColorInput::classname(),
                    [
                        'options' => ['placeholder' => Yii::t('app', 'Select color ...')],
                    ]
                )
                ; ?>
            </div>

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
