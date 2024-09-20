<?php 
    include_once('class/classes.php');

    Helper::logado();

    $Cursos = new Curso();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillHub - Ínicio</title>

    <?php include_once('link.php') ?>
    <style>
        .card-title {
            font-family: "Inconsolata", monospace;
        }
        body {
            font-family: "Open Sans", sans-serif;
        }
        .card {
            height: 350px; /* Altura fixa para os cards */
            width: 100%; /* Largura total da coluna */
            border-radius: 15px;
            position: relative; /* Necessário para o posicionamento do botão */
        }
        .card-img-top {
            height: 150px; /* Altura fixa para a imagem */
            width: 100%; /* Largura total do card */
            object-fit: cover; /* Garante que a imagem seja cortada corretamente */
            border-radius: 15px;
        }
        .btn-acessar {
            position: absolute; /* Posição absoluta em relação ao card */
            bottom: 20px; /* Ajuste a altura a partir da parte inferior */
            left: 50%;
            transform: translateX(-50%); /* Centraliza o botão */
        }
    </style>
</head>
<body>

    <?php include_once('navbar.php'); ?>

    <div class="container mt-4">
        <div class="row">
            <h2 style="font-weight: bolder;">Cursos</h2>
            <hr>
            <?php foreach($Cursos->listar() as $curso) { ?>
      
            <div class="col-3 mb-5">
                <a href="curso?id=<?php echo $curso->id_curso ?>" style="text-decoration: none;">
                    <div class="card curso w-100 p-3">
                        <img src="<?php echo $curso->imagem ?>" class="card-img-top" alt="">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo $curso->nome ?></h5>
                            <button class="btn btn-orange btn-acessar">Acessar</button>
                        </div>
                    </div>
                </a>
            </div>
            <?php }; ?>
        </div>
    </div>
    
</body>
</html>
