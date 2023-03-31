<?php

declare(strict_types=1);

namespace App\Database;

use PDOException;
use Exception;

class QueryBuilder implements IQueryBuilder{
  use \App\Support\ValidationXSS;

  private object $pdo;
  private string $sql;
  private array $column = [];
  private array $binds = [];

  public function __construct(){
    try{
      $this->pdo = new Connection();
    } catch(PDOException $e){
      throw new PDOException("Houve erro de comunicação".$e->getMessage());
    }
  }

  public function insert():object{
    $this->sql = "INSERT INTO";
    return $this;
  }
  public function select(string $paraments = '*'):object{
    $this->sql = "SELECT $paraments FROM ";
    return $this;
  }
  public function update(string $table):object{
    $this->sql = "UPDATE {$table} SET";
    return $this;

  }
  public function delete():object{
    $this->sql = "DELETE FROM";
    return $this;
  }

  // @param string nome da tabela do banco de dados
  // @return Objeto
  public function table(string $table = null):object{
    if(empty($table)){
      throw new Exception("Precisa informar uma tabela");
    }

    $this->sql .=" {$table}";
    return $this;
  }

  //@param array WHERE
  //@return Objeto
  public function where(...$args):object{
    $numCount = count($args);
    if ($numCount < 1 || $numCount > 3){
      throw new Exception("Precisa informar 3 argunmentos na quantidade do parametro. Ex: 'id', '=', '1'");
      }
      $operation = "=";
      ($numCount === 2)? list($fields,$value) = $args
        :list($fields,$operation,$value) = $args;

      $this->sql = rtrim($this->sql,',');
      $this->sql .= " WHERE {$fields} {$operation} ?";
      $this->column['binds'][]= $this->protectedXSS($value);
      $this->binds['columns'] = $this->column['binds'];
      
      $count = 0;
      $i=0;
      while (($i = strpos($this->sql, ' WHERE ',$i+1)) != 0){
        $count++;
      }
      if ($count > 1){
        throw new Exception("Só pode haver um 'WHERE'");
      }
      return $this;
  }

  //@param array AND
  //@return Objeto
  public function whereAnd(...$args):object {
    $numCount = count($args);
    if($numCount <= 2 || $numCount > 3){
      throw new Exception("Precisa informar 3 arguntmentos na quantidade do parametro. Ex: 'id', '=', '1'");
    }
    list($fields,$operation,$value) = $args;
    $this->sql .= " AND {$fields} {$operation} ?";
    $this->column['binds'][]=$this->protectedXSS($value);
    $this->binds['columns'] = $this->column['binds'];

    if (strpos($this->sql, ' WHERE ') === false){
      throw new Exception("Precisa haver um 'WHERE' antes de um 'AND'");
    }
    return $this;
  }

  //@param array Or
  //@return Objeto
  public function whereOr(...$args):object {
    $numCount = count($args);
    if($numCount <= 2 || $numCount > 3){
      throw new Exception("Precisa informar 3 arguntmentos na quantidade do parametro. Ex: 'id', '=', '1'");
    }
    list($fields,$operation,$value) = $args;
    $this->sql .= " OR {$fields} {$operation} ?";
    $this->column['binds'][]=$this->protectedXSS($value);
    $this->binds['columns'] = $this->column['binds'];

    if (strpos($this->sql, ' WHERE ') === false){
      throw new Exception("Precisa haver um 'WHERE' antes de um 'OR'");
    }
    return $this;
  }

  //@param array INNER JOIN
  //@return Objeto
  public  function join(...$args):object {
    $numCount = count($args);
    if($numCount <= 2 || $numCount > 3){
      throw new Exception("Precisa informar 3 arguntmentos na quantidade do parametro. Ex: 'table', 'chave primaria', 'chave estrangeira'");
    }
    list($table, $primaryKey,$foreignKey) = $args;
    $this->sql .= " INNER JOIN {$table} ON {$primaryKey} = {$foreignKey}";
    return $this;
  }

