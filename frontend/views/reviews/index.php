<?php

$homeUrl = Yii::$app->homeUrl;
?>


<div class="block-reviews block-reviews--in">
    <?= Yii::$app->view->render('/partials/breadcrumbs'); ?>

    <div class="block-title">Отзывы студентов</div>

    <div class="row">

        <?php for($i = 0; $i < 6; $i++): ?>
            <div class="col-xl-6">
                <div class="item">
                    <div class="item-header pos-rel">
                        <img data-src="<?= $homeUrl?>images/users/2.svg" alt="" class="lazyload img">
                        <div class="name">Александр Баль</div>
                        <div class="thumb">Курс Математики / Оценка <b class="font-800">5</b></div>
                    </div>
                    <p>
                        Курс отличный - ничего лишнего - методички совпадают с излагаемым материалом - преподаватель старается разжевать на первый взгляд непростые темы, очень все достойно, - наконец то ушли от клик митинга - зум рулит.
                    </p>
                </div>
            </div>
        <?php endfor; ?>

    </div>

    <div class="pagination d-flex justify-content-between align-items-center">
        <div class="nums">
            <a href="#" class="is-active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <a href="#">5</a>
            <a href="#">6</a>
        </div>
        <a href="#" class="button button--acent_orange">Далее</a>
    </div>
</div>

<div class="devider devider--sm"></div>


<?= Yii::$app->view->render('/partials/have_questions', ['homeUrl' => $homeUrl]); ?>
