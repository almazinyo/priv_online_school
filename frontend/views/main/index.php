<?php
//require_once('layouts/header.php');

$homeUrl = Yii::$app->homeUrl;
?>


<div class="block-index-offer">
    <div class="row">

        <div class="col-lg-7">
            <div class="block-title">
                <b class="font-800 d-block">Прокачайся на 100!</b>
                Экзаматор - это онлайн<br>
                сервис для эффективной<br>
                подготовки к ЕГЭ
            </div>

            <p>
                Получи доступ к десяткам материалов для подготовки!<br>
                Общайся и учись у ведущих специалистов.
            </p>

            <a href="#" class="button button--acent_orange">Начать учиться</a>
        </div>

        <div class="col-lg-5 d-none sm-d-block">
            <div class="illustration-wrap pos-rel bg z-index-under text-right">
                <img src="#"
                     data-src="<?= $homeUrl ?>images/illustrations/1.svg" alt="" class="lazyload img z-index-over">
                <img src="#" data-src="<?= $homeUrl ?>images/illustrations/bg.svg" alt=""
                     class="lazyload bg z-index-under">
            </div>
        </div>

    </div>
</div>

<div class="devider"></div>

<div class="block-work-step tabs">
    <div class="row">

        <div class="col-12 block-title">
            Как проходит <span class="acent">обучение?</span>
            <p>
                Наш опыт говорит о том, что в обучении должны участвовать реальные люди, а не обезличенные
                тренажеры.<br>
                После каждого урока будет практическое задание, которое проверит и прокомментирует преподаватель.
            </p>
        </div>

        <div class="col-lg-8 col-xl-9">
            <div class="tab pos-rel is-visible">
                <div class="play-button y-pos-abs z-index-over">
                    <img src="#" data-src="<?= $homeUrl ?>images/icons/play-button.svg" alt="" class="svg-img pos-abs">
                </div>

                <img src="#" data-src="<?= $homeUrl ?>images/work_step/1.png" alt="" class="lazyload bg img-cover">

                <img src="#" data-src="<?= $homeUrl ?>images/man.png" alt="" class="lazyload man">
            </div>
            <div class="tab pos-rel">
                <div class="play-button y-pos-abs z-index-over">
                    <img src="#" data-src="<?= $homeUrl ?>images/icons/play-button.svg" alt="" class="svg-img pos-abs">
                </div>

                <img src="#" data-src="<?= $homeUrl ?>images/work_step/1.png" alt="" class="lazyload bg img-cover">

                <img src="#" data-src="<?= $homeUrl ?>images/man.png" alt="" class="lazyload man">
            </div>
            <div class="tab pos-rel">
                <div class="play-button y-pos-abs z-index-over">
                    <img src="#" data-src="<?= $homeUrl ?>images/icons/play-button.svg" alt="" class="svg-img pos-abs">
                </div>

                <img src="#" data-src="<?= $homeUrl ?>images/work_step/1.png" alt="" class="lazyload bg img-cover">

                <img src="#" data-src="<?= $homeUrl ?>images/man.png" alt="" class="lazyload man">
            </div>
            <div class="tab pos-rel">
                <div class="play-button y-pos-abs z-index-over">
                    <img src="#" data-src="<?= $homeUrl ?>images/icons/play-button.svg" alt="" class="svg-img pos-abs">
                </div>

                <img src="#" data-src="<?= $homeUrl ?>images/work_step/1.png" alt="" class="lazyload bg img-cover">

                <img src="#" data-src="<?= $homeUrl ?>images/man.png" alt="" class="lazyload man">
            </div>
        </div>
        <div class="col-lg-4 col-xl-3">
            <div class="row row--sm tabs-switchers font-800 cursor-pointer">
                <div class="col-6 col-lg-12">
                    <div class="tab-switcher is-active pos-rel">
                        <img src="#" data-src="<?= $homeUrl ?>images/icons/work-step/1.svg" alt=""
                             class="svg-img y-pos-abs">
                        Обучение
                    </div>
                </div>
                <div class="col-6 col-lg-12">
                    <div class="tab-switcher pos-rel">
                        <img src="#" data-src="<?= $homeUrl ?>images/icons/work-step/2.svg" alt=""
                             class="svg-img y-pos-abs">
                        Курсы
                    </div>
                </div>
                <div class="col-6 col-lg-12">
                    <div class="tab-switcher pos-rel">
                        <img src="#" data-src="<?= $homeUrl ?>images/icons/work-step/3.svg" alt=""
                             class="svg-img y-pos-abs">
                        Вебинары
                    </div>
                </div>
                <div class="col-6 col-lg-12">
                    <div class="tab-switcher pos-rel">
                        <img src="#" data-src="<?= $homeUrl ?>images/icons/work-step/4.svg" alt=""
                             class="svg-img y-pos-abs">
                        Тесты
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="devider"></div>

