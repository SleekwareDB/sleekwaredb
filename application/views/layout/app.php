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
    <style>
        .jumbotron {
            background-color: #149f92 !important;
            color: white;
        }
    </style>
</head>

<body>
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

    <?php $this->load->view($content) ?>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>
    <script>
        let baseUrl = function(pathUri) {
            return window.location.protocol + '//' + window.location.hostname + '/' + ((pathUri) ? pathUri : '');
        }
    </script>
    <script src="<?= base_url('assets/js/app.js') ?>"></script>
</body>

</html>
