<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SectionSubjects */

$this->title = Yii::t('app', 'Update Section: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Section'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="subjects-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php

    $pathForm = '_form';

    if ($model->parent_id !=0){
        $pathForm = '_form-sub-section';
    }

    ?>

    <?= $this->render($pathForm, [
        'model' => $model,
    ]) ?>

</div>
