<?php

use yii\helpers\Html;
use  backend\modules\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\QuizControl */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Quizzes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quiz-index">
    <?php Pjax::begin();

    $attributeLesson =
        [
            'attribute' => 'lessons_id',
            'label' => Yii::t('app', 'Lessons'),
            'filter' => \common\models\Lessons::receiveTitles(),
            'filterType' => GridView::FILTER_SELECT2,
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => [
                'placeholder' =>
                    Yii::t('app', 'Lesson'),
                'multiple' => false,
            ],
            'value' => function ($data) {
                return $data['lessons']['name'];
            },
        ];
    $attributeSubjects =
        [
            'attribute' => 'subject_id',
            'label' => Yii::t('app', 'Subject'),
            'filter' => \common\models\Subjects::receiveTitles(),
            'filterType' => GridView::FILTER_SELECT2,
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => [
                'placeholder' =>
                    Yii::t('app', 'Subject'),
                'multiple' => false,
            ],
            'value' => function ($data) {
                return $data['subjects']['title'];
            },
        ];
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            $attributeLesson,
            $attributeSubjects,
            'bonus_points',
            'correct_answer',
            [
                'attribute' => 'question',
                'format' => 'html',
                'value' => function ($data) {
                    return
                        Html::img(
                            sprintf("http://%s/images/question/%s", $_SERVER['HTTP_HOST'], $data['question']),
                            ['width' => '200']
                        );
                },
            ],
            [
                'attribute' => 'hint',
                'format' => 'html',
                'value' => function ($data) {
                    return
                        Html::img(
                            sprintf("http://%s/images/question/hint/%s", $_SERVER['HTTP_HOST'], $data['hint']),
                            ['width' => '300']
                        );
                },
            ],
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
    ]); ?>

    <?php Pjax::end(); ?>
</div>
