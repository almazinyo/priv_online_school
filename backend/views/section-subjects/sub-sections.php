<?php

use yii\helpers\Html;
use backend\modules\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SectionSubjectsControl */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sub Sections');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subjects-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [
            'before' => Html::a(
                sprintf(
                    '%s %s  %s',
                    "<i class='glyphicon glyphicon-plus'></i>",
                    Yii::t('app', 'Create'),
                    Yii::t('app', $this->title)
                ),
                ['create-sub-section'],
                ['class' => 'btn btn-success']
            ),
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'slug',
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
