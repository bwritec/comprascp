<!DOCTYPE html>
<html lang="pt-br">
<head>

    <!--
      - Charset.
     -->
    <meta charset="utf-8">

    <!--
      - Viewport.
     -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--
      - Título.
     -->
    <title><?= esc(env('app.name')) ?> - <?= esc($title) ?></title>

    <!--
      - Favicon.
     -->
    <link rel="shortcut icon" type="image/png" href="<?= base_url() ?>favicon.ico">

    <!--
      - Estilos
     -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>dist/css/bootstrap-5.3.7.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>dist/css/fontawesome-7.0.0.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>dist/css/style.css">

</head>
<body class="clearfix">

    <div class="navbar-mobile mb-3">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <button class="btn bars">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </div>

                <div class="col-6 navbar-logo">
                    <a href="<?= base_url() ?>index.php" class="text-dark">
                        <img src="<?= base_url() ?>dist/img/logo.png">

                        <span class="text">
                            <?= esc(env('app.name')) ?>
                        </span>
                    </a>
                </div>

                <div class="col-3">
                    <button class="btn btn-search" style="float: right;">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="sidebar-mobile">
        <div class="box">
            <div class="sidebar-logo">
                <a href="<?= base_url() ?>index.php" class="text-dark">
                    <img src="<?= base_url() ?>dist/img/logo.png">

                    <span class="text">
                        <?= esc(env('app.name')) ?>
                    </span>
                </a>
            </div>

            <div class="informar-cep">
                <span class="btn">
                    <div class="box">
                        <div class="icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>

                        <div class="message">
                            <span class="text">
                                informe seu
                            </span>

                            <span class="word">
                                CEP
                            </span>
                        </div>
                    </div>
                </span>
            </div>

            <div class="cats">
                <div class="dropdown categories">
                    <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categorias
                    </button>

                    <ul class="dropdown-menu">
                        <?php foreach ($global_categories as $cat): ?>
                            <?php if (isset($cat['children'])): ?>
                                <li class="dropdown-submenu position-relative">
                                    <a class="dropdown-item dropdown-toggle" href="<?= site_url('categorie/' . $cat['id']) ?>">
                                        <?= esc($cat['name']) ?>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <?php foreach ($cat['children'] as $child): ?>
                                            <li>
                                                <a class="dropdown-item" href="<?= site_url('categorie/' . $child['id']) ?>">
                                                    <?= esc($child['name']) ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                            <?php else: ?>
                                <li>
                                    <a class="dropdown-item" href="<?= site_url('categorie/' . $cat['id']) ?>">
                                        <?= esc($cat['name']) ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <div class="menu">
                <ul class="actions">
                    <?php if (session()->has('user')): ?>
                        <div class="dropdown">
                            <?php
                                $fullName = session('user.name');
                                $firstName = explode(' ', trim($fullName))[0];
                            ?>
                            <a class="btn btn-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none; color: #000000;">
                                <?= esc($firstName) ?>
                            </a>

                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="<?= base_url() ?>index.php/dashboard">
                                        Dashboard
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="<?= site_url('logout') ?>">
                                        Sair
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <li class="list">
                            <a href="<?= base_url() ?>index.php/register">
                                Criar Conta
                            </a>
                        </li>

                        <li class="list">
                            <a href="<?= base_url() ?>index.php/login">
                                Entre
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <div class="close">
            <button class="btn btn-sm">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>

    <div class="search-mobile">
        <div class="close">
            <button class="btn btn-dark btn-search-close">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <div class="card" style="width: calc(100% - 30px)">
            <div class="card-body">
                <div class="search">
                    <form action="<?= base_url() ?>index.php/search" method="GET">
                        <input type="text" name="q" class="form-control" placeholder="Buscar produtos, marcas e muito mais...">

                        <button class="btn">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="navbar mb-3">
        <div class="container">
            <div class="row">
                <div class="col-6 offset-3 offset-md-0 col-md-3 col-lg-2 navbar-logo">
                    <a href="<?= base_url() ?>index.php" class="text-dark">
                        <img src="<?= base_url() ?>dist/img/logo.png">

                        <span class="text">
                            <?= esc(env('app.name')) ?>
                        </span>
                    </a>
                </div>

                <div class="col-12 col-md-6 navbar-search">
                    <form action="<?= base_url() ?>index.php/search" method="GET">
                        <input type="text" name="q" class="form-control" placeholder="Buscar produtos, marcas e muito mais...">

                        <button class="btn">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="container-fluid container-md">
            <div class="row">
                <div class="col-12 col-md-3 col-lg-2 informar-cep">
                    <span class="btn">
                        <div class="box">
                            <div class="icon">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>

                            <div class="message">
                                <span class="text">
                                    informe seu
                                </span>

                                <span class="word">
                                    CEP
                                </span>
                            </div>
                        </div>
                    </span>
                </div>

                <div class="col-12 col-md-9 col-lg-10">
                    <div class="dropdown categories">
                        <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categorias
                        </button>

                        <ul class="dropdown-menu">
                            <?php foreach ($global_categories as $cat): ?>
                                <?php if (isset($cat['children'])): ?>
                                    <li class="dropdown-submenu position-relative">
                                        <a class="dropdown-item dropdown-toggle" href="<?= site_url('categorie/' . $cat['id']) ?>">
                                            <?= esc($cat['name']) ?>
                                        </a>

                                        <ul class="dropdown-menu">
                                            <?php foreach ($cat['children'] as $child): ?>
                                                <li>
                                                    <a class="dropdown-item" href="<?= site_url('categorie/' . $child['id']) ?>">
                                                        <?= esc($child['name']) ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php else: ?>
                                    <li>
                                        <a class="dropdown-item" href="<?= site_url('categorie/' . $cat['id']) ?>">
                                            <?= esc($cat['name']) ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <ul class="actions">
                        <?php if (session()->has('user')): ?>
                            <div class="dropdown">
                                <?php
                                    $fullName = session('user.name');
                                    $firstName = explode(' ', trim($fullName))[0];
                                ?>
                                <a class="btn btn-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none; color: #000000;">
                                    <?= esc($firstName) ?>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="<?= base_url() ?>index.php/dashboard">
                                            Dashboard
                                        </a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item" href="<?= site_url('logout') ?>">
                                            Sair
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        <?php else: ?>
                            <li class="list">
                                <a href="<?= base_url() ?>index.php/register">
                                    Criar Conta
                                </a>
                            </li>

                            <li class="list">
                                <a href="<?= base_url() ?>index.php/login">
                                    Entre
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="informar-cep-box">
        <div class="card" style="">
            <div class="card-body">

                <h2>
                    Selecione onde quer receber suas compras
                </h2>

                <p>
                    Você poderá ver custos e prazos de entrega
                    precisos em tudo que procurar.
                </p>


                <form action="" method="" class="clearfix">
                    <label>
                        CEP
                    </label>

                    <input type="text" name="cep" class="form-control" placeholder="Informar um CEP">

                    <button class="btn btn-primary">
                        Aplicar
                    </button>
                </form>

                <a href="#">
                    Não sei o meu CEP.
                </a>

            </div>

            <div class="card-footer">
                <button class="btn btn-sm btn-primary button-close">
                    Fechar
                </button>
            </div>
        </div>
    </div>

    <?= $this->renderSection('content') ?>

    <footer class="footer" id="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p>
                        &copy; <?= date('Y') ?> - <?= esc(env('app.name')) ?>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!--
      - Scripts.
     -->
    <script type="text/javascript" src="<?= base_url() ?>dist/js/bootstrap.bundle-5.3.7.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>dist/js/jquery-3.7.1.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>dist/js/footer-fix.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>dist/js/script.js"></script>

    <!--
      - Outros scripts.
     -->
    <script type="text/javascript">
        $(function()
        {
            $('#site-footer').smartFooter();
        });
    </script>

</body>
</html>
