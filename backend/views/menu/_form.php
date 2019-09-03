<?php

use common\models\Menu;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;
use yii\redactor\widgets\Redactor;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Menu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-form">

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
        <div class="row">
            <div class="col-xs-6"><?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?></div>
            <div class="col-xs-6">
                <?php
                if ($model->isNewRecord) {
                    $data = ArrayHelper::map(Menu::find()
                        ->select('id,name')
                        ->where(['is_status' => true])
                        ->asArray()
                        ->all(), "id", "name");
                } else {
                    $data = ArrayHelper::map(Menu::find()
                        ->select('id,name')
                        ->where(['is_status' => true])
                        ->andWhere(['!=', 'id', $model->id])
                        ->asArray()
                        ->all(), "id", "name");
                }

                echo $form->field($model, 'parent_id')->widget(Select2::class, [
                    'data' => $data,
                    'options' => [
                        'placeholder' => 'Parent',
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>


            </div>
        </div>
    </div>

    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-6"><?= $form->field($model, 'logo')->textInput(['maxlength' => true]) ?></div>
            <div class="col-xs-6"><?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?></div>
        </div>
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
