<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillHub - Quem Somos</title>

    <?php include_once('link.php') ?>
    <style>
        body{
            background: linear-gradient(180deg, rgba(253,126,20,1) 0%, rgba(255,255,255,1) 100%);
            min-height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            max-width: 1200px;
            width: 100%;
            padding: 20px;
        }
        .card {
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1); /* Adiciona sombra ao card */
        }
    </style>
</head>
<body>

    <div class="container mt-4">
        <div class="text-center">
            <div class="card p-5">
                <div class="row">
                    <div class="col-6">
                        <img src="img/quemsomos.png" alt="" style="width: 100%;">
                        <b class="text-justify">
                            Integrantes: Guilherme Guimas, Kaique Rodrigues, Kauê Martins, Marco Aurelio, Sobhia Y e Vinícius Salvador
                        </b>
                    </div>
                    <div class="col-6">
                        <h1 style="font-weight: bolder;color:black;">Quem somos?</h1>
                        <br>
                        <div class="row">
                            <div class="col-8 offset-2">
                                <p class="text-justify">
                                    Bem-vindo à nossa plataforma de aprendizado digital! Somos um grupo de estudantes de Análise e Desenvolvimento de Sistemas do Centro Universitário Fundação Santo André, e nossa missão é democratizar o acesso ao conhecimento tecnológico. Criamos esta plataforma para ajudar quem nunca teve contato com computadores a desenvolver habilidades digitais básicas, essenciais para o dia a dia, visando uma educação acessível e prática.
                                </p>
                                <p class="text-justify">
                                    Nosso trabalho é inspirado nas Metas de Desenvolvimento Sustentável (ODS) 4 e 9, que promovem a educação inclusiva e a inovação. Acreditamos que a inclusão digital é fundamental para o desenvolvimento individual e comunitário, e estamos aqui para tornar esse processo mais acessível. Seja bem-vindo à nossa jornada de aprendizado e descubra as oportunidades que a tecnologia pode oferecer!    
                                </p>
                                <p style="font-weight: bolder;">Para acessar o sistema você precisa primeiramente se registrar ou logar no nosso sistema, clique no botão abaixo</p>
                                <?php if($_SESSION['logado']){ ?>
                                        <a href="portal" class="btn btn-orange">Voltar</a>
                                    <?php }else{ ?> 
                                        <a href="login" class="btn btn-orange">LOGAR</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

</body>
</html>
