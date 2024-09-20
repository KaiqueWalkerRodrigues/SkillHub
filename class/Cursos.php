<?php

class Curso {

    # ATRIBUTOS	
	public $pdo;
    
    public function __construct()
    {
        // Conexão com o banco de dados
        $this->pdo = Conexao::conexao();               
    }

    /**
     * Lista todos os cursos
     * @return array Retorna um array de objetos contendo os dados dos cursos.
     * @example $cursos = $obj->listar();
     */
    public function listar(){
        $sql = $this->pdo->prepare('SELECT * FROM cursos ORDER BY id_curso');        
        $sql->execute();
    
        // Pega todos os resultados da consulta
        $dados = $sql->fetchAll(PDO::FETCH_OBJ);
    
        // Retorna os dados como um array de objetos
        return $dados;
    }      

    /**
     * Cadastra um novo curso
     * @param array $dados Array contendo os dados do curso (nome, imagem, descricao).
     * @return int Retorna o ID do curso recém cadastrado.
     * @example $idCurso = $obj->cadastrar($_POST);
     */
    public function cadastrar(Array $dados)
    {
        $nome = trim($dados['nome']);
        $imagem = trim($dados['imagem']);
        $descricao = trim($dados['descricao']);

        // Prepara a query de inserção
        $sql = $this->pdo->prepare('INSERT INTO cursos 
                                    (nome, imagem, descricao)
                                    VALUES
                                    (:nome, :imagem, :descricao)
                                ');

        // Faz o binding dos parâmetros
        $sql->bindParam(':nome', $nome);          
        $sql->bindParam(':imagem', $imagem);          
        $sql->bindParam(':descricao', $descricao);          

        // Executa a query
        $sql->execute();

        // Retorna o último ID inserido (ID do curso cadastrado)
        return $this->pdo->lastInsertId();
    }

    /**
     * Mostra os dados de um curso
     * @param int $id_curso ID do curso que se deseja buscar.
     * @return object Retorna um objeto contendo os dados do curso.
     * @example $curso = $obj->mostrar($id_curso);
     */
    public function mostrar(int $id_curso)
    {
    	// Prepara a consulta
    	$sql = $this->pdo->prepare('SELECT * FROM cursos WHERE id_curso = :id_curso LIMIT 1');
        $sql->bindParam(':id_curso', $id_curso);
    	
        // Executa a consulta
    	$sql->execute();
    	
        // Pega os dados retornados
    	$dados = $sql->fetch(PDO::FETCH_OBJ);
    	
        // Retorna o objeto com os dados do curso
        return $dados;
    }

    /**
     * Atualiza os dados de um determinado curso
     *
     * @param array $dados Array com os dados atualizados do curso.
     * @return void
     * @example $obj->editar($_POST);
     */
    public function editar(array $dados)
    {
        $sql = $this->pdo->prepare("UPDATE cursos SET
            nome = :nome,
            imagem = :imagem,
            descricao = :descricao
        WHERE id_curso = :id_curso
        ");

        // Faz o binding dos parâmetros
        $nome = trim($dados['nome']);
        $imagem = trim($dados['imagem']);
        $descricao = trim($dados['descricao']);
        $id_curso = $dados['id_curso'];

        $sql->bindParam(':nome', $nome);
        $sql->bindParam(':imagem', $imagem);       
        $sql->bindParam(':descricao', $descricao);       
        $sql->bindParam(':id_curso', $id_curso);

        // Executa a consulta
        $sql->execute();
    }

    /**
     * Exclui um curso do banco de dados
     *
     * @param int $id_curso ID do curso a ser excluído.
     * @return void
     * @example $obj->excluir($id_curso);
     */
    public function excluir(int $id_curso)
    {
        // Prepara a consulta de exclusão
        $sql = $this->pdo->prepare('DELETE FROM cursos WHERE id_curso = :id_curso');
        $sql->bindParam(':id_curso', $id_curso);

        // Executa a consulta
        $sql->execute();
    }

}

?>
