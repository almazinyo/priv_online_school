<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use  yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Options */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="options-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->input(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>


    <div class="col-xs-12">
        <?php

        $modelId = $model->id;
        $uploadImagesUrl = Url::to(['/options/upload-images?id=' . $modelId]);

        $imagesOptions = [];
        $imgPath = [];

        if (!$model->isNewRecord) {
            $imgName = $model->img_name;
            $imgFullPath = Yii::getAlias("@frontend") . "/web/images/options/" . $imgName;

            if (!empty($imgName)) {
                $deleteUrl = Url::to(["/options/delete-file?id=" . $modelId]);

                $imgPath[] = Url::to('http://' . $_SERVER['HTTP_HOST'] . '/images/options/') . $imgName;
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
                \kartik\file\FileInput::class,
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


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
