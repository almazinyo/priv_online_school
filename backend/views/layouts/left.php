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
                    [
                        'label' => Yii::t('app', 'Users Access'),
                        'icon' => 'fa fa-key',
                        'url' => ['#'],
                        'items' => [
                            [
                                'label' => Yii::t('app', 'Users'),
                                'icon' => '',
                                'url' => ['/user/'],
                                'active' => Yii::$app->controller->id == 'route',
                            ],
                            [
                                'label' => Yii::t('app', 'Route'),
                                'icon' => '',
                                'url' => ['/admin/route/'],
                                'active' => Yii::$app->controller->id == 'route',
                            ],
                            [
                                'label' => Yii::t('app', 'Assignment'),
                                'icon' => '',
                                'url' => ['/admin/assignment/'],
                                'active' => Yii::$app->controller->id == 'assignment',
                            ],
                            [
                                'label' => Yii::t('app', 'Permission'),
                                'icon' => '',
                                'url' => ['/admin/permission/'],
                                'active' => Yii::$app->controller->id == 'permission',
                            ],
                            [
                                'label' => Yii::t('app', 'Role'),
                                'icon' => '',
                                'url' => ['/admin/role/'],
                                'active' => Yii::$app->controller->id == 'role',
                            ],
                        ],
                    ],
                    ['label' => Yii::t('app', 'Blog'), 'icon' => 'fa fa-clipboard', 'url' => ['/blog']],
                    [
                        'label' => Yii::t('app', 'Subjects'),
                        'icon' => 'fa fa-key',
                        'items' =>
                            [
                                ['label' => Yii::t('app', 'Subject'), 'icon' => '', 'url' => ['/subjects']],
                            ],
                    ],
                    [
                        'label' => Yii::t('app', 'Sections'),
                        'icon' => 'fa fa-key',
                        'url' => ['/section-subjects'],

                        'items' =>
                            [
                                [
                                    'label' => Yii::t('app', 'Section'),
                                    'icon' => '',
                                    'url' => ['/section-subjects'],
                                ],

                                [
                                    'label' => Yii::t('app', 'Sub Sections'),
                                    'icon' => '',
                                    'url' => ['/section-subjects/sub-sections'],
                                ],
                                [
                                    'label' => Yii::t('app', 'Teachers'),
                                    'icon' => '',
                                    'url' => ['/teachers'],
                                ],
                            ],
                    ],

                    [
                        'label' => Yii::t('app', 'Lessons'),
                        'icon' => 'fa fa-key',
                        'items' => [
                            [
                                'label' => Yii::t('app', 'Lessons'),
                                'icon' => '',
                                'url' => ['/lessons'],
                            ],
                            [
                                'label' => Yii::t('app', 'Quiz'),
                                'icon' => '',
                                'url' => ['/quiz'],
                            ],
                            [
                                'label' => Yii::t('app', 'Storage'),
                                'icon' => '',
                                'url' => ['/storage-lessons'],
                            ],
                        ],
                    ],

                    ['label' => Yii::t('app', 'Promotional Code'), 'icon' => '', 'url' => ['/promotional-code']],
                    [
                        'label' => Yii::t('app', 'Settings'),
                        'icon' => 'fa fa-key',
                        'url' => ['#'],
                        'items' => [
                            [
                                'label' => Yii::t('app', 'Options'),
                                'icon' => '',
                                'url' => ['/options'],
                                'active' => Yii::$app->controller->id == 'route',
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>
</aside>
