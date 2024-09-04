<?php

class Aula {

    # ATRIBUTOS	
	public $pdo;
    
    public function __construct()
    {
        // Conexão com o banco de dados
        $this->pdo = Conexao::conexao();               
    }

    /**
     * Lista todas as aulas
     * @return array Retorna um array de objetos contendo os dados das aulas.
     * @example $aulas = $obj->listar();
     */
    public function listar(){
        $sql = $this->pdo->prepare('SELECT * FROM aulas ORDER BY id_aula');        
        $sql->execute();
    
        // Pega todos os resultados da consulta
        $dados = $sql->fetchAll(PDO::FETCH_OBJ);
    
        // Retorna os dados como um array de objetos
        return $dados;
    }      

    /**
     * Cadastra uma nova aula
     * @param array $dados Array contendo os dados da aula (id_curso, duracao, link).
     * @return int Retorna o ID da aula recém cadastrada.
     * @example $idAula = $obj->cadastrar($_POST);
     */
    public function cadastrar(Array $dados)
    {
        $id_curso  = $dados['id_curso'];
        $duracao = $dados['duracao'];
        $link = trim($dados['link']);

        // Prepara a query de inserção
        $sql = $this->pdo->prepare('INSERT INTO aulas 
                                    (id_curso, duracao, link)
                                    VALUES
                                    (:id_curso, :duracao, :link)
                                ');

        // Faz o binding dos parâmetros
        $sql->bindParam(':id_curso', $id_curso);          
        $sql->bindParam(':duracao', $duracao);          
        $sql->bindParam(':link', $link);          

        // Executa a query
        $sql->execute();

        // Retorna o último ID inserido (ID da aula cadastrada)
        return $this->pdo->lastInsertId();
    }

    /**
     * Mostra os dados de uma aula
     * @param int $id_aula ID da aula que se deseja buscar.
     * @return object Retorna um objeto contendo os dados da aula.
     * @example $aula = $obj->mostrar($id_aula);
     */
    public function mostrar(int $id_aula)
    {
    	// Prepara a consulta
    	$sql = $this->pdo->prepare('SELECT * FROM aulas WHERE id_aula = :id_aula LIMIT 1');
        $sql->bindParam(':id_aula', $id_aula);
    	
        // Executa a consulta
    	$sql->execute();
    	
        // Pega os dados retornados
    	$dados = $sql->fetch(PDO::FETCH_OBJ);
    	
        // Retorna o objeto com os dados da aula
        return $dados;
    }

    /**
     * Atualiza os dados de uma determinada aula
     *
     * @param array $dados Array com os dados atualizados da aula.
     * @return void
     * @example $obj->editar($_POST);
     */
    public function editar(array $dados)
    {
        $sql = $this->pdo->prepare("UPDATE aulas SET
            id_curso = :id_curso,
            duracao = :duracao, 
            link = :link
        WHERE id_aula = :id_aula
        ");

        // Faz o binding dos parâmetros
        $id_curso = $dados['id_curso'];
        $duracao = $dados['duracao'];
        $link = trim($dados['link']);
        $id_aula = $dados['id_aula'];

        $sql->bindParam(':id_curso', $id_curso);
        $sql->bindParam(':duracao', $duracao);
        $sql->bindParam(':link', $link);       
        $sql->bindParam(':id_aula', $id_aula);

        // Executa a consulta
        $sql->execute();
    }

    /**
     * Exclui uma aula do banco de dados
     *
     * @param int $id_aula ID da aula a ser excluída.
     * @return void
     * @example $obj->excluir($id_aula);
     */
    public function excluir(int $id_aula)
    {
        // Prepara a consulta de exclusão
        $sql = $this->pdo->prepare('DELETE FROM aulas WHERE id_aula = :id_aula');
        $sql->bindParam(':id_aula', $id_aula);

        // Executa a consulta
        $sql->execute();
    }

}

?>
