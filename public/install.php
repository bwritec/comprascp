<?php

    /**
     * Caminho do .env (ajuste se necessário)
     */
    $envPath = dirname(__DIR__) . '/.env';

    /**
     * Se não existir .env, redireciona para install.php
     */
    if (file_exists($envPath))
    {
        header('Location: index.php');
        exit;
    }

?>
<!DOCTYPE html>
<html>
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
    <title>Kwrite Installer</title>

    <!--
      - Estilos.
     -->
    <link rel="stylesheet" type="text/css" href="dist/css/bootstrap-5.3.7.css">

    <!--
      - Scripts.
     -->
    <script type="text/javascript" src="dist/js/bootstrap.bundle-5.3.7.js"></script>

</head>
<body>

    <div style="text-align: center;" class="mt-5 mb-3">
        <img src="dist/img/logo.png" style="width: 75px; height: 75px;">
    </div>

    <?php if (array_key_exists("step", $_GET)): ?>
        <?php if ($_GET["step"] == "1"): ?>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-8 offset-md-2">
                        <div class="card">
                            <div class="card-body">
                                <form action="/install.php?step=1" method="POST">
                                    Passo 1
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger">
                            Passo Desconhecido
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-body">
                            <p>
                                Boas-vindas ao Kwrite. Antes de iniciar, você
                                precisará conhecer os seguintes itens.
                            </p>

                            <ol>
                                <li>Informações do banco de dados</li>
                                <li>Informações do servidor smtp</li>
                                <li>Informações da app</li>
                                <li>Informações de tokens de serviços</li>
                            </ol>

                            <p>
                                Esta informação está sendo usada para criar um arquivo
                                <strong>.env</strong>. Se por algum motivo a criação
                                automática deste arquivo não funcionar, não se preocupe.
                                Tudo que isto faz é preencher as informações do banco de
                                dados, smtp, app e token's de serviços em um arquivo de
                                configuração. Você também pode simplesmente abrir
                                .env.sample em um editor de texto, preencher suas
                                informações e salvar como <strong>.env</strong>
                            </p>

                            <p>
                                Provavelmente esses itens foram fornecidos a você pela
                                sua hospedagem. Se não tiver essa informação, então
                                precisará entrar em contato com eles antes de continuar.
                                Se estiver pronto…
                            </p>

                            <a href="/install.php?step=1" class="btn btn-outline-primary">
                                Vamos lá!
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

</body>
</html>
