<?php

class Resposta {

    # ATRIBUTOS    
    public $pdo;
    
    public function __construct()
    {
        // Conexão com o banco de dados
        $this->pdo = Conexao::conexao();               
    }

    /**
     * Lista todas as respostas
     * @return array Retorna um array de objetos contendo os dados das respostas.
     * @example $respostas = $obj->listar();
     */
    public function listar($id_pergunta){
        $sql = $this->pdo->prepare('SELECT * FROM respostas WHERE id_pergunta = :id_pergunta ORDER BY id_resposta');        
        $sql->bindParam(':id_pergunta',$id_pergunta);
        $sql->execute();
    
        // Pega todos os resultados da consulta
        $dados = $sql->fetchAll(PDO::FETCH_OBJ);
    
        // Retorna os dados como um array de objetos
        return $dados;
    }      

    /**
     * Cadastra uma nova resposta
     * @param array $dados Array contendo os dados da resposta (id_pergunta, resposta, correta).
     * @return int Retorna o ID da resposta recém cadastrada.
     * @example $idResposta = $obj->cadastrar($_POST);
     */
    public function cadastrar(Array $dados)
    {
        $id_pergunta = $dados['id_pergunta'];
        $resposta = trim($dados['resposta']);
        $correta = isset($dados['correta']) ? $dados['correta'] : 0; // Define 0 como padrão se não for fornecido

        // Prepara a query de inserção
        $sql = $this->pdo->prepare('INSERT INTO respostas 
                                    (id_pergunta, resposta, correta)
                                    VALUES
                                    (:id_pergunta, :resposta, :correta)
                                ');

        // Faz o binding dos parâmetros
        $sql->bindParam(':id_pergunta', $id_pergunta);          
        $sql->bindParam(':resposta', $resposta);          
        $sql->bindParam(':correta', $correta);          

        // Executa a query
        $sql->execute();

        // Retorna o último ID inserido (ID da resposta cadastrada)
        return $this->pdo->lastInsertId();
    }

    /**
     * Mostra os dados de uma resposta
     * @param int $id_resposta ID da resposta que se deseja buscar.
     * @return object Retorna um objeto contendo os dados da resposta.
     * @example $resposta = $obj->mostrar($id_resposta);
     */
    public function mostrar(int $id_resposta)
    {
        // Prepara a consulta
        $sql = $this->pdo->prepare('SELECT * FROM respostas WHERE id_resposta = :id_resposta LIMIT 1');
        $sql->bindParam(':id_resposta', $id_resposta);
        
        // Executa a consulta
        $sql->execute();
        
        // Pega os dados retornados
        $dados = $sql->fetch(PDO::FETCH_OBJ);
        
        // Retorna o objeto com os dados da resposta
        return $dados;
    }

    /**
     * Atualiza os dados de uma determinada resposta
     *
     * @param array $dados Array com os dados atualizados da resposta.
     * @return void
     * @example $obj->editar($_POST);
     */
    public function editar(array $dados)
    {
        $sql = $this->pdo->prepare("UPDATE respostas SET
            id_pergunta = :id_pergunta,
            resposta = :resposta,
            correta = :correta
        WHERE id_resposta = :id_resposta
        ");

        // Faz o binding dos parâmetros
        $id_pergunta = $dados['id_pergunta'];
        $resposta = trim($dados['resposta']);
        $correta = isset($dados['correta']) ? $dados['correta'] : 0; // Define 0 como padrão se não for fornecido
        $id_resposta = $dados['id_resposta'];

        $sql->bindParam(':id_pergunta', $id_pergunta);
        $sql->bindParam(':resposta', $resposta);       
        $sql->bindParam(':correta', $correta);
        $sql->bindParam(':id_resposta', $id_resposta);

        // Executa a consulta
        $sql->execute();
    }

    /**
     * Exclui uma resposta do banco de dados
     *
     * @param int $id_resposta ID da resposta a ser excluída.
     * @return void
     * @example $obj->excluir($id_resposta);
     */
    public function excluir(int $id_resposta)
    {
        // Prepara a consulta de exclusão
        $sql = $this->pdo->prepare('DELETE FROM respostas WHERE id_resposta = :id_resposta');
        $sql->bindParam(':id_resposta', $id_resposta);

        // Executa a consulta
        $sql->execute();
    }

}

?>
