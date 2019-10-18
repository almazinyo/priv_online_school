<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var \backend\modules\grid\models\FieldSettings $modelFieldSettings
 */
?>
<div class="modal fade " id='field_settings' tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" id="title-field-settings">Setting </h4>
            </div>
            <div class='modal-body' style='height: 20em'>
                <?php $form = ActiveForm::begin([
                    'id' => "field-settings-form"
                ]) ?>

                <div class="col-xs-12">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#basic">Basic</a></li>
                        <li><a data-toggle="tab" href="#advanced">Advanced</a></li>
                    </ul>
                </div>
                <br> <br>
                <div class="tab-content">
                    <div id="basic" class="tab-pane fade in active">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-6">
                                    <?= $form->field($modelFieldSettings, "label")->textInput() ?>
                                </div>
                                <div class="col-xs-6">
                                    <?= $form->field($modelFieldSettings, "width_column")->textInput() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="advanced" class="tab-pane fade ">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-6">
                                    <?= $form->field($modelFieldSettings, 'search')->dropDownList([
                                         '\kartik\select2\Select2' => 'Select',
                                        '\kartik\date\DatePicker' => 'Date Picker',
                                        '\kartik\datetime\DateTimePicker' => 'Date Time Picker'
                                    ],[
                                            'prompt'=>"Default"
                                    ]); ?>
                                </div>
                                <div class="col-xs-6">
                                    <?= $form->field($modelFieldSettings, 'format')->dropDownList([
                                        'text' => 'Text',
                                        'raw' => 'Raw',
                                        'html' => 'HTML',
                                        'decimal' => 'Decimal',
                                        'time' => 'Time',
                                        'date' => 'Date',
                                        'datetime' => 'Datetime',
                                        'relativeTime' => 'Relative Time',
                                    ],[
                                        'prompt'=>"Default"
                                    ]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php $form::end(); ?>
            </div>

            <div class="modal-footer">
                <div class="pull-right">
                    <a href="#" data-dismiss="modal" class="btn">Close</a>
                    <a href="#" class="btn btn-success" id="save-filed-settings">Save</a>
                </div>
            </div>
        </div>
    </div>
</div>
