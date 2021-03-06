<?php

use yii\helpers\Html;
use  backend\modules\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\SubjectsControl */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Subjects');
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
            'title',
            'sortable_id',
            'slug',
            'short_description',
            'description:html',
            //'seo_keywords',
            //'seo_description',
            'created_at:datetime',
            'updated_at:datetime',
            'is_status',

            ['class' => 'yii\grid\ActionColumn',

                'template'=>'{duplicate}  {view} {update} {delete}',

                'buttons'=>[

                    'duplicate' => function ($url, $model) {

                        return Html::a('<span  class="fa fa-files-o" aria-hidden="true""></span>', $url, [

                            'title' => Yii::t('app', 'Duplicate'),

                        ]);

                    }

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
