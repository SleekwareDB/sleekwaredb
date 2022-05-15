<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <title><?= $title ?></title>
    <meta name="description" content="SleekwareDB is a NoSQL database storage service. A database storage service that can be used for various platforms and is easy to integrate.">
    <link rel="shortcut icon" href="<?= base_url('assets/img/logo-with-no-bg.png') ?>" type="image/png">

</head>

<body class="d-flex align-items-center justify-content-center" style="height: 100vh;">

    <?php $this->load->view($content); ?>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>
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
