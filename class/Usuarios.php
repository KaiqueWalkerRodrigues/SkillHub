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
                $_SESSION['usuario'] = $dados->usuario;
                $_SESSION['id_usuario'] = $dados->id_usuario;
                
                return header('location:/SkillHub/portal');
            } else {
                return header('location:/SkillHub/login?erro');
            }
        } else {
            return header('location:/SkillHub/login?erro');
        }
    }


}

?>
