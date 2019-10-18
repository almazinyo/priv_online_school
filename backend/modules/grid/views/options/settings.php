<?php

use kartik\sortable\Sortable;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\bootstrap\Modal;

/**
 * @var yii\web\View $this
 * @var backend\modules\grid\models\GridSort $model
 * @var ActiveForm $form
 * @var boolean $allowPageSetting
 * @var boolean $allowThemeSetting
 * @var boolean $allowFilterSetting
 * @var boolean $allowSortSetting
 * @var array $allColumnNames
 * @var string $footer
 * @var \backend\modules\grid\models\FieldSettings $modelFieldSettings
 */


$cols = (int)$allowPageSetting + (int)$allowThemeSetting + (int)$allowFilterSetting + (int)$allowSortSetting;
$col = $cols == 0 ? 0 : 12 / $cols;


Modal::begin([
    'header' => '<h3 class="modal-title"><i class="glyphicon glyphicon-wrench"></i> ' .
        Yii::t('app', 'Personalize Grid Configuration') . '</h3>',
    'footer' => "<div class='pull-right'>{$footer} </div>",
    'toggleButton' => [
        'label' => '<i class="glyphicon glyphicon-wrench"></i> Settings',
        'title' => Yii::t('app', 'Personalize grid settings'),
        'data-pjax' => false,
        'class' => "btn btn-default",
        'id' => "grid-settings",

    ],
    'size' => Modal::SIZE_LARGE,
]);
?>
<script> var baseUrl = "<?= Yii::$app->homeUrl; ?>"</script>

<?php
$form = ActiveForm::begin([
    'options' => [
        'class' => "form-grid-sort",
        'id' => "grid-sort-form",
        'data-pjax' => false,
        'data-class-name' => $className
    ]
]); ?>
<div class="dynagrid-config-form">
    <?php if ($col != 0){ ?>
    <div class="row">
        <?php if ($allowPageSetting) { ?>
            <div class="col-sm-<?= $col ?>">
                <?= $form->field($model, 'page_size',
                    ['addon' => ['append' => ['content' => Yii::t('app', 'rows per page')]]])
                    ->textInput(['class' => 'form-control'])
                    ->hint(Yii::t('app', "Integer between 10 to 200")); ?>
            </div>
            <?php
        }
        if ($allowThemeSetting) { ?>
            <div class="col-sm-<?= $col ?>">
                <?= $form->field($model, 'theme')->widget(Select2::classname(), [
                    'data' => [
//                            'default' => 'simple-default',
//                            'bordered' => 'simple-bordered',
//                            'condensed' => 'simple-condensed',
//                            'striped' => 'simple-striped',
                        'default' => 'panel-default',
                        'primary' => 'panel-primary',
                        'info' => 'panel-info',
                        'danger' => 'panel-danger',
                        'success' => 'panel-success',
                        'warning' => 'panel-warning'
                    ],
                    'options' => ['placeholder' => Yii::t('app', 'Select a theme...')],
                    'pluginOptions' => ['allowClear' => true]
                ])->hint(Yii::t('app', 'Select theme to style grid')); ?>
            </div>
            <?php
        }
        }
        if
        ($allowFilterSetting) { ?>
            <div class="col-sm-<?= $col ?>">
                <?= $form->field($model, 'default_columns')->widget(Select2::classname(), [
                    'data' => $allColumnNames,
                    'options' => [
                        'value' => json_decode($model->default_columns),
                        'placeholder' => Yii::t('app', 'Select Default columns'),
                        'multiple' => true
                    ],
                    'pluginOptions' => ['allowClear' => true]
                ])->hint(Yii::t('app', 'Set default grid filter criteria')) ?>
            </div>
            <?php
        }
        ?>

    </div>

    <div class="dynagrid-column-label"><?= Yii::t('app',
            'Configure Order and Display of Grid Columns') ?></div>
    <div class="row">
        <div class="col-sm-5">
            <?php

            /**
             * add default value
             */
            array_unshift($hiddenAttributes, [
                "content" => "Hidden Columns",
                "disabled" => true,
                "options" => [
                    "class" => "alert alert-info dynagrid-sortable-header"
                ]
            ]);

            ?>
            <?= Sortable::widget([
                'items' => $hiddenAttributes,
                'connected' => true,
                'options' => ['class' => 'sortable-hidden ']
            ]);
            ?>
        </div>
        <div class="col-sm-2 text-center">
            <div class="dynagrid-sortable-separator"><i class="glyphicon glyphicon-resize-horizontal"></i></div>
        </div>
        <?php

        /**
         * add default value
         */
        array_unshift($visibleAttributes, [
            "content" => "Visible Columns",
            "disabled" => true,
            "options" => [
                "class" => "alert alert-info dynagrid-sortable-header"
            ]
        ]);
        ?>

        <div class="col-sm-5">
            <?= Sortable::widget([
                'items' => $visibleAttributes,
                'connected' => true,
                'options' => ['class' => 'sortable-visible']
            ]); ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
Modal::end();
echo $this->render("_field_settings",['modelFieldSettings'=>$modelFieldSettings])
?>
