<?php

/**
 * Classe com metodos estáticos
 */
class Helper{

  /**
   * Sobe Arquivo
   * @param  file  $arquivo    - Pode ser uma imagem ou qualquer outro
   *                             tipo de arquivo
   * @param  string $diretorio - Caminho da pasta onde o arquivo
   *                             será armazenado
   * @return string || false     - nome do arquivo
   */
public static function sobeArquivo($arquivo,$diretorio = '../imagens/'){
    $arquivo = $arquivo;
    // pegar apenas o nome original do arquivo
    $nome_arquivo = $arquivo['name'];
      // verificar se algum arquivo foi enviado
      if(trim($nome_arquivo)!= '') {
          // pegar a extensao do arquivo         
          $extensao = explode('.', $nome_arquivo);
          // gerar nome         
          $novo_nome = date('YmdHis').rand(0,1000).'.'.end($extensao);         

          // montar o destino onde o arquivo será armazenado        
          $destino = $diretorio.$novo_nome;                  
          $ok = move_uploaded_file($arquivo['tmp_name'],$destino);
          // verificar se o upload foi realizado
          if($ok) {
            return $novo_nome;            
          } else {
            return false;
          }

      } else {
        return false;
      }
  }
  
    /**
     * =======================================
     *  CONTROLE DE ACESSO
     * =======================================
     */

     /**
      * Verifica se existe a 
      * variavel de sessão logado
      *
      * @return bool
      */      
     public static function logado()
     {
      session_start();
       if(!isset($_SESSION['logado']) ){
        header('location:/Skillhub/login?erro=1');
       }
     }

    public static function converterData(string $data_sql): string
    {
        $data = DateTime::createFromFormat('Y-m-d', $data_sql);
        if ($data) {
            return $data->format('d/m/Y');
        } else {
            return $data_sql;
        }
    }

}

?>