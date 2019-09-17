<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= Yii::$app->homeUrl ?>images/users/man.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity['username'] ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>


        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => Yii::t('app', 'Menu'), 'icon' => '', 'url' => ['/menu']],
                    ['label' => Yii::t('app', 'Blog'), 'icon' => '', 'url' => ['/blog']],
                    [
                        'label' => Yii::t('app', 'Subjects'),
                        'items' =>
                            [
                                ['label' => Yii::t('app', 'Subjects'), 'icon' => '', 'url' => ['/subjects']],
                                [
                                    'label' => Yii::t('app', 'Section'),
                                    'icon' => '',
                                    'url' => ['/section-subjects'],

                                    'items' => [
                                        [
                                            'label' => Yii::t('app', 'Section'),
                                            'icon' => '',
                                            'url' => ['/section-subjects'],
                                        ],
                                        ['label' => Yii::t('app', 'Lessons'), 'icon' => '', 'url' => ['/lessons']],
                                        ['label' => Yii::t('app', 'Teachers'), 'icon' => '', 'url' => ['/teachers']],
                                    ],
                                ],
                            ],
                    ],
                    ['label' => Yii::t('app', 'Promotional Code'), 'icon' => '', 'url' => ['/promotional-code']],
                ],
            ]
        ) ?>

    </section>
</aside>
