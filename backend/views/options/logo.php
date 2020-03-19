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

    <div class="col-xs-12">
        <?php

        $modelId = $model->id;
        $uploadImagesUrl = Url::to(['/options/upload-images?id=' . $modelId]);

        $imagesOptions = [];
        $imgPath = [];

            $imgName = 'logo-text.svg';
            $imgFullPath = Yii::getAlias("@frontend") . "/web/images/logo-text.svg";

            if (!empty($imgName)) {
                $imgPath[] = Url::to('http://' . $_SERVER['HTTP_HOST'] . '/images/options/') . $imgName;
                $size = 0;
                if (file_exists($imgFullPath)) {
                    $size = filesize($imgFullPath);
                }

                $imagesOptions[] = [
                    'size' => $size,
                    'key' => $modelId,
                ];
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
                            'layoutTemplates' => [
                                 'actionUpload' => '',
                                'actionDelete' => '',
                                ],
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