<div class="block-subjects">
    <div class="row row--sm">

        <div class="col-12 block-title">Выбери <span class="acent">нужный предмет</span></div>

        <div class="col-xs-6 col-md-4 col-lg-3">
            <a href="#"
               class="item item--math d-flex flex-row align-items-center md-flex-column md-align-items-start">
                <div class="item__icon pos-rel">
                    <img src="#" data-src="<?= $homeUrl ?>images/icons/main-menu/1.svg" alt="" class="svg-img pos-abs">
                </div>
                <div>
                    <div class="item__title">Математика</div>
                    <div class="item__thumb">56 курсов / 28 вебинаров</div>
                </div>
            </a>
        </div>
        <div class="col-xs-6 col-md-4 col-lg-3">
            <a href="#"
               class="item item--physics d-flex flex-row align-items-center md-flex-column md-align-items-start">
                <div class="item__icon pos-rel">
                    <img src="#" data-src="<?= $homeUrl ?>images/icons/main-menu/2.svg" alt="" class="svg-img pos-abs">
                </div>
                <div>
                    <div class="item__title">Физика</div>
                    <div class="item__thumb">56 курсов / 28 вебинаров</div>
                </div>
            </a>
        </div>
        <div class="col-xs-6 col-md-4 col-lg-3">
            <a href="#"
               class="item item--russian d-flex flex-row align-items-center md-flex-column md-align-items-start">
                <div class="item__icon pos-rel">
                    <img src="#" data-src="<?= $homeUrl ?>images/icons/main-menu/3.svg" alt="" class="svg-img pos-abs">
                </div>
                <div>
                    <div class="item__title">Русский язык</div>
                    <div class="item__thumb">56 курсов / 28 вебинаров</div>
                </div>
            </a>
        </div>
        <div class="col-xs-6 col-md-4 col-lg-3">
            <a href="#"
               class="item item--social d-flex flex-row align-items-center md-flex-column md-align-items-start">
                <div class="item__icon pos-rel">
                    <img src="#" data-src="<?= $homeUrl ?>images/icons/main-menu/4.svg" alt="" class="svg-img pos-abs">
                </div>
                <div>
                    <div class="item__title">Обществознание</div>
                    <div class="item__thumb">56 курсов / 28 вебинаров</div>
                </div>
            </a>
        </div>
        <div class="col-xs-6 col-md-4 col-lg-3">
            <a href="#"
               class="item item--history d-flex flex-row align-items-center md-flex-column md-align-items-start">
                <div class="item__icon pos-rel">
                    <img src="#" data-src="<?= $homeUrl ?>images/icons/main-menu/5.svg" alt="" class="svg-img pos-abs">
                </div>
                <div>
                    <div class="item__title">История</div>
                    <div class="item__thumb">56 курсов / 28 вебинаров</div>
                </div>
            </a>
        </div>
        <div class="col-xs-6 col-md-4 col-lg-3">
            <a href="#"
               class="item item--chemistry d-flex flex-row align-items-center md-flex-column md-align-items-start">
                <div class="item__icon pos-rel">
                    <img src="#" data-src="<?= $homeUrl ?>images/icons/main-menu/6.svg" alt="" class="svg-img pos-abs">
                </div>
                <div>
                    <div class="item__title">Химия</div>
                    <div class="item__thumb">56 курсов / 28 вебинаров</div>
                </div>
            </a>
        </div>
        <div class="col-xs-6 col-md-4 col-lg-3">
            <a href="#"
               class="item item--biology d-flex flex-row align-items-center md-flex-column md-align-items-start">
                <div class="item__icon pos-rel">
                    <img src="#" data-src="<?= $homeUrl ?>images/icons/main-menu/7.svg" alt="" class="svg-img pos-abs">
                </div>
                <div>
                    <div class="item__title">Биология</div>
                    <div class="item__thumb">56 курсов / 28 вебинаров</div>
                </div>
            </a>
        </div>
        <div class="col-xs-6 col-md-4 col-lg-3">
            <a href="#"
               class="item item--pack d-flex flex-row align-items-center md-flex-column md-align-items-start">
                <div class="item__icon pos-rel">
                    <img src="#" data-src="<?= $homeUrl ?>images/icons/main-menu/pack.svg" alt=""
                         class="svg-img pos-abs">
                </div>
                <div>
                    <div class="item__title">Наборы курсов</div>
                    <div class="item__thumb">8 комплексных крсов</div>
                </div>
            </a>
        </div>

    </div>
