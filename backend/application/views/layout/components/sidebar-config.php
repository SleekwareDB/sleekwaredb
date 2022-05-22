<a href="../../index3.html" class="brand-link text-sm">
    <img src="<?= base_url('assets/img/SWDB-PP.png') ?>" alt="<?= APP_NAME ?> Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light"><?= APP_NAME ?></span>
</a>

<div class="sidebar">

    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="<?= adminlte('user2-160x160.jpg', true) ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block"><?= get_session('fullname') ?></a>
        </div>
    </div>

    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="<?= base_url('dashboard') ?>" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('settings/account') ?>" class="nav-link <?= sidebar_active('settings') ?>">
                    <i class="nav-icon fas fa-user"></i>
                    <p>Account</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('settings/app') ?>" class="nav-link <?= sidebar_active('settings') ?>">
                    <i class="nav-icon fas fa-cogs"></i>
                    <p>Configuration</p>
                </a>
            </li>
        </ul>
        <div class="sidebar-custom">
            <a href="javascript:;" class="btn btn-link"><i class="fas fa-cogs"></i></a>
            <a href="javascript:;" id="logoutButton" class="btn btn-default hide-on-collapse pos-right"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </nav>

</div>