  //@param array LEFT JOIN
  //@return Objeto
  public  function joinLeft(...$args):object {
    $numCount = count($args);
    if($numCount <= 2 || $numCount > 3){
      throw new Exception("Precisa informar 3 arguntmentos na quantidade do parametro. Ex: 'table', 'chave primaria', 'chave estrangeira'");
    }
    list($table, $primaryKey,$foreignKey) = $args;
    $this->sql .= " LEFT JOIN {$table} ON {$primaryKey} = {$foreignKey}";
    return $this;
  }

  //@param array RIGHT JOIN
  //@return Objeto
  public  function joinRight(...$args):object {
    $numCount = count($args);
    if($numCount <= 2 || $numCount > 3){
      throw new Exception("Precisa informar 3 arguntmentos na quantidade do parametro. Ex: 'table', 'chave primaria', 'chave estrangeira'");
    }
    list($table, $primaryKey,$foreignKey) = $args;
    $this->sql .= " RIGHT JOIN {$table} ON {$primaryKey} = {$foreignKey}";
    return $this;
  }

  //@param string LIKE
  //@return Objeto
  public function like(string $fields, string $value):object{
    $this->sql .=" WHERE {$fields} LIKE ?";
    $this->column['binds'][] = '%'.$this->protectedXSS($value).'%';
    $this->binds['columns'] = $this->column['binds'];
    return $this;
  }

  //@param string ORDER BY
  //@return Objeto
  public function orderBy(string $fields, string $order = 'ASC'):object{
    $this->sql.= " ORDER BY {$fields} {$order}";
    return $this; 
  }

  //@param string GROUP BY
  //@return Objeto
  public function groupBy(string $fields):object{
    $this->sql.= " GROUP BY {$fields}";
    return $this;
  }

  //@param int e string LIMIT
  //@return Objeto
  public function limit(int $limit, string $page = ''):object{
    if(!empty($page)){
      $this->sql.= " LIMIT {$limit}, {$page}";
    } else {
      $this->sql.= " LIMIT {$limit}";
    }
    return $this;
  }

  private function prepare():object {
    return $this->pdo->getConnection()->prepare($this->sql);
  }

  //@return Objeto | retorna apenas um objeto ou bool
  public function one():array | bool{
    $execute = $this->prepare();
    $binds = (isset($this->column['binds']))
    ? $this->column['binds']
    : $this->column;
    $execute->execute($binds);
    return $execute->fetch(\PDO::FETCH_ASSOC);
  }

  //@return Objeto | retorna array ou nulo
  public function get():?array{
    $execute = $this->prepare();
    $binds = (isset($this->column['binds']))
    ? $this->column['binds']
    : $this->column;
    $execute->execute($binds);
    return $execute->fetchAll(\PDO::FETCH_ASSOC);
  }

  //@param array
  //@return Objeto
  public function columns(array $columns):object{
    if (is_array($columns)){
      foreach($columns as $key => $value){
        $this->column['column'][$key] = '?';
        $this->column['binds'][] = $this->protectedXSS($value);
      }
      $this->binds['columns'] = $this->column['binds'];
      unset($this->column['binds']);
    }else{
      throw new Exception("Tem que passar um array. Ex: ['nome'=>'dankicode']");
    }

    $this->sql .= "(".implode(',',array_keys($this->column['column']))
    .") VALUES (".implode(',',array_values($this->column['column'])).")";

    return $this;
  }

  //@param string field e sting value
  //@return Objeto
  public function set(string $fields, string $value):object{
    if (strpos($this->sql, 'UPDATE') === true){
      throw new Exception ("SET só é usado para UPDATE");
    }
    $this->sql .= " {$fields} = ?,";
    $this->column['binds'][] = $this->protectedXSS($value);
    $this->binds['columns'] = $this->column['binds'];
    return $this;
  }

  //@return bool
  private function exec():bool{
    $execute = $this->prepare();
    return $execute->execute($this->binds['columns']);
  }

  //@return bool
  public function save():bool{
    return $this->exec();
  }


}
