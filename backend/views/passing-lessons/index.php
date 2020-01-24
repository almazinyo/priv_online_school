<?php

use yii\helpers\Html;
use  backend\modules\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PassingLessonsControl */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Passing Lessons');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="passing-lessons-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'user_id',
            [
                'attribute' => 'lesson_id',
                'label' => Yii::t('app', 'Lessons'),
                'format' => 'text',
                'value' => function ($data) {
                    return $data['lesson']['name'];
                },
            ],
            [
                'attribute' => 'section_id',
                'label' => Yii::t('app', 'Sections'),
                'format' => 'text',
                'value' => function ($data) {
                    return $data['section']['name'];
                },
            ],
            'points',
            'created_at:datetime',
            'updated_at:datetime',
            [
                'attribute' => 'is_status',
                'format' => 'text',
                'value' => function ($data) {
                    return $data['is_status'] ? Yii::t('app', 'Active') : Yii::t('app', 'Inactive');
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
