<?php

namespace App\Models;

use App\Database\QueryBuilder;

class User {
  use \App\Support\Validation;
  public function allUsers():object | array{
    $query = new QueryBuilder();
    $users = $query->select('u.id id, u.name name, u.email email, u.id_sectors id_sectors, s.description description')
      ->table('users u')
      ->join('sectors s','u.id_sectors','s.id')
      ->get();
    return $users;
  }

  public function uniqueUser(string $id):array | bool {
    $query = new QueryBuilder();
    return $query->select()->table('users')->where('id',$id)->one();
  }

  public function deleteUser(string $id):array | bool{
    $query = new QueryBuilder();
    return $query->delete()->table('users')->where('id',$id)->save();
  }

  public function addUser(array $data):void{
    $this->Validate([
      'nome' =>'required',
      'email' =>'required|email',
      'setor' =>'required',
    ]);

    if($this->hasError()){
      setFlashMessage($this->getMessage(),'danger');
      redirect();
    }
    $query = new QueryBuilder();
    $query->insert()
    ->table('users')
    ->columns([
      'name'=>$data['nome'],
      'email'=>$data['email'],
      'id_sectors'=>$data['setor']
      ])->save();
      
    setFlashMessage('Cadastrado com sucesso!!!','success');
    redirect();
  }

  public function updateUser(array $data):void{
    $this->Validate([
      'nome' =>'required',
      'email' =>'required|email',
      'setor' =>'required',
    ]);

    if($this->hasError()){
      setFlashMessage($this->getMessage(),'danger');
      redirect();
    }

    $query = new QueryBuilder();  
    $query->update('users')
      ->set('name',$data['nome'])
      ->set('email',$data['email'])
      ->set('id_sectors',$data['setor'])
      ->where('id',$data['id'])
      ->save(); 
    setFlashMessage('Alterado com sucesso!!!','success');
    redirect();
  }
}