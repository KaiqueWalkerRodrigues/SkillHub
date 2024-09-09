<?php

class Pergunta {

    # ATRIBUTOS    
    public $pdo;
    
    public function __construct()
    {
        // Conexão com o banco de dados
        $this->pdo = Conexao::conexao();               
    }

    /**
     * Lista todas as perguntas
     * @return array Retorna um array de objetos contendo os dados das perguntas.
     * @example $perguntas = $obj->listar();
     */
    public function listar($id_quiz){
        $sql = $this->pdo->prepare('SELECT * FROM perguntas WHERE id_quiz = :id_quiz ORDER BY id_pergunta');   
        $sql->bindParam(':id_quiz',$id_quiz);     
        $sql->execute();
    
        // Pega todos os resultados da consulta
        $dados = $sql->fetchAll(PDO::FETCH_OBJ);
    
        // Retorna os dados como um array de objetos
        return $dados;
    }      

    /**
     * Cadastra uma nova pergunta
     * @param array $dados Array contendo os dados da pergunta (id_quiz, pergunta).
     * @return int Retorna o ID da pergunta recém cadastrada.
     * @example $idPergunta = $obj->cadastrar($_POST);
     */
    public function cadastrar(Array $dados)
    {
        $id_quiz = $dados['id_quiz'];
        $pergunta = trim($dados['pergunta']);

        // Prepara a query de inserção
        $sql = $this->pdo->prepare('INSERT INTO perguntas 
                                    (id_quiz, pergunta)
                                    VALUES
                                    (:id_quiz, :pergunta)
                                ');

        // Faz o binding dos parâmetros
        $sql->bindParam(':id_quiz', $id_quiz);          
        $sql->bindParam(':pergunta', $pergunta);          

        // Executa a query
        $sql->execute();

        // Retorna o último ID inserido (ID da pergunta cadastrada)
        return $this->pdo->lastInsertId();
    }

    /**
     * Mostra os dados de uma pergunta
     * @param int $id_pergunta ID da pergunta que se deseja buscar.
     * @return object Retorna um objeto contendo os dados da pergunta.
     * @example $pergunta = $obj->mostrar($id_pergunta);
     */
    public function mostrar(int $id_pergunta)
    {
        // Prepara a consulta
        $sql = $this->pdo->prepare('SELECT * FROM perguntas WHERE id_pergunta = :id_pergunta LIMIT 1');
        $sql->bindParam(':id_pergunta', $id_pergunta);
        
        // Executa a consulta
        $sql->execute();
        
        // Pega os dados retornados
        $dados = $sql->fetch(PDO::FETCH_OBJ);
        
        // Retorna o objeto com os dados da pergunta
        return $dados;
    }

    /**
     * Atualiza os dados de uma determinada pergunta
     *
     * @param array $dados Array com os dados atualizados da pergunta.
     * @return void
     * @example $obj->editar($_POST);
     */
    public function editar(array $dados)
    {
        $sql = $this->pdo->prepare("UPDATE perguntas SET
            id_quiz = :id_quiz,
            pergunta = :pergunta
        WHERE id_pergunta = :id_pergunta
        ");

        // Faz o binding dos parâmetros
        $id_quiz = $dados['id_quiz'];
        $pergunta = trim($dados['pergunta']);
        $id_pergunta = $dados['id_pergunta'];

        $sql->bindParam(':id_quiz', $id_quiz);
        $sql->bindParam(':pergunta', $pergunta);       
        $sql->bindParam(':id_pergunta', $id_pergunta);

        // Executa a consulta
        $sql->execute();
    }

    /**
     * Exclui uma pergunta do banco de dados
     *
     * @param int $id_pergunta ID da pergunta a ser excluída.
     * @return void
     * @example $obj->excluir($id_pergunta);
     */
    public function excluir(int $id_pergunta)
    {
        // Prepara a consulta de exclusão
        $sql = $this->pdo->prepare('DELETE FROM perguntas WHERE id_pergunta = :id_pergunta');
        $sql->bindParam(':id_pergunta', $id_pergunta);

        // Executa a consulta
        $sql->execute();
    }

}

?>
