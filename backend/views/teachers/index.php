<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TeachersControl */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Teachers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teachers-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Teachers'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'subject_id',
            'social_link',
            'work_experience',
            //'img_name',
            //'small_img_path',
            //'large_img_path',
            //'slug',
            //'description:ntext',
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
