<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=\yii\helpers\Url::home()?>" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Admin</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">

          <?php
          echo \hail812\adminlte3\widgets\Menu::widget([
              'items' => [
                ['label' => 'UAT BPJS V2.0', 'header' => true],
                [
                  'label' => 'VCLAIM',
                  'icon' => 'tachometer-alt',
                  'iconClassAdded' => 'text-info',
                  'items' => [
                      ['label' => 'Cari Peserta', 'url' => ['bpjs2/caripeserta'], 'iconStyle' => 'far'],
                      ['label' => 'Pembuatan SEP','url' => ['bpjs2/create_sep'], 'iconStyle' => 'far'],
                  ]
                ],

                ['label' => '--- RS ---', 'header' => true],
                [
                  'label' => 'CEKUP',
                  'icon' => 'tachometer-alt',
                  'iconClassAdded' => 'text-info',
                  'items' => [
                      ['label' => 'Insert Peserta', 'url' => ['cekup/form-insert'], 'iconStyle' => 'far'],
                      // ['label' => 'Pembuatan SEP', 'iconStyle' => 'far'],
                  ]
                ],


                // ['label' => 'Yii2 PROVIDED', 'header' => true],
                // ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                // ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank'],
                // ['label' => 'MULTI LEVEL EXAMPLE', 'header' => true],
                // ['label' => 'Level1'],
                // [
                //   'label' => 'Level1',
                //   'items' => [
                //     ['label' => 'Level2', 'iconStyle' => 'far'],
                //     [
                //       'label' => 'Level2',
                //       'iconStyle' => 'far',
                //       'items' => [
                //         ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                //         ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                //         ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle']
                //       ]
                //     ],
                //   ]
                // ],
                // ['label' => 'Level1'],
                // ['label' => 'LABELS', 'header' => true],
                // ['label' => 'Important', 'iconStyle' => 'far', 'iconClassAdded' => 'text-danger'],
                // ['label' => 'Warning', 'iconClass' => 'nav-icon far fa-circle text-warning'],
                // ['label' => 'Informational', 'iconStyle' => 'far', 'iconClassAdded' => 'text-info'],
              ],
          ]);
          ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>