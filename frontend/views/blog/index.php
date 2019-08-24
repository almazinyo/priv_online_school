<?php

$homeUrl = Yii::$app->homeUrl;
?>

<?= Yii::$app->view->render('/partials/breadcrumbs'); ?>

<div class="block-blog">
    <div class="block-title">Блог. Интересное. Важное.</div>
    <div class="row">
        <?php for ($i = 0; $i < 4; $i++): ?>
            <div class="col-xl-6">
                <a href="<?= $homeUrl ?>blog/detail" class="blog-item d-flex flex-column">
					<span class="img">
						<img src="#" data-src="<?= $homeUrl ?>images/blog/1.jpg" alt="" class="lazyload img-cover"/>
					</span>
                    <span class="title font-600">Сверхпроводимость муаровой сверхрешетки из графена оказалась настраиваемой</span>
                    <span class="d-flex align-items-center justify-content-between">
						<span class="date d-flex align-items-center">
							<i class="icon-font icon-arrow-right"></i>
							14 октября 2019
						</span>
						<span class="subject font-600 font-uppercase">Физика</span>
					</span>
                </a>
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
