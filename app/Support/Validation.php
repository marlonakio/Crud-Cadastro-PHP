<?php
declare (strict_types = 1);
namespace App\Support;

trait Validation{
  private array $errors=[];

  public function Validate(array $rules){
    foreach($rules as $key=>$value){
      if ($this->hasOneValidate($value)){
        $this->$value($key);
      }
      if ($this->hasOneOrManyValidate($value)){
        $validations = explode('|',$value);

        foreach($validations as $validation){
          $this->$validation($key);
        }
      }
    }
    
  }

  public function hasOneValidate(string $data){
    return substr_count($data, '|') == 0;
  }

  public function hasOneOrManyValidate(string $data){
    return substr_count($data, '|') >= 1;
  }

  public function required(string $field){
    if(empty($_POST[$field])){
      $this->errors[$field][]= 'O campo '.$field.' é obrigatório';
    }
  }

  public function email(string $field){
    if(!filter_var($_POST[$field],FILTER_VALIDATE_EMAIL)){
      $this->errors[$field][]= 'O email é inválido';
    }
  }
  
  public function hasError(){
   return !empty($this->errors);
  }

  public function getMessage(){
    return $this->errors;
  }
  
}