</div>

<div class="devider"></div>

<div class="block-reviews">
    <div class="block-title d-flex align-items-center justify-content-between">
        <div>Отзывы <span class="acent">о курсах</span></div>

        <a href="#" class="button button--border_bg button--color-acent">Все отзывы</a>
    </div>

    <div class="owl-carousel">
        <div class="item">
            <div class="item-header pos-rel">
                <img src="#" data-src="<?= $homeUrl ?>images/users/1.svg" alt="" class="lazyload img">
                <div class="name">Максим Мироненко</div>
                <div class="thumb">Курс Математики / Оценка <b class="font-800">5</b></div>
            </div>
            <p>
                Курс отличный, очень полезный. Я считаю, что обязателен для всех, кто хочет развиваться в этой
                сфере. Сложен для понимаю, почти каждый вебинар пересматривал, бывало, и не один раз. Отдельная
                благодарность преподавателю Сергею!
            </p>
        </div>
        <div class="item">
            <div class="item-header pos-rel">
                <img src="#" data-src="<?= $homeUrl ?>images/users/2.svg" alt="" class="lazyload img">
                <div class="name">Александр Баль</div>
                <div class="thumb">Курс Математики / Оценка <b class="font-800">5</b></div>
            </div>
            <p>
                Курс отличный - ничего лишнего - методички совпадают с излагаемым материалом - преподаватель
                старается разжевать на первый взгляд непростые темы, очень все достойно, - наконец то ушли от клик
                митинга - зум рулит.
            </p>
        </div>
        <div class="item">
            <div class="item-header pos-rel">
                <img src="#" data-src="<?= $homeUrl ?>images/users/2.svg" alt="" class="lazyload img">
                <div class="name">Александр Баль</div>
                <div class="thumb">Курс Математики / Оценка <b class="font-800">5</b></div>
            </div>
            <p>
                Курс отличный - ничего лишнего - методички совпадают с излагаемым материалом - преподаватель
                старается разжевать на первый взгляд непростые темы, очень все достойно, - наконец то ушли от клик
                митинга - зум рулит.
            </p>
        </div>
        <div class="item">
            <div class="item-header pos-rel">
                <img src="#" data-src="<?= $homeUrl ?>images/users/2.svg" alt="" class="lazyload img">
                <div class="name">Александр Баль</div>
                <div class="thumb">Курс Математики / Оценка <b class="font-800">5</b></div>
            </div>
            <p>
                Курс отличный - ничего лишнего - методички совпадают с излагаемым материалом - преподаватель
                старается разжевать на первый взгляд непростые темы, очень все достойно, - наконец то ушли от клик
                митинга - зум рулит.
            </p>
        </div>
    </div>
</div>

<?= Yii::$app->view->render('/partials/have_questions', ['homeUrl' => $homeUrl]) ?>

