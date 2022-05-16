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
                <a href="<?= base_url('team_members') ?>" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Team Members</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('projects') ?>" class="nav-link">
                    <i class="nav-icon fas fa-fire"></i>
                    <p>Projects</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('applications') ?>" class="nav-link">
                    <i class="nav-icon fas fa-dice-d6"></i>
                    <p>Applications</p>
                </a>
            </li>
            <li class="nav-header">Data Store</li>
            <li class="nav-item">
                <a href="../widgets.html" class="nav-link">
                    <i class="nav-icon fas fa-database"></i>
                    <p>Stores</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="../widgets.html" class="nav-link">
                    <i class="nav-icon fab fa-buffer"></i>
                    <p>Collections</p>
                </a>
            </li>
            <li class="nav-header">Auth Providers</li>
            <li class="nav-item">
                <a href="../widgets.html" class="nav-link">
                    <i class="nav-icon fab fa-github"></i>
                    <p>
                        Github
                        <span class="right badge badge-light">Soon</span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="../widgets.html" class="nav-link">
                    <i class="nav-icon fab fa-gitlab"></i>
                    <p>
                        Gitlab
                        <span class="right badge badge-light">Soon</span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="../widgets.html" class="nav-link">
                    <i class="nav-icon fab fa-dev"></i>
                    <p>
                        DEV.to
                        <span class="right badge badge-light">Soon</span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="../widgets.html" class="nav-link">
                    <i class="nav-icon fab fa-twitter"></i>
                    <p>
                        Twitter
                        <span class="right badge badge-light">Soon</span>
                    </p>
                </a>
            </li>
        </ul>
        <div class="sidebar-custom">
            <a href="javascript:;" class="btn btn-link"><i class="fas fa-cogs"></i></a>
            <a href="javascript:;" id="logoutButton" class="btn btn-default hide-on-collapse pos-right"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </nav>

</div>
