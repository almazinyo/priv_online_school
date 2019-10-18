<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\modules\grid\models\GridSort */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="container">
    <div class="row">
        <?php

        $className = $model->class_name;
        $obj = new $className();
        /**
         * Return all the keys of an array
         */
        $thisColumnNames = array_keys($obj->search(Yii::$app->request->queryParams)->getModels()[0]->attributes);

        /**
         * Creates an array by using one array for keys and another for its value
         */
        $thisColumnNames = array_combine($thisColumnNames, $thisColumnNames);

        ?>
        <?php $form = ActiveForm::begin(); ?>
        <div class="col-xs-12">
            <div class="col-xs-6">
                <?= $form->field($model, 'visible_columns')->widget(Select2::classname(), [
                    'data' => $thisColumnNames,
                    'options' => [
                        'value' => json_decode($model->sort),
                        'placeholder' => 'Select Columns',
                        'multiple' => true
                    ]
                ]);
                ?>
            </div>
            <div class="col-xs-6">
                <?= $form->field($model, 'default_columns')->widget(Select2::classname(), [
                    'data' => $thisColumnNames,
                    'options' => [
                        'value' => json_decode($model->default_columns),
                        'placeholder' => 'Select Default Columns',
                        'multiple' => true
                    ]
                ]);
                ?>
            </div>
        </div>

        <div class="col-xs-12">
            <div class="col-xs-6">
                <?= $form->field($model, 'label')->textInput(); ?>
            </div>
            <div class="col-xs-6">
                <?= $form->field($model, 'page_size')->dropDownList([
                    30,
                    50,
                    100
                ],
                    [
                        'prompt' => "PageSize",
                    ]); ?>
            </div>

        </div>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
