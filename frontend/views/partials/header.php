<header class="layout-header d-flex">
    <div class="container">
        <div class="row">
            <a href="<?= $homeUrl ?>" class="logo pos-rel z-index-over d-flex align-items-center justify-content-end">
                <img src="#" data-src="<?= $homeUrl ?>images/logo.svg" alt="logo" class="lazyload">
                <span class="bg z-index-under"></span>
            </a>

            <div class="content d-flex justify-content-between align-items-center">
                <img src="#" data-src="<?= $homeUrl ?>images/logo-text.svg" alt=""
                     class="lazyload logo-text d-none xl-d-block">

                <div class="d-flex">
                    <a href="#" class="button button--acent_orange d-inline-flex lg-d-none js-open"
                       data-open-block=".main-menu" data-html-hidden="1">
                        <img src="#" data-src="<?= $homeUrl ?>images/icons/menu.svg" alt="" class="lazyload">
                        <span>Меню</span>
                    </a>

                    <div class="subject pos-rel z-index-over lg-d-none xxl-d-block">
                        <a href="#" class="button button--acent">
                            <img src="#" data-src="<?= $homeUrl ?>images/icons/menu.svg" alt="" class="lazyload">
                            <span>Предметы</span>
                        </a>

                        <div class="subject-list font-600 z-index-under">
                            <a href="/math.php">Математика</a>
                            <a href="/physics.php">Физика</a>
                            <a href="/russian.php">Русский</a>
                            <a href="/social.php">Общество</a>
                            <a href="/history.php">История</a>
                            <a href="/chemistry.php">Химия</a>
                            <a href="/biology.php">Биология</a>
                        </div>
                    </div>
                </div>

                <nav class="d-none lg-d-block">
                    <a href="<?= $homeUrl?>" class="acent font-600">Выбрать бесплатный урок</a>
                    <a href="<?= $homeUrl ?>how-it-works">Как это работает?</a>
                    <a href="<?= $homeUrl ?>reviews">Отзывы</a>
                    <a href="<?= $homeUrl ?>blog">Блог</a>
                </nav>

                <div class="profile d-flex align-items-center">
                    <div class="avatar">
                        <img src="#" data-src="<?= $homeUrl ?>images/user/1.png" alt="" class="lazyload img-cover">
                    </div>
                    <div class="level d-none md-d-block">
                        <img src="#" data-src="<?= $homeUrl ?>images/icons/profile-flash.svg" alt="" class="lazyload">
                        3 уровень
                    </div>
                    <div class="points font-600 d-none md-d-block">822 балла</div>
                </div>
            </div>

        </div>
    </div>
</header>

<div id="main-content" class="d-flex d-none">

    <div class="container">
        <div class="row" style="height: 100%;">

            <div class="main-menu d-flex flex-column align-items-center lg-align-items-end text-center pos-rel z-index-over">
                <svg class="js-close d-block lg-d-none" data-close-block=".main-menu" xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 241.171 241.171" width="512" height="512">
                    <path d="M138.138 120.754l99.118-98.576a11.931 11.931 0 0 0 0-17.011c-4.74-4.704-12.439-4.704-17.179 0l-99.033 98.492-99.949-99.96c-4.74-4.752-12.439-4.752-17.179 0-4.74 4.764-4.74 12.475 0 17.227l99.876 99.888L3.555 220.497c-4.74 4.704-4.74 12.319 0 17.011 4.74 4.704 12.439 4.704 17.179 0l100.152-99.599 99.551 99.563c4.74 4.752 12.439 4.752 17.179 0 4.74-4.764 4.74-12.475 0-17.227l-99.478-99.491z"
                          data-original="#000000" class="active-path" data-old_color="#000000" fill="#FFF"/>
                </svg>

                <div class="bg z-index-under"></div>

                <a href="/math.php" class="item">
                    <span class="img icon-font icon-menu-map"></span>
                    <span class="text">Математика</span>
                </a>
                <a href="/physics.php" class="item">
                    <span class="img icon-font icon-menu-physics"></span>
                    <span class="text">Физика</span>
                </a>
                <a href="/russian.php" class="item">
                    <span class="img icon-font icon-menu-russian"></span>
                    <span class="text">Русский</span>
                </a>
                <a href="/social.php" class="item">
                    <span class="img icon-font icon-menu-social"></span>
                    <span class="text">Общество</span>
                </a>
                <a href="/history.php" class="item">
                    <span class="img icon-font icon-menu-history"></span>
                    <span class="text">История</span>
                </a>
                <a href="/chemistry.php" class="item">
                    <span class="img icon-font icon-menu-checmistry"></span>
                    <span class="text">Химия</span>
                </a>
                <a href="/biology.php" class="item">
                    <span class="img icon-font icon-menu-biology"></span>
                    <span class="text">Биология</span>
                </a>
                <a href="/biology.php" class="item is-curent">
                    <span class="img icon-font font-800">56%</span>
                    <span class="text">Биология</span>
                </a>
            </div>

            <div class="content-wrap">