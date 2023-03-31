<?php

declare(strict_types=1);
namespace App\Controllers;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Http\Controller;
use App\Models\Sector;
use App\Models\User;

class UserController extends Controller
{
  use \App\Support\Template;
  public function index(Request $request,Response $response):Response
  { 
    //$query = new QueryBuilder();

  //ADICIONAR DADOS FAKE
  //   $faker = \Faker\Factory::create();
  //   for ($i = 0; $i < 157; $i++) {
  //     $random = (string)rand(1,3); //informar no último número a quantidade de setores
  //   $test = $query->insert()->table('users')->columns(['name'=>$faker->name(), 'email'=>$faker->email(), 'id_sectors'=>$random])->save();
  // }
  // dd($test);


    $user = new User();
    $users = $user->allUsers();
    $sector = new Sector();
    $sectors = $sector->sectorAll();

    return $this->render($response,'user',['users'=>$users,'sectors'=>$sectors]);
  }
  
  public function show(Request $request,Response $response):Response{
    $id = $request->getAttribute('id');
    $user = new User();
    $data = $user->uniqueUser($id);
    if (!$data){
      redirect();
    }

    
    $user = new User();
    $users = $user->allUsers();
    $sector = new Sector();
    $sectors = $sector->sectorAll();

    return $this->render($response,'user',['users'=>$users,'data'=>$data, 'sectors'=>$sectors]);
  }

  public function createOrUpdate(Request $request,Response $response):Void{
    $data = $request->getparsedBody();
    $user = new User();
    if (isset($data['acao']) && $data['acao']==='addUser') {
      $user->addUser($data);
    }
    if (isset($data['acao']) && $data['acao'] === 'uptadeUser') {
       $user->updateUser($data);    
    }
  }

  public function destroy(Request $request,Response $response):Void{
    $id = $request->getAttribute('id');
    $user = new User();

    if($user->deleteUser($id)){
      setFlashMessage('Usuário excluido com sucesso !!!', 'info');
      redirect();
    }
  }


}

