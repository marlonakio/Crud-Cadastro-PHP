<?php

namespace App\Database;  
use PDO;

class Connection {
  private $pdo =null;
  public function getConnection(){
    if ($this->pdo === null){
      $this->pdo = new PDO($_ENV['DRIVER'].':dbname='.$_ENV['DATABASE'].';host='.$_ENV['HOST'].';',$_ENV['USER'],$_ENV['PASSWORD']);
    }
    return $this->pdo;
  }
}