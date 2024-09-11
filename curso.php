<?php 
    include_once('class/classes.php');

    $Cursos = new Curso();
    $Aulas = new Aula();
    $Quizzes = new Quiz();
    $Perguntas = new Pergunta();
    $Respostas = new Resposta();

    if(isset($_POST['btnEnviar'])){
        $Quizzes->calcularNota($_POST);
    }

    $curso = $Cursos->mostrar($_GET['id']);
    $quiz = $Quizzes->mostrar($curso->id_curso);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillHub - Ínicio</title>

    <?php include_once('link.php') ?>

    <style>
        .custom-radio .form-check-input {
            position: absolute;
            opacity: 0;
        }

        .custom-radio .form-check-label::before {
            content: attr(data-letter);
            display: inline-block;
            width: 1.5em;
            height: 1.5em;
            line-height: 1.5em;
            text-align: center;
            border: 2px solid #0d6efd;
            border-radius: 50%;
            margin-right: 0.5em;
            font-weight: bold;
            color: #0d6efd;
            vertical-align: middle;
        }

        .custom-radio .form-check-input:checked + .form-check-label::before {
            background-color: #0d6efd;
            color: white;
        }
    </style>
</head>
<body>

    <?php 
        include_once('navbar.php');
    ?>

<div class="container mt-4">
        <a href="portal" class="btn btn-secondary mb-2">Voltar</a>
        <div class="p-4">
            <h3>Introdução ao Uso de Computadores</h3>
            <br>
            <?php echo $curso->descricao ?>
            <br>
            <div class="row">
                <div class="row">

                    <?php
                        foreach($Aulas->listar() as $aula){
                            $n_aula = 1;
                    ?>
                    <div class="row mb-4">
                        <div class="col-3">
                            <!-- Botão que abre o modal -->
                            <a href="#" style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#videoModal" data-link="<?php echo $aula->link ?>">
                                <h5 class="text-center">Aula <?php echo $n_aula ?></h5>
                                <div class="card curso p-3" style="width: 18rem; margin: 0 auto;">
                                    <img src="img/miniatura1.png" class="card-img-top">
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php 
                            $n_aula++;
                        }
                    ?>

                    <div class="col-6 offset-3 mt-3">
                        <a href="" style="text-decoration: none;" id="abrirQuiz" data-bs-toggle="modal" data-bs-target="#quizModal">
                            <h5 class="text-center">Quiz do Curso</h5>
                            <div class="card curso p-3" style="width: 18rem; margin: 0 auto;">
                                <img src="quiz.jpg" class="card-img-top" alt="">
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="videoModalLabel">Aula 1 - Introdução ao Uso de Computadores</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Player de vídeo local -->
                <div class="ratio ratio-16x9">
                    <iframe width="560" height="315" id="aulaVideo" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade fs-6" id="quizModal" tabindex="-1" aria-labelledby="quizModalLabel" aria-hidden="true">
    <form action="?" method="post">
        <div class="modal-dialog modal-xl">
            <div class="modal-content p-4">
                <div class="modal-header">
                    <h5 class="modal-title" id="quizModalLabel">Questionário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <input type="hidden" name="id_curso" value="<?php echo $curso->id_curso ?>">
                <input type="hidden" name="id_quiz" value="<?php echo $quiz->id_quiz ?>">
                <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id_usuario'] ?>">
                <div class="modal-body">
                    <?php 
                        $n_questao = 1;
                        $n_resposta = 1;
                        $letras = ['A', 'B', 'C', 'D']; // Letras para as respostas
                        foreach($Perguntas->listar($quiz->id_quiz) as $pergunta){
                    ?>
                        <div class="mb-3">
                            <label class="form-label fw-bolder">Questão <?php echo "$n_questao : $pergunta->pergunta" ?></label>
                            <?php 
                                foreach($Respostas->listar($pergunta->id_pergunta) as $index => $resposta){ 
                            ?>
                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao<?php echo $n_questao; ?>" id="resposta<?php echo $n_resposta ?>" value="<?php echo $resposta->id_resposta ?>" required>
                                    <label class="form-check-label" for="resposta<?php echo $n_resposta ?>" data-letter="<?php echo $letras[$index]; ?>">
                                        <?php echo $resposta->resposta ?>
                                    </label>
                                </div>
                            <?php 
                                    $n_resposta++;
                                } 
                            ?>
                        </div>
                    <?php 
                            $n_questao++;
                        }
                    ?>
                    
                </div>
                <div class="modal-footer mt-2">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" name="btnEnviar" class="btn btn-success">Enviar</button>
                </div>
            </div>
        </div>
    </form>
</div>


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        // Função para obter o valor de um parâmetro da URL
        function getParameterByName(name) {
            const url = new URL(window.location.href);
            const params = new URLSearchParams(url.search);
            return params.get(name);
        }

        // Verificar se a 'nota' está presente na URL
        const nota = getParameterByName('nota');
        if (nota) {
            // Exibir o alerta com a nota
            alert('Parabéns! Sua nota no quiz foi ' + nota + '/10');

            // Remover a 'nota' da URL
            const url = new URL(window.location.href);
            url.searchParams.delete('nota');
            window.history.replaceState(null, null, url); // Atualiza a URL sem recarregar a página
        }
    });
</script>


    
    <!-- Scripts do Bootstrap (necessário para o funcionamento do modal) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb7m00IVIyjDZHn2gFp51RoShbZp6NAM0CfaQrZy0pP4pEP8s" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuQ7g5p1QolTMZZ5RdYUV02pAqO95nMNylVvC82bg4l7o1EDvF4Np5dAJ9HgEyjE" crossorigin="anonymous"></script>
</body>
</html>
