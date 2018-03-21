<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>名字：</p>

                <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
            </div>
        </div>

        <!-- search form -->

        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => '管理列表', 'options' => ['class' => 'header']],

                    [
                        'label' => '商品分类管理',
                        'icon' => 'shopping-cart',
                        'url' => '#',
                        'items' => [
                            ['label' => '商品分类列表', 'icon' => 'dashboard', 'url' => ['/goods-class/index'],],
                            ['label' => '商品分类添加', 'icon' => 'file-code-o', 'url' => ['/goods-class/insert'],],

                        ],
                    ],


                    [
                        'label' => '品牌管理',
                        'icon' => 'shopping-bag',
                        'url' => '#',
                        'items' => [
                            ['label' => '品牌列表', 'icon' => 'dashboard', 'url' => ['/brand/index'],],
                            ['label' => '品牌添加', 'icon' => 'file-code-o', 'url' => ['/brand/insert'],],

                        ],
                    ],

                    [
                        'label' => '商品管理',
                        'icon' => 'shopping-basket',
                        'url' => '#',
                        'items' => [
                            ['label' => '商品列表', 'icon' => 'dashboard', 'url' => ['/goods/index'],],
                            ['label' => '商品添加', 'icon' => 'file-code-o', 'url' => ['/goods/insert'],],

                        ],
                    ],

                    [
                        'label' => '文章分类管理',
                        'icon' => 'book',
                        'url' => '/article-class/index',
                        'items' => [
                            ['label' => '文章分类列表', 'icon' => 'dashboard', 'url' => ['/article-class/index'],],
                            ['label' => '文章分类添加', 'icon' => 'file-code-o', 'url' => ['/article-class/insert'],],

                        ],
                    ],

                    [
                        'label' => '文章管理',
                        'icon' => 'sticky-note-o',
                        'url' => '/article/index',
                        'items' => [
                            ['label' => '文章列表', 'icon' => 'dashboard', 'url' => ['/article/index'],],
                            ['label' => '文章添加', 'icon' => 'file-code-o', 'url' => ['/article/insert'],],

                        ],
                    ],


//                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
//                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
//                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],

                ],
            ]
        ) ?>

    </section>

</aside>
