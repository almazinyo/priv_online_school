<?php

use yii\helpers\Html;
use  backend\modules\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderListControl */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Order Lists');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-list-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'user_id',
                'label' => Yii::t('app', 'Users'),
                'format' => 'text',
                'value' => function ($data) {
                    return
                        sprintf(
                            "%s %s",
                            $data['user']['profiles']['first_name'],
                            $data['user']['profiles']['last_name']
                        );
                },
            ],
//            'subjects_id',
            'section_id',
            'name',
            //'email:email',
            'price',
            'sender',
            'operation_label',
            'operation_id',
            'datetime',
            'notification_type',
            'is_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
