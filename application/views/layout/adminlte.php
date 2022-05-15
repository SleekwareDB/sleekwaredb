<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <?= adminlte('all.min.css') ?>
    <?= adminlte('adminlte.min.css') ?>
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
            <?php $this->load->view('layout/components/sidebar') ?>
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


    <script src="<?= adminlte('jquery.min.js', true) ?>"></script>
    <script src="<?= adminlte('bootstrap.bundle.min.js', true) ?>"></script>
    <script src="<?= adminlte('adminlte.min.js', true) ?>"></script>
    <script src="<?= adminlte('demo.js', true) ?>"></script>
    <script src="<?= adminlte('sweetalert2.all.min.js', true) ?>"></script>
    <script>
        let base_url = function(pathUri) {
            return window.location.protocol + '//' + window.location.hostname + '/' + ((pathUri) ? pathUri.replace(/^\/|\/$/g, '') : '');
        }

        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
    </script>
    <script src="<?= base_url('assets/js/app.js') ?>"></script>
</body>

</html>
