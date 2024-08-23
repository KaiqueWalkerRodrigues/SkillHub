<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillHub - Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>

    <div class="container-fluid">
        <form action="?" method="post">
            <div class="row">
                <div class="col-4 position-absolute top-50 start-50 translate-middle">
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
                            <input type="text" class="form-control" name="senha" style="background-color: lightgrey;">
                        </div>
                        <div class="mb-4 text-end">
                            <button type="submit" class="btn btn-orange" style="border-radius: 15px">Entrar</button>
                        </div>
                        <div class="text-center">
                            <a href="registrar.php" class="link_registrar">Não tem uma conta? <b>Cadastrar-se</b></a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
</body>
</html>
