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
    <style>
        .jumbotron {
            background-color: #149f92 !important;
            color: white;
        }
    </style>
</head>

<body>

    <?php if ($this->uri->segment(1) != 'install') : ?>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="<?= base_url('assets/img/logo-with-no-bg.png') ?>" width="145" height="30" class="d-inline-block align-top" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">📖 Docs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">🐙 Github</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    <?php endif; ?>

    <?php $this->load->view($content) ?>

    <script src="<?= base_url('assets/js/bundle.min.js') ?>"></script>
</body>

</html>
