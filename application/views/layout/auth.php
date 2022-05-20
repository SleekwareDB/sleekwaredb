<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <?= node_modules('bootstrap.min.css') ?>

    <title><?= $title ?></title>
    <meta name="description" content="SleekwareDB is a NoSQL database storage service. A database storage service that can be used for various platforms and is easy to integrate.">
    <link rel="shortcut icon" href="<?= base_url('assets/img/SWDB-PP.png') ?>" type="image/png">

</head>

<body class="d-flex align-items-center justify-content-center bg-dark text-light" style="height: 100vh;">

    <?php $this->load->view($content); ?>

    <script src="<?= base_url('assets/js/bundle.min.js') ?>"></script>

</body>

</html>
