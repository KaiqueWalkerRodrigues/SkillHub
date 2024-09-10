<?php 
    include_once('class/classes.php');
    
    $Usuario = new Usuario();

    if(isset($_POST['btnLogar'])){
        $Usuario->logar($_POST['usuario'],$_POST['senha']);
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillHub - Login</title>

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
    </style>
</head>
<body style="background-color: #FFD3B5;">

    <div class="container-fluid">
        <form action="?" method="post">
            <div class="row">
                <div class="col-3 position-absolute top-50 start-50 translate-middle">
                    <div class="card p-4" style="border-radius: 15px">
                        <div class="text-center">
                            <img src="img/logo.png" style="width: 60%;" alt="">
                        </div>
                        <br>
                        <div class="mb-2">
                            <label for="logar_usuario" class="form-label d-block text-start" style="color: #FF914D; font-weight: bold;">Usuário</label>
                            <input type="text" class="form-control" name="usuario" style="background-color: lightgrey;">
                        </div>
                        <div class="mb-3">
                            <label for="logar_senha" class="form-label d-block text-start" style="color: #FF914D; font-weight: bold;">Senha</label>
                            <input type="password" class="form-control" name="senha" style="background-color: lightgrey;">
                        </div>
                        <div class="mb-4 text-end">
                            <!-- <button type="submit" class="btn btn-orange" style="border-radius: 15px">Entrar</button> -->
                            <button type="submit" name="btnLogar" class="btn btn-orange" style="border-radius: 15px">Entrar</button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // Função para obter o valor de um parâmetro na URL
            function getParametroURL(nome) {
                var resultados = new RegExp('[\?&]' + nome + '=([^&#]*)').exec(window.location.href);
                if (resultados) {
                    return resultados[1];
                }
                return null;
            }

            // Verifica se o parâmetro 'erro' ou 'falha' está presente na URL
            var erro = getParametroURL('erro');
            var falha = getParametroURL('falha');

            // Se 'erro' existir e for igual a 1, exibe um alert com a mensagem
            if (erro == 1) {
                alert('Acesso Restrito! Efetue login para acessar');
                var novaURL = window.location.href.split('?')[0];
                window.history.replaceState(null, null, novaURL);
            }
            if (falha == 1 || Falha == 2) {
                alert('Falha no Login, Usuário ou Senha Incorreto!');
                var novaURL = window.location.href.split('?')[0];
                window.history.replaceState(null, null, novaURL);
            }
        });
    </script>
    
</body>
</html>
