<?php

use common\models\SectionSubjects;
use kartik\file\FileInput;
use kartik\select2\Select2;
use kartik\switchinput\SwitchInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\redactor\widgets\Redactor;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Teachers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teachers-form">

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
            <div class="col-xs-6"><?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?></div>
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


    <div class="col-xs-12">
        <?php

        $modelId = $model->id;
        $uploadImagesUrl = Url::to(['/blog/upload-images?id=' . $modelId]);

        $imagesOptions = [];
        $imgPath = [];

        if (!$model->isNewRecord) {
            $imgName = $model->img_name;
            $imgFullPath = Yii::getAlias("@frontend") . "/web/images/teachers/" . $imgName;

            if (!empty($imgName)) {
                $deleteUrl = Url::to(["/blog/delete-file?id=" . $modelId]);

                $imgPath[] = Url::to('http://' . $_SERVER['HTTP_HOST'] . '/images/teachers/') . $imgName;
                $size = 0;
                if (file_exists($imgFullPath)) {
                    $size = filesize($imgFullPath);
                }
                $imagesOptions[] = [
//                'caption' => $model->title,
                    'url' => $deleteUrl,
                    'size' => $size,
                    'key' => $modelId,
                ];
            }
        }
        ?>

        <?=
        $form->field($model, 'img_name')
            ->widget(
                FileInput::class,
                [
                    'attribute' => 'img_name',
                    'name' => 'img_name',
                    'options' =>
                        [
                            'accept' => 'image/*',
                            'multiple' => false,
                        ],
                    'pluginOptions' =>
                        [
                            'previewFileType' => 'image',
                            "uploadAsync" => true,
                            'showPreview' => true,
                            'showUpload' => $model->isNewRecord ? false : true,
                            'showCaption' => false,
                            'showDrag' => false,
                            'uploadUrl' => $uploadImagesUrl,
                            'initialPreviewConfig' => $imagesOptions,
                            'initialPreview' => $imgPath,
                            'initialPreviewAsData' => true,
                            'initialPreviewShowDelete' => true,
                            'overwriteInitial' => true,
                            'resizeImages' => true,
                            'layoutTemplates' => [!$model->isNewRecord ?: 'actionUpload' => '',],
                        ],
                ])
        ;
        ?>

    </div>

    <?= $form->field($model, 'img_name')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
