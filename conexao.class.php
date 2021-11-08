<?php
class Conexao extends PDO {

private  $host     = "mysql:host=localhost;dbname=u224722929_ceep"; //String de conexão
//private  $host     = "mysql:host=localhost;dbname=backup_ceep_03_11_19"; //String de conexão

private  $user     = "u224722929_ceep"; //usuário do banco de dados (root por padrão)
//private  $user     = "root"; //usuário do banco de dados (root por padrão)

private  $pass = "UmhNWJ3AvJ4+H]Kr";     //senha   do banco de dados (nula por padrão)    
//private  $pass = "root";     //senha   do banco de dados (nula por padrão)    

  public function __construct() {
      try {
          //require_once("erro.class.php");
          parent::__construct($this->host, $this->user, $this->pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
          parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          //parent::setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND,'SET NAMES UTF8');
      }catch(PDOException $e) {
        echo $e->getMessage();
      }
  }
}
?>