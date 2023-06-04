<!DOCTYPE html>
<html>
<head>
    <title><?= APLICACAO_NOME ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= URL_CSS . 'bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?= URL_CSS . 'reset.min.css' ?>">
    <link rel="stylesheet" href="<?= URL_CSS . 'geral.css' ?>">
    <link rel="stylesheet" href="<?= URL_CSS . 'navbar.css' ?>">

    <script src="<?= URL_JS . 'jquery-3.1.1.min.js' ?>"></script>
    <script src="<?= URL_JS . 'bootstrap.min.js' ?>"></script>
    <script src="<?= URL_JS . 'navbar.js' ?>"></script>

    <script src="<?= URL_JS . 'cf6fa412bd.js'?>" crossorigin="anonymous"></script>

</head>
<body>

<?php $this->imprimirConteudo() ?>

</body>
</html>
