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
    <title>SkillHub - Início</title>

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
        .quiz-card {
            width: 100%; /* Largura total */
            max-width: 300px; /* Largura máxima para centralizar */
            margin: 0 auto; /* Centraliza horizontalmente */
            border-radius: 15px;
            overflow: hidden; /* Garante que o conteúdo se ajuste ao card */
        }
        .quiz-img {
            height: 100%; /* Ocupa toda a altura do card */
            width: 100%; /* Ocupa toda a largura do card */
            object-fit: cover; /* Garante que a imagem se ajusta corretamente */
        }
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

    <?php include_once('navbar.php'); ?>

    <div class="container mt-4">
        <div class="row">
            <h2 style="font-weight: bolder;">Cursos</h2>
            <hr>
            <?php foreach($Cursos->listar() as $curso) { ?>
      
            <div class="col-3 mb-5">
                <a href="curso?id=<?php echo $curso->id_curso ?>" style="text-decoration: none;">
                    <div class="card curso w-100 p-3">
                        <img src="cursos/<?php echo $curso->id_curso ?>/capa.jpg" class="card-img-top" alt="">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo $curso->nome ?></h5>
                            <button class="btn btn-orange btn-acessar">Acessar</button>
                        </div>
                    </div>
                </a>
            </div>
            <?php }; ?>
        </div>

        <hr>
            
        <div>
            <a href="#" style="text-decoration: none;" id="abrirQuiz" data-bs-toggle="modal" data-bs-target="#quizModal">
                <h5 class="text-center">Quiz Geral</h5>
                <div class="quiz-card curso p-3" style="width: 18rem; margin: 0 auto;">
                    <img class="quiz-img" src="https://img.freepik.com/free-vector/speech-bubble-with-interrogation-sign-talking_24877-84070.jpg?t=st=1726667639~exp=1726671239~hmac=c2e14b1cfa970713154dac5b642d30cd83ff9195ab9cb8dd57344ab4d558a025&w=826" class="card-img-top" alt="">
                </div>
            </a>
        </div>
    </div>

    <div class="modal fade fs-6" id="quizModal" tabindex="-1" aria-labelledby="quizModalLabel" aria-hidden="true">
        <form action="?" method="post">
            <div class="modal-dialog modal-xl">
                <div class="modal-content p-4">
                    <div class="modal-header">
                        <h5 class="modal-title" id="quizModalLabel">Questionário Geral</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id_usuario'] ?>">
                    <div class="modal-body">
                        <div class="mb-3">

                            <!-- Questão 1 -->
                                <label class="form-label fw-bolder">1. Quais são algumas funções comuns do mouse e do teclado que facilitam o uso do computador?</label>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao1" id="resposta1" value="A" required>
                                    <label class="form-check-label" for="resposta1" data-letter="A">
                                        Apenas clicar com o botão direito do mouse.             
                                    </label>
                                </div>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao1" id="resposta2" value="B" required>
                                    <label class="form-check-label" for="resposta2" data-letter="B">
                                        Clique simples, clique duplo, teclas de função e atalhos como Ctrl + C (copiar) e Ctrl + V (colar).
                                    </label>
                                </div>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao1" id="resposta3" value="C" required>
                                    <label class="form-check-label" for="resposta3" data-letter="C">
                                        Arrastar e soltar somente no teclado.
                                    </label>
                                </div>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao1" id="resposta4" value="D" required>
                                    <label class="form-check-label" for="resposta4" data-letter="D">
                                        Apertar todas as teclas ao mesmo tempo para maior eficiência.
                                    </label>
                                </div>

                            <!-- /Questão 1 -->

                            <!-- Questão 2 -->
                                <label class="form-label fw-bolder">2. O que é um sistema operacional e qual a sua função principal?</label>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao2" id="resposta5" value="A" required>
                                    <label class="form-check-label" for="resposta5" data-letter="A">
                                        Um software que gerencia exclusivamente a internet.            
                                    </label>
                                </div>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao2" id="resposta6" value="B" required>
                                    <label class="form-check-label" for="resposta6" data-letter="B">
                                        Um software que gerencia o hardware do computador e fornece serviços para os programas de aplicação.
                                    </label>
                                </div>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao2" id="resposta7" value="C" required>
                                    <label class="form-check-label" for="resposta7" data-letter="C">
                                        Um software de segurança que protege o computador contra vírus.
                                    </label>
                                </div>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao2" id="resposta8" value="D" required>
                                    <label class="form-check-label" for="resposta8" data-letter="D">
                                        Um programa que serve apenas para rodar jogos.
                                    </label>
                                </div>

                            <!-- /Questão 2 -->

                            <!-- Questão 3 -->
                                <label class="form-label fw-bolder">3. Qual é a função principal da CPU em um computador?</label>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao3" id="resposta9" value="A" required>
                                    <label class="form-check-label" for="resposta9" data-letter="A">
                                        Exibir imagens e vídeos.
                                    </label>
                                </div>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao3" id="resposta10" value="B" required>
                                    <label class="form-check-label" for="resposta10" data-letter="B">
                                        Processar informações e executar instruções.
                                    </label>
                                </div>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao3" id="resposta11" value="C" required>
                                    <label class="form-check-label" for="resposta11" data-letter="C">
                                        Armazenar arquivos e documentos.
                                    </label>
                                </div>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao3" id="resposta12" value="D" required>
                                    <label class="form-check-label" for="resposta12" data-letter="D">
                                        Conectar o computador à internet.
                                    </label>
                                </div>
                            <!-- /Questão 3 -->

                            <!-- Questão 4 -->
                                <label class="form-label fw-bolder">4. Qual é a sequência correta para desligar um computador?</label>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao4" id="resposta13" value="A" required>
                                    <label class="form-check-label" for="resposta13" data-letter="A">
                                        Acessar o menu 'Iniciar' e selecionar 'Desligar'.
                                    </label>
                                </div>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao4" id="resposta14" value="B" required>
                                    <label class="form-check-label" for="resposta14" data-letter="B">
                                        Fechar todos os programas e desconectar da energia.
                                    </label>
                                </div>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao4" id="resposta15" value="C" required>
                                    <label class="form-check-label" for="resposta15" data-letter="C">
                                        Pressionar o botão de energia até o computador desligar.
                                    </label>
                                </div>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao4" id="resposta16" value="D" required>
                                    <label class="form-check-label" for="resposta16" data-letter="D">
                                        Desligar o estabilizador e depois o computador.
                                    </label>
                                </div>
                            <!-- /Questão 4 -->

                            <!-- Questão 5 -->
                                <label class="form-label fw-bolder">5. Qual a tecla do teclado para excluir uma pasta ou arquivo?</label>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao5" id="resposta17" value="A" required>
                                    <label class="form-check-label" for="resposta17" data-letter="A">
                                        Enter
                                    </label>
                                </div>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao5" id="resposta18" value="B" required>
                                    <label class="form-check-label" for="resposta18" data-letter="B">
                                        Delete
                                    </label>
                                </div>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao5" id="resposta19" value="C" required>
                                    <label class="form-check-label" for="resposta19" data-letter="C">
                                        Shift
                                    </label>
                                </div>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao5" id="resposta20" value="D" required>
                                    <label class="form-check-label" for="resposta20" data-letter="D">
                                        Esc
                                    </label>
                                </div>
                            <!-- /Questão 5 -->

                            <!-- Questão 6 -->
                                <label class="form-label fw-bolder">6. Qual é o processo para mover uma pasta para outro local?</label>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao6" id="resposta21" value="A" required>
                                    <label class="form-check-label" for="resposta21" data-letter="A">
                                        Arrastar e soltar a pasta no novo local desejado
                                    </label>
                                </div>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao6" id="resposta22" value="B" required>
                                    <label class="form-check-label" for="resposta22" data-letter="B">
                                        Clicar com o botão direito e escolher a opção "Mover para"
                                    </label>
                                </div>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao6" id="resposta23" value="C" required>
                                    <label class="form-check-label" for="resposta23" data-letter="C">
                                        Recortar a pasta e colar no novo local
                                    </label>
                                </div>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao6" id="resposta24" value="D" required>
                                    <label class="form-check-label" for="resposta24" data-letter="D">
                                        Todas as alternativas anteriores
                                    </label>
                                </div>
                            <!-- /Questão 6 -->

                            <!-- Questão 7 -->
                                <label class="form-label fw-bolder">7. O que é um URL?</label>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao7" id="resposta25" value="A" required>
                                    <label class="form-check-label" for="resposta25" data-letter="A">
                                        Um tipo de vírus de computador
                                    </label>
                                </div>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao7" id="resposta26" value="B" required>
                                    <label class="form-check-label" for="resposta26" data-letter="B">
                                        Um sistema operacional
                                    </label>
                                </div>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao7" id="resposta27" value="C" required>
                                    <label class="form-check-label" for="resposta27" data-letter="C">
                                        O endereço de um recurso na web, como uma página ou arquivo
                                    </label>
                                </div>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao7" id="resposta28" value="D" required>
                                    <label class="form-check-label" for="resposta28" data-letter="D">
                                        Um atalho de teclado para abrir pastas
                                    </label>
                                </div>
                            <!-- /Questão 7 -->

                            <!-- Questão 8 -->
                                <label class="form-label fw-bolder">8. Como realizar uma pesquisa na internet?</label>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao8" id="resposta29" value="A" required>
                                    <label class="form-check-label" for="resposta29" data-letter="A">
                                        Abrir o programa pesquisa do windows e pesquisar
                                    </label>
                                </div>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao8" id="resposta30" value="B" required>
                                    <label class="form-check-label" for="resposta30" data-letter="B">
                                        Clicar em qualquer link disponível na tela
                                    </label>
                                </div>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao8" id="resposta31" value="C" required>
                                    <label class="form-check-label" for="resposta31" data-letter="C">
                                        Abrir o navegador, digitar o que deseja buscar na barra de pesquisa e pressionar Enter
                                    </label>
                                </div>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao8" id="resposta32" value="D" required>
                                    <label class="form-check-label" for="resposta32" data-letter="D">
                                        Fazer o download de um programa para realizar pesquisas
                                    </label>
                                </div>
                            <!-- /Questão 8 -->

                            <!-- Questão 9 -->
                                <label class="form-label fw-bolder">9. Qual é a principal razão para usar senhas seguras na internet?</label>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao9" id="resposta33" value="A" required>
                                    <label class="form-check-label" for="resposta33" data-letter="A">
                                        Para garantir que você consiga lembrar a senha mais facilmente.
                                    </label>
                                </div>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao9" id="resposta34" value="B" required>
                                    <label class="form-check-label" for="resposta34" data-letter="B">
                                        Para proteger suas informações pessoais contra acessos não autorizados.
                                    </label>
                                </div>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao9" id="resposta35" value="C" required>
                                    <label class="form-check-label" for="resposta35" data-letter="C">
                                        Para que a senha se pareça mais elegante.
                                    </label>
                                </div>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao9" id="resposta36" value="D" required>
                                    <label class="form-check-label" for="resposta36" data-letter="D">
                                        Para que o computador fique mais rápido.
                                    </label>
                                </div>
                            <!-- /Questão 9 -->

                            <!-- Questão 10 -->
                                <label class="form-label fw-bolder">10. Qual das seguintes práticas ajuda a proteger seu computador contra vírus e malware?</label>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao10" id="resposta37" value="A" required>
                                    <label class="form-check-label" for="resposta37" data-letter="A">
                                        Manter o antivírus desativado para não consumir recursos do sistema.
                                    </label>
                                </div>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao10" id="resposta38" value="B" required>
                                    <label class="form-check-label" for="resposta38" data-letter="B">
                                        Usar um gerenciador de senhas para armazenar senhas de forma segura.
                                    </label>
                                </div>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao10" id="resposta39" value="C" required>
                                    <label class="form-check-label" for="resposta39" data-letter="C">
                                        Atualizar o sistema operacional e o software de antivírus regularmente.
                                    </label>
                                </div>

                                <div class="form-check custom-radio">
                                    <input class="form-check-input" type="radio" name="questao10" id="resposta40" value="D" required>
                                    <label class="form-check-label" for="resposta40" data-letter="D">
                                        Desativar o firewall para permitir conexões mais rápidas.
                                    </label>
                                </div>
                            <!-- /Questão 10 -->

                        </div>
                    </div>
                    <div class="modal-footer mt-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" name="btnEnviar" class="btn btn-success">Enviar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</html>
