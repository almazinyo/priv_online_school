<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\file\FileInput;
use yii\helpers\Url;
use common\models\Lessons;
use common\models\StorageLessons;

/* @var $this yii\web\View */
/* @var $model common\models\StorageLessons */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="storage-lessons-form">

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
                            'onText' => Yii::t('app', 'Active'),
                            'offText' => Yii::t('app', 'Inactive'),
                        ],
                ]
            )
        ;
        ?>
    </div>

    <div class="col-xs-12">
        <?= $form->field($model, 'lesson_id')->widget(
            Select2::classname(), [
            'data' =>
                ArrayHelper::map(
                    Lessons::find()
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
        <?php

        $model_id = $model->id;
        $uploadImages = Url::to(['/products/upload-images?id=' . $model_id]);
        $imagesOptions = [];
        $imgPath = [];
        $size = 0;

        if (!$model->isNewRecord) {
            $imgFullPath = Yii::getAlias("@frontend") . "/web/images/lessons/";

            foreach (StorageLessons::receiveFileName($model->lesson_id) as $fileId => $fileName) {
                var_dump($fileId);
                $deleteUrl = Url::to(["/products/delete-file?id=" . $fileId]);

                if (file_exists($imgFullPath . $fileName)) {
                    $size = filesize($imgFullPath . $fileName);
                    $imgPath[] = Url::to('/frontend/web/images/lessons/' . $fileName);
                }
                $imagesOptions[] = [
                    //  'caption' => $model->title,
                    'url' => $deleteUrl,
                    'size' => $size,
                    'key' => $model_id,

                ];
            }
        }

        ?>
        <?= $form->field($model, 'name[]')->widget(FileInput::class, [
            'attribute' => 'name[]',
            'name' => 'name[]',
            'options' =>
                [
                    'accept' => '*',
                    'multiple' => true,
                ],
            'pluginOptions' =>
                [
                    'previewFileType' => 'image',
                    "uploadAsync" => true,
                    'showPreview' => true,
                    'showUpload' => $model->isNewRecord ? false : true,
                    'showCaption' => false,
                    'showDrag' => false,
                    'uploadUrl' => $uploadImages,
                    'initialPreviewConfig' => $imagesOptions,
                    'initialPreview' => $imgPath,
                    'initialPreviewAsData' => true,
                    'initialPreviewShowDelete' => true,
                    'overwriteInitial' => $model->isNewRecord ? true : false,
                    'resizeImages' => true,
                    'layoutTemplates' => [
                        !$model->isNewRecord ?: 'actionUpload' => '',
                    ],
                ],
        ])
        ; ?>
    </div>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
