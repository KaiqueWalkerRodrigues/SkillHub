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
                    <div class="col-5">
                        <img src="img/quemsomos.png" alt="" style="width: 100%;">
                    </div>
                    <div class="col-7">
                        <h1 style="font-weight: bolder;color:black;">Quem somos?</h1>
                        <br>
                        <div class="row">
                            <div class="col-8 offset-2">
                                <p class="text-justify">
                                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facilis numquam sed commodi dignissimos possimus perferendis saepe, distinctio sint eveniet laboriosam in? Corporis, aliquam est in pariatur enim dolor tempora culpa.
                                </p>
                                
                                <p style="font-weight: bolder;">Para acessar o sistema você precisa primeiramente se registrar ou logar no nosso sistema, clique no botão abaixo</p>
                                <a href="login" class="btn btn-orange">LOGAR</a>
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
