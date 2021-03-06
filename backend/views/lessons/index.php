<?php

use yii\helpers\Html;
use backend\modules\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use common\models\SectionSubjects;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LessonsControl */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Lessons');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lessons-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php Pjax::begin(); ?>
    <?php

    $attributeSections =
        [
            'attribute' => 'section_id',
            'filter' => SectionSubjects::receiveTitles(),
            'filterType' => GridView::FILTER_SELECT2,
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => [
                'placeholder' =>
                    Yii::t('app', 'Sections'),
                'multiple' => false,
            ],
            'value' => function ($model) {
                return SectionSubjects::findOne(['id' => $model->section_id])->name;
            },
        ];

    ?>

    <?= GridView::widget(
        [
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' =>
                [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'sort_lessons',
                    'name',
                    $attributeSections,
                    'background',
                    'logo',
                    'slug',
//                    'short_description:html',
//                    'description:html',
                    'seo_keywords',
                    'seo_description',
                    'created_at:datetime',
                    'updated_at:datetime',
                    [
                        'attribute' => 'is_status',
                        'format' => 'text',
                        'value' => function ($data) {
                            return $data['is_status'] ? Yii::t('app', 'Active') : Yii::t('app', 'Inactive');
                        },
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{duplicate}  {view} {update} {delete}',
                        'buttons' =>
                            [
                                'duplicate' => function ($url, $model) {
                                    return Html::a('<span  class="fa fa-files-o" aria-hidden="true""></span>', $url, [
                                        'title' => Yii::t('app', 'Duplicate'),
                                    ]);
                                },
                            ],
                    ],
                ],
            'isValidActionColumn' => false,
            'bordered' => true,
            'pjax' => true,
            'responsive' => true,
            'hover' => true,
        ]
    ); ?>

    <?php Pjax::end(); ?>

</div>
