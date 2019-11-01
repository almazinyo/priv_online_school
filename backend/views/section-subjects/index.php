<?php

use yii\helpers\Html;
use backend\modules\grid\GridView;
use yii\widgets\Pjax;
use \common\models\Subjects;
use  \yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SectionSubjectsControl */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sections');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subjects-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'slug',
            [
                'attribute' => 'subject_id',
                'filter' => Subjects::receiveTitles(),
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => Yii::t('app', 'Subjects'), 'multiple' => false],
                'format' => 'raw',
                'value' => function ($model) {
                    return Subjects::findOne(['id' => $model->subject_id])->title;
                },
            ],
            'short_description',
            'description:html',
            'seo_keywords',
            'seo_description',
            'created_at:datetime',
            'updated_at:datetime',
            'is_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'isValidActionColumn' => false,
        'bordered' => true,
        'pjax' => true,
        'responsive' => true,
        'hover' => true,
    ]); ?>

    <?php Pjax::end(); ?>

</div>
