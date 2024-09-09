<?php

class Quiz {

    # ATRIBUTOS	
	public $pdo;
    
    public function __construct()
    {
        // Conexão com o banco de dados
        $this->pdo = Conexao::conexao();               
    }

    /**
     * Lista todos os quizzes
     * @return array Retorna um array de objetos contendo os dados dos quizzes.
     * @example $quizzes = $obj->listar();
     */
    public function listar($id_curso){
        $sql = $this->pdo->prepare('SELECT * FROM quizzes WHERE id_curso = :id_curso ORDER BY id_quiz');     
        $sql->bindParam(':id_curso',$id_curso);   
        $sql->execute();
    
        // Pega todos os resultados da consulta
        $dados = $sql->fetchAll(PDO::FETCH_OBJ);
    
        // Retorna os dados como um array de objetos
        return $dados;
    }      

    /**
     * Cadastra um novo quiz
     * @param array $dados Array contendo os dados do quiz (id_curso).
     * @return int Retorna o ID do quiz recém cadastrado.
     * @example $idQuiz = $obj->cadastrar($_POST);
     */
    public function cadastrar(Array $dados)
    {
        $id_curso = $dados['id_curso'];

        // Prepara a query de inserção
        $sql = $this->pdo->prepare('INSERT INTO quizzes 
                                    (id_curso)
                                    VALUES
                                    (:id_curso)
                                ');

        // Faz o binding dos parâmetros
        $sql->bindParam(':id_curso', $id_curso);          

        // Executa a query
        $sql->execute();

        // Retorna o último ID inserido (ID do quiz cadastrado)
        return $this->pdo->lastInsertId();
    }

    /**
     * Mostra os dados de um quiz
     * @param int $id_quiz ID do quiz que se deseja buscar.
     * @return object Retorna um objeto contendo os dados do quiz.
     * @example $quiz = $obj->mostrar($id_quiz);
     */
    public function mostrar(int $id_quiz)
    {
    	// Prepara a consulta
    	$sql = $this->pdo->prepare('SELECT * FROM quizzes WHERE id_quiz = :id_quiz LIMIT 1');
        $sql->bindParam(':id_quiz', $id_quiz);
    	
        // Executa a consulta
    	$sql->execute();
    	
        // Pega os dados retornados
    	$dados = $sql->fetch(PDO::FETCH_OBJ);
    	
        // Retorna o objeto com os dados do quiz
        return $dados;
    }

    /**
     * Atualiza os dados de um determinado quiz
     *
     * @param array $dados Array com os dados atualizados do quiz.
     * @return void
     * @example $obj->editar($_POST);
     */
    public function editar(array $dados)
    {
        $sql = $this->pdo->prepare("UPDATE quizzes SET
            id_curso = :id_curso
        WHERE id_quiz = :id_quiz
        ");

        // Faz o binding dos parâmetros
        $id_curso = $dados['id_curso'];
        $id_quiz = $dados['id_quiz'];

        $sql->bindParam(':id_curso', $id_curso);
        $sql->bindParam(':id_quiz', $id_quiz);

        // Executa a consulta
        $sql->execute();
    }

    /**
     * Exclui um quiz do banco de dados
     *
     * @param int $id_quiz ID do quiz a ser excluído.
     * @return void
     * @example $obj->excluir($id_quiz);
     */
    public function excluir(int $id_quiz)
    {
        // Prepara a consulta de exclusão
        $sql = $this->pdo->prepare('DELETE FROM quizzes WHERE id_quiz = :id_quiz');
        $sql->bindParam(':id_quiz', $id_quiz);

        // Executa a consulta
        $sql->execute();
    }

}

?>
