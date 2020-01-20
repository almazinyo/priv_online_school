<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;
use common\models\Lessons;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\file\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Quiz */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="quiz-form">

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
        <div class="row">
            <div class="col-xs-6">
                <?= $form->field($model, 'lessons_id')->widget(
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
            <div class="col-xs-6">
                <?= $form->field($model, 'subject_id')->widget(
                    Select2::classname(), [
                    'data' =>
                        ArrayHelper::map(
                            \common\models\Subjects::find()
                                ->select('id,title')
                                ->asArray()
                                ->all(),
                            "id", "title"),
                    'options' => ['placeholder' => 'Parent'],
                    'pluginOptions' => ['allowClear' => true],
                ])
                ;
                ?>
            </div>
        </div>
    </div>

    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-6">
                <?= $form->field($model, 'bonus_points')->textInput() ?>
            </div>
            <div class="col-xs-6">
                <?= $form->field($model, 'correct_answer')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </div>

    <div class="col-xs-12">
        <?php

        $modelId = $model->id;
        $uploadImagesUrl = Url::to(['/quiz/upload-question?id=' . $modelId]);

        $imagesOptions = [];
        $imgPath = [];

        if (!$model->isNewRecord) {
            $imgName = $model->question;
            $imgFullPath = Yii::getAlias("@frontend") . "/web/images/question/" . $imgName;

            if (!empty($imgName)) {
                $deleteUrl = \yii\helpers\Url::to(["/quiz/delete-question?id=" . $modelId]);

                $imgPath[] = Url::to('http://' . $_SERVER['HTTP_HOST'] . '/images/question/') . $imgName;
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
        $form->field($model, 'question')
            ->widget(
                FileInput::class,
                [
                    'attribute' => 'question',
                    'name' => 'question',
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

    <div class="col-xs-12">
        <?php

        $modelId = $model->id;
        $uploadImagesUrl = Url::to(['/quiz/upload-hint?id=' . $modelId]);

        $imagesOptions = [];
        $imgPath = [];

        if (!$model->isNewRecord) {
            $imgName = $model->hint;
            $imgFullPath = Yii::getAlias("@frontend") . "/web/images/question/hint/" . $imgName;

            if (!empty($imgName)) {
                $deleteUrl = \yii\helpers\Url::to(["/quiz/delete-hint?id=" . $modelId]);

                $imgPath[] = Url::to('http://' . $_SERVER['HTTP_HOST'] . '/images/question/hint/') . $imgName;
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
        $form->field($model, 'hint')
            ->widget(
                FileInput::class,
                [
                    'attribute' => 'hint',
                    'name' => 'hint',
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
