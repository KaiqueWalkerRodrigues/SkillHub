<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillHub - Ínicio</title>

    <?php include_once('link.php') ?>
</head>
<body>

    <?php 
        include_once('navbar.php');
    ?>

<div class="container mt-4">
        <a href="index.php" class="btn btn-secondary mb-2">Voltar</a>
        <div class="card p-4">
            <h3>Introdução ao Uso de Computadores</h3>
            <br>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iure ab porro hic officia ipsam quibusdam tenetur eius, odio harum? Soluta, culpa placeat magni laboriosam eligendi consectetur? Dignissimos rem aut labore.</p>
            <br>
            <div class="row">
                <div class="row col-8 offset-2 text-center">

                    <div class="row mb-4">
                        <h4 style="font-family: Verdana, Geneva, Tahoma, sans-serif;">Aula 1</h4>
                        <div class="col-6">
                            <!-- Botão que abre o modal -->
                            <a href="#" style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#videoModal">
                                <h5 class="text-center">Vídeo Aula</h5>
                                <div class="card curso p-3" style="width: 18rem; margin: 0 auto;">
                                    <img src="cursos/1/miniatura1.png" class="card-img-top" alt="">
                                </div>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="" style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#quizModal">
                                <h5 class="text-center">Quiz</h5>
                                <div class="card curso p-3" style="width: 18rem; margin: 0 auto;">
                                    <img src="quiz.jpg" class="card-img-top" alt="">
                                </div>
                            </a>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-4">
                        <h4 style="font-family: Verdana, Geneva, Tahoma, sans-serif;">Aula 2</h4>
                        <div class="col-6">
                            <!-- Botão que abre o modal -->
                            <a href="#" style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#videoModal">
                                <h5 class="text-center">Vídeo Aula</h5>
                                <div class="card curso p-3" style="width: 18rem; margin: 0 auto;">
                                    <img src="cursos/1/miniatura2.png" class="card-img-top" alt="">
                                </div>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="" style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#quizModal">
                                <h5 class="text-center">Quiz</h5>
                                <div class="card curso p-3" style="width: 18rem; margin: 0 auto;">
                                    <img src="quiz.jpg" class="card-img-top" alt="">
                                </div>
                            </a>
                        </div>
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
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/oCNV0lXfXU0?si=1hSQUbZS2IacPGLi" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="quizModal" tabindex="-1" aria-labelledby="quizModalLabel" aria-hidden="true">
        <form action="?" method="post">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="quizModalLabel">Aula 1 - Introdução ao Uso de Computadores</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-5 offset-1 text-center">
                                <label for="questao1" class="form-label">Questão 1</label>
                                <input type="text" name="questao1" id="questao1" class="form-control" required>
                            </div>
                            <div class="col-5 text-center">
                                <label for="questao2" class="form-label">Questão 1</label>
                                <select name="questao2" id="questao2" class="form-control" required>
                                    <option value="">Selecione...</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer mt-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button class="btn btn-success">Enviar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Scripts do Bootstrap (necessário para o funcionamento do modal) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb7m00IVIyjDZHn2gFp51RoShbZp6NAM0CfaQrZy0pP4pEP8s" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuQ7g5p1QolTMZZ5RdYUV02pAqO95nMNylVvC82bg4l7o1EDvF4Np5dAJ9HgEyjE" crossorigin="anonymous"></script>
</body>
</html>
