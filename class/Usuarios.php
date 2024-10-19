<?php

class Usuario {

    # ATRIBUTOS	
	public $pdo;
    
    public function __construct()
    {
        // Conexão com o banco de dados
        $this->pdo = Conexao::conexao();               
    }

    /**
     * Lista todos os usuários
     * @return array Retorna um array de objetos contendo os dados dos usuários.
     * @example $usuarios = $obj->listar();
     */
    public function listar(){
        $sql = $this->pdo->prepare('SELECT * FROM usuarios ORDER BY nome');        
        $sql->execute();
    
        // Pega todos os resultados da consulta
        $dados = $sql->fetchAll(PDO::FETCH_OBJ);
    
        // Retorna os dados como um array de objetos
        return $dados;
    }      

    /**
     * Cadastra um novo usuário
     * @param array $dados Array contendo os dados do usuário (nome, cpf, usuario, senha).
     * @return int Retorna o ID do usuário recém cadastrado.
     * @example $idUsuario = $obj->cadastrar($_POST);
     */
    public function cadastrar(Array $dados)
    {
        $nome  = trim($dados['nome']);
        $cpf = trim($dados['cpf']);
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        $usuario = strtolower(trim($dados['usuario']));
        $salt = 'Skill';
        $senha = crypt($dados['senha'], $salt);

        // Prepara a query de inserção
        $sql = $this->pdo->prepare('INSERT INTO usuarios 
                                    (nome, cpf, usuario, senha)
                                    VALUES
                                    (:nome, :cpf, :usuario, :senha)
                                ');

        // Faz o binding dos parâmetros
        $sql->bindParam(':nome', $nome);          
        $sql->bindParam(':cpf', $cpf);          
        $sql->bindParam(':usuario', $usuario);          
        $sql->bindParam(':senha', $senha);          

        // Executa a query
        $sql->execute();

        // Retorna o último ID inserido (ID do usuário cadastrado)
        return header('location:/Skillhub/cadastrar_usuario?sucesso');
    }

    /**
     * Mostra os dados de um usuário
     * @param int $id_usuario ID do usuário que se deseja buscar.
     * @return object Retorna um objeto contendo os dados do usuário.
     * @example $usuario = $obj->mostrar($id_usuario);
     */
    public function mostrar(int $id_usuario)
    {
    	// Prepara a consulta
    	$sql = $this->pdo->prepare('SELECT * FROM usuarios WHERE id_usuario = :id_usuario LIMIT 1');
        $sql->bindParam(':id_usuario', $id_usuario);
    	
        // Executa a consulta
    	$sql->execute();
    	
        // Pega os dados retornados
    	$dados = $sql->fetch(PDO::FETCH_OBJ);
    	
        // Retorna o objeto com os dados do usuário
        return $dados;
    }

    /**
     * Atualiza os dados de um determinado usuário
     *
     * @param array $dados Array com os dados atualizados do usuário.
     * @return void
     * @example $obj->editar($_POST);
     */
    public function editar(array $dados)
    {
        // Corrige a vírgula desnecessária após o campo 'cpf'
        $sql = $this->pdo->prepare("UPDATE usuarios SET
            nome = :nome,
            cpf = :cpf, 
            usuario = :usuario,
            senha = :senha
        WHERE id_usuario = :id_usuario
        ");

        // Faz o binding dos parâmetros
        $nome = trim($dados['nome']);
        $cpf = $dados['cpf'];
        $usuario = $dados['usuario']; 
        $salt = 'Skill';
        $senha = crypt($dados['senha'], $salt);

        $sql->bindParam(':nome', $nome);
        $sql->bindParam(':cpf', $cpf);
        $sql->bindParam(':usuario', $usuario);       
        $sql->bindParam(':senha', $senha);       
        $sql->bindParam(':id_usuario', $dados['id_usuario']);

        // Executa a consulta
        $sql->execute();
    }

    /**
     * Exclui um usuário do banco de dados
     *
     * @param int $id_usuario ID do usuário a ser excluído.
     * @return void
     * @example $obj->excluir($id_usuario);
     */
    public function excluir(int $id_usuario)
    {
        // Prepara a consulta de exclusão
        $sql = $this->pdo->prepare('DELETE FROM usuarios WHERE id_usuario = :id_usuario');
        $sql->bindParam(':id_usuario', $id_usuario);

        // Executa a consulta
        $sql->execute();
    }

    public function logar($usuario, $senha)
    {
        $usuario = strtolower($usuario);
        // Prepara a consulta para buscar o usuário pelo nome de usuário
        $sql = $this->pdo->prepare('SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1');
        $sql->bindParam(':usuario', $usuario);
        
        // Executa a consulta
        $sql->execute();
        
        // Pega os dados retornados
        $dados = $sql->fetch(PDO::FETCH_OBJ);
        
        // Verifica se o usuário foi encontrado
        if ($dados) {
            $salt = 'Skill';

            // Verifica se a senha fornecida corresponde ao hash da senha no banco de dados
            if (crypt($senha, $salt) == $dados->senha) {
                // Login bem-sucedido
                // Aqui, você pode definir a sessão do usuário, por exemplo:
                session_start();
                $_SESSION['logado'] = true;
                $_SESSION['usuario'] = $dados->usuario;
                $_SESSION['id_usuario'] = $dados->id_usuario;
                
                return header('location:/SkillHub/portal');
            } else {
                return header('location:/SkillHub/login?falha=1');
            }
        } else {
            return header('location:/SkillHub/login?falha=1');
        }
    }

    public function corrigirQuiz($dados) {
        $nota = 0;
        $gabarito = [
            'questao1' => 'B',
            'questao2' => 'B',
            'questao3' => 'B',
            'questao4' => 'A',
            'questao5' => 'B',
            'questao6' => 'D',
            'questao7' => 'C',
            'questao8' => 'C',
            'questao9' => 'B',
            'questao10' => 'C'
        ];
    
        $id_usuario = $dados['id_usuario'];
    
        // Verifica se o usuário já possui uma nota ou gabarito cadastrados
        $sql = $this->pdo->prepare("SELECT nota_quiz_geral, gabarito_geral FROM usuarios WHERE id_usuario = :id_usuario");
        $sql->bindParam(':id_usuario', $id_usuario);
        $sql->execute();
        $usuario = $sql->fetch(PDO::FETCH_OBJ);
    
        if ($usuario && $usuario->nota_quiz_geral !== null && $usuario->gabarito_geral !== null) {
            // Se o usuário já possui uma nota e gabarito, exibe um alerta
            echo "<script>alert('Você já respondeu este quiz. Não é possível enviar novamente.');</script>";
            exit();
        }
    
        // Calcula a nota
        foreach ($gabarito as $questao => $respostaCorreta) {
            if (isset($dados[$questao]) && $dados[$questao] == $respostaCorreta) {
                $nota++;
            }
        }
    
        // Remove o id_usuario dos dados para não ser incluído no gabarito
        unset($dados['id_usuario']);
    
        // Monta o gabarito no formato A,C,F,B,C,A,G (questões que vêm de dados)
        $gabarito_geral = implode(',', array_values($dados));
    
        $sql = $this->pdo->prepare("UPDATE usuarios SET
            nota_quiz_geral = :nota,
            gabarito_geral = :gabarito_geral
        WHERE id_usuario = :id_usuario");
    
        $sql->bindParam(':nota', $nota);
        $sql->bindParam(':gabarito_geral', $gabarito_geral);
        $sql->bindParam(':id_usuario', $id_usuario);
    
        // Executa a consulta
        $sql->execute();
    
        // Redireciona com a nota como parâmetro na URL
        header('location: /Skillhub/portal?nota=' . $nota);
        exit();
    }    

    public function obterNota($id_usuario)
    {
        // Prepara a consulta para buscar a nota do usuário
        $sql = $this->pdo->prepare('SELECT nota_quiz_geral FROM usuarios WHERE id_usuario = :id_usuario LIMIT 1');
        $sql->bindParam(':id_usuario', $id_usuario);

        // Executa a consulta
        $sql->execute();

        // Pega os dados retornados
        $dados = $sql->fetch(PDO::FETCH_OBJ);

        // Verifica se a nota foi encontrada
        if ($dados && $dados->nota_quiz_geral !== null) {
            return $dados->nota_quiz_geral;
        } else {
            return false; // Retorna false se não houver nota cadastrada
        }
    }
    
}

?>
