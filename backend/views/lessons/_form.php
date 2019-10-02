<?php

use common\models\SectionSubjects;
use common\models\Subjects;
use kartik\select2\Select2;
use kartik\switchinput\SwitchInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\redactor\widgets\Redactor;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Lessons */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lessons-form">

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
                            'onText' => Yii::t('app','Active'),
                            'offText' => Yii::t('app','Inactive'),
                        ],
                ]
            )
        ;
        ?>
    </div>

    <div class="col-xs-12">
        <?= $form->field($model, 'section_id')->widget(
            Select2::classname(), [
            'data' =>
                ArrayHelper::map(
                    SectionSubjects::find()
                        ->select('id,name')
                        ->asArray()
                        ->all(),
                    "id", "name"),
            'options' => ['placeholder' => 'Parent'],
            'pluginOptions' => ['allowClear' => true],
        ])
        ;
        ?>
    </div>
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-6"><?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?></div>
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
        <div class="row">
            <div class="col-xs-6"><?= $form->field($model, 'background')->textInput(['maxlength' => true]) ?></div>
            <div class="col-xs-6"><?= $form->field($model, 'logo')->textInput(['maxlength' => true]) ?></div>
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
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
