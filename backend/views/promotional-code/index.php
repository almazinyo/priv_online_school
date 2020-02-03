<?php

use yii\helpers\Html;
use  backend\modules\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PromotionalCodeControl */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Promotional Codes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promotional-code-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'key',
            'percent',
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
            'created_at:datetime',
            'updated_at:datetime',
            'is_status',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',            ],
        ],
    ]); ?>


</div>
