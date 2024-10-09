<?php 
    include_once('class/classes.php');

    Helper::logado();

    $Cursos = new Curso();
    $Quizzes = new Quiz();
    $Perguntas = new Pergunta();
    $Respostas = new Resposta();

    if(isset($_POST['btnEnviar'])){
        $Quizzes->calcularNota($_POST);
    }

    $curso = $Cursos->mostrar($_GET['id']);
    $quiz = $Quizzes->mostrar($curso->id_curso);
    $usuarioQuiz = $Quizzes->mostrarUsuarioQuiz($quiz->id_quiz, $_SESSION['id_usuario']);

    // Verifica se o quiz do usuário existe e se o gabarito está definido
    if ($usuarioQuiz && isset($usuarioQuiz->gabarito)) {
        $gabarito = explode(",", $usuarioQuiz->gabarito);
    }
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

        .resposta-correta {
            color: green;
            font-weight: bold;
        }

        .resposta-errada {
            color: red;
            font-weight: bold;
        }
        .custom-carousel-control {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 50px;
            height: 50px;
            background-color: #333; /* Fundo cinza escuro */
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            z-index: 1000;
        }

        .carousel-control-prev.custom-carousel-control {
            left: -80px; /* Posiciona mais para fora do slide */
        }

        .carousel-control-next.custom-carousel-control {
            right: -80px; /* Posiciona mais para fora do slide */
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
            <h3><?php echo $curso->nome ?></h3>
            <br>
            <?php echo $curso->descricao ?>
            <br>
            <div class="row">
                <div class="row">

                    <div class="row mb-4">
                        <div class="col-12 text-center">
                            <!-- Botão que abre o modal -->
                            <a href="#" style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#videoModal">
                                <h5 class="text-center">Aula</h5>
                                <div class="card curso p-3" style="width: 18rem; margin: 0 auto;">
                                    <img src="img/aula.png" class="card-img-top">
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-6 offset-3 mt-3">
                        <div class="row">
                            <div class="<?php if(isset($gabarito)){ echo 'col-6'; }else{ echo 'col-12 '; } ?>">
                                <a href="#" style="text-decoration: none;" id="abrirQuiz" data-bs-toggle="modal" data-bs-target="#quizModal">
                                    <h5 class="text-center">Quiz do Curso</h5>
                                    <div class="card curso p-3" style="width: 18rem; margin: 0 auto;">
                                        <img src="https://img.freepik.com/free-vector/speech-bubble-with-interrogation-sign-talking_24877-84070.jpg?t=st=1726667639~exp=1726671239~hmac=c2e14b1cfa970713154dac5b642d30cd83ff9195ab9cb8dd57344ab4d558a025&w=826" class="card-img-top" alt="">
                                    </div>
                                </a>
                            </div>
                            <?php if(isset($gabarito)){ ?>
                            <div class="col-6">
                                <a href="#" style="text-decoration: none;" id="abrirRespostasCorretas" data-bs-toggle="modal" data-bs-target="#respostasModal">
                                    <h5 class="text-center">Respostas Corretas</h5>
                                    <div class="card curso p-3" style="width: 18rem; margin: 0 auto;">
                                        <img src="img/respostas.png" class="card-img-top" alt="">
                                    </div>
                                </a>
                            </div>
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

<!-- Modal com carrossel de slides -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <!-- Carrossel de Slides -->
                <div id="carouselSlides" class="carousel slide" data-bs-interval="false"> <!-- Removido o data-bs-ride -->
                    <div class="carousel-inner">
                        <?php for($x = 1; $x <= $curso->n_slides; $x++){ ?>
                            <div class="carousel-item <?php if($x == 1){ echo "active"; } ?>">
                                <img src="<?php echo "/Skillhub/cursos/".$curso->id_curso."/".$x; ?>.png" class="d-block" style="width:1106px;height:663px;">
                            </div>
                        <?php } ?>
                        <!-- Adicione mais slides conforme necessário -->
                    </div>
                    <!-- Controles personalizados fora do slide -->
                    <button class="carousel-control-prev custom-carousel-control" type="button" data-bs-target="#carouselSlides" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next custom-carousel-control" type="button" data-bs-target="#carouselSlides" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Próximo</span>
                    </button>
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

<!-- Modal para mostrar as respostas corretas -->
<div class="modal fade fs-6" id="respostasModal" tabindex="-1" aria-labelledby="respostasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content p-4">
            <div class="modal-header">
                <h5 class="modal-title" id="respostasModalLabel">Respostas Corretas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php 
                    $n_questao = 0; // Começa com 0, já que o gabarito usa índice 0 para a primeira questão
                    $letras = ['A', 'B', 'C', 'D']; // Letras para as respostas
                    foreach($Perguntas->listar($quiz->id_quiz) as $pergunta){
                ?>
                    <div class="mb-3">
                        <label class="form-label fw-bolder">Questão <?php echo ($n_questao + 1) . ": " . $pergunta->pergunta; ?></label>
                        <?php 
                            // Recupera a resposta do usuário para essa questão
                            $resposta_usuario = isset($gabarito[$n_questao]) ? $gabarito[$n_questao] : null;

                            foreach($Respostas->listar($pergunta->id_pergunta) as $index => $resposta){ 
                                // Define a classe de estilo CSS com base na comparação com a resposta do usuário
                                $class = '';
                                if ($resposta->id_resposta == $resposta_usuario && $resposta->correta == 1) {
                                    $class = 'resposta-correta'; // Se o usuário selecionou a resposta correta
                                } elseif ($resposta->id_resposta == $resposta_usuario && $resposta->correta == 0) {
                                    $class = 'resposta-errada'; // Se o usuário selecionou a resposta errada
                                } elseif ($resposta->correta == 1) {
                                    $class = 'resposta-correta'; // Marca a correta, independentemente da escolha do usuário
                                }
                        ?>
                            <div class="form-check custom-radio <?php echo $class; ?>">
                                <label class="form-check-label" data-letter="<?php echo $letras[$index]; ?>">
                                    <?php echo $resposta->resposta; ?>
                                </label>
                            </div>
                        <?php 
                            } 
                        ?>
                    </div>
                <?php 
                        $n_questao++; // Avança para a próxima questão
                    }
                ?>
            </div>
            <div class="modal-footer mt-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
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
