<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\PromotionalCode */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="promotional-code-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-xs-12">
        <?= $form->field($model, 'is_status')
            ->widget(
                \kartik\switchinput\SwitchInput::classname(),
                [
                    'value' => true,
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
        <div class="row">
            <div class="col-xs-3">
                <?= $form->field($model, 'percent')->textInput() ?>
            </div>
            <div class="col-xs-9">
                <?= $form->field($model, 'user_id')->widget(
                    Select2::classname(), [
                    'data' =>
                        ArrayHelper::map(
                            \common\models\Profile::find()
                                ->select('user_id, first_name, last_name')
                                ->asArray()
                                ->all(),
                            "user_id", "first_name", 'last_name'),
                    'options' => ['placeholder' => 'Parent'],
                    'pluginOptions' => ['allowClear' => true],
                ])
                ;
                ?>            </div>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
