<?php 
    include_once('class/classes.php');
    
    $Usuario = new Usuario();

    if(isset($_POST['btnCadastrar'])){
        $Usuario->cadastrar($_POST);
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
        .valid {
            border: 2px solid green;
        }
        .invalid {
            border: 2px solid red;
        }
    </style>
</head>
<body style="background-color: #000000;">

    <div class="container-fluid">
        <form action="?" method="post">
            <div class="row">
                <div class="col-3 position-absolute top-50 start-50 translate-middle">
                    <div class="card p-4" style="border-radius: 15px">
                        <div class="mb-2">
                            <label for="cadastrar_nome" class="form-label d-block text-start" style="color: #FF914D; font-weight: bold;">Nome *</label>
                            <input type="text" class="form-control" id="cadastrar_nome" name="nome" style="background-color: lightgrey;">
                        </div>
                        <div class="mb-2">
                            <label for="cadastrar_cpf" class="form-label d-block text-start" style="color: #FF914D; font-weight: bold;">CPF *</label>
                            <input type="text" class="form-control" id="cadastrar_cpf" name="cpf" style="background-color: lightgrey;">
                        </div>
                        <div class="mb-2">
                            <label for="cadastrar_usuario" class="form-label d-block text-start" style="color: #FF914D; font-weight: bold;">Usuário *</label>
                            <input type="text" class="form-control" id="cadastrar_usuario" name="usuario" style="background-color: lightgrey;">
                        </div>
                        <div class="mb-3">
                            <label for="cadastrar_senha" class="form-label d-block text-start" style="color: #FF914D; font-weight: bold;">Senha *</label>
                            <input type="password" class="form-control" id="cadastrar_senha" name="senha" style="background-color: lightgrey;">
                        </div>
                        <div class="mb-3">
                            <label for="confirma_senha" class="form-label d-block text-start" style="color: #FF914D; font-weight: bold;">Confirma Senha *</label>
                            <input type="password" class="form-control" id="confirma_senha" style="background-color: lightgrey;">
                        </div>
                        <b class="text-danger text-center d-none" id="senhas_diferentes">Senhas Diferentes!</b>
                        <div class="mb-4 text-end">
                            <button type="submit" name="btnCadastrar" id="Cadastrar" class="btn btn-orange" style="border-radius: 15px">Cadastrar</button>
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

            // Verifica se o parâmetro 'sucesso' está presente na URL
            var sucesso = getParametroURL('sucesso');

            // Se 'sucesso' existir e for igual a 1, exibe um alert com a mensagem
            if (sucesso === '1') {
                alert('Usuário cadastrado com sucesso!');
                var novaURL = window.location.href.split('?')[0];
                window.history.replaceState(null, null, novaURL);
            }
        });
        function verificarSenhas(){
            let senha = $('#cadastrar_senha').val();
            let confirma_senha = $('#confirma_senha').val();
            
            if(senha == confirma_senha){
                $('#senhas_diferentes').addClass('d-none')
                $('#Cadastrar').removeClass('disabled')
            }else{
                $('#senhas_diferentes').removeClass('d-none')
                $('#Cadastrar').addClass('disabled')
            }
        }
        function validarCPF(cpf) {
            cpf = cpf.replace(/[^\d]+/g, ''); // Remove tudo que não for dígito
            
            if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) {
                return false;
            }

            var soma = 0, resto;

            // Validação do primeiro dígito verificador
            for (var i = 1; i <= 9; i++) {
                soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);
            }

            resto = (soma * 10) % 11;

            if ((resto === 10) || (resto === 11)) resto = 0;
            if (resto !== parseInt(cpf.substring(9, 10))) return false;

            soma = 0;

            // Validação do segundo dígito verificador
            for (i = 1; i <= 10; i++) {
                soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);
            }

            resto = (soma * 10) % 11;

            if ((resto === 10) || (resto === 11)) resto = 0;
            if (resto !== parseInt(cpf.substring(10, 11))) return false;

            return true;
        }
        $('#cadastrar_cpf').keyup(function (e) { 
            let cpf = $(this).val()

            if(validarCPF(cpf)){
                $(this).removeClass('invalid').addClass('valid');
            }else{
                $(this).removeClass('valid').addClass('invalid');
            }
        });
        $('#cadastrar_senha').keyup(function (e) { 
            verificarSenhas()
        });
        $('#confirma_senha').keyup(function (e) { 
            verificarSenhas()
        });
    </script>
    
</body>
</html>
