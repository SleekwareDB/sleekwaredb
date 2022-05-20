<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?> - <?= app_config('applicationName') ?></title>
    <link rel="shortcut icon" href="<?= base_url('assets/img/SWDB-PP.png') ?>" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <?= node_modules('all.min.css') ?>
    <?= node_modules('dataTables.bootstrap4.min.css') ?>
    <?= node_modules('responsive.bootstrap4.min.css') ?>
    <?= node_modules('buttons.bootstrap4.min.css') ?>
    <?= node_modules('toastr.min.css') ?>
    <?= node_modules('adminlte.min.css') ?>
    <?= link_tag('node_modules/jsoneditor/dist/jsoneditor.min.css') ?>
    <link rel="stylesheet" href="" id="darkjsoneditor">
    <style>
        .sidebar-custom {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
        }
    </style>
</head>

<body class="sidebar-mini layout-fixed sidebar-mini-md sidebar-mini-xs layout-footer-fixed text-sm">

    <div class="wrapper">

        <?php $this->load->view('layout/components/navbar') ?>

        <aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
            <?php if ($this->uri->segment(1) == 'settings') : ?>
                <?php $this->load->view('layout/components/sidebar-config') ?>
            <?php else : ?>
                <?php $this->load->view('layout/components/sidebar') ?>
            <?php endif; ?>
        </aside>

        <div class="content-wrapper">

            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">&nbsp;</div>
                        <div class="col-sm-6">
                            <?= breadcrumb($breadcrumb) ?>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <?php $this->load->view($content) ?>
            </section>

        </div>

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>

        <aside class="control-sidebar control-sidebar-dark"></aside>

    </div>

    <script src="<?= base_url('assets/js/bundle.min.js') ?>"></script>
</body>

</html>
