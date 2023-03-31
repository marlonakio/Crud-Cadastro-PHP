<?php
function baseURL(){
  return $_ENV['BASE_URL'];
}

function dd($data){
  var_dump($data);die();
}

function redirect($name=''){
  if (empty($name)){
    header('Location:'.$_ENV['BASE_URL']);
    die();
  }
  header('Location:'.$_ENV['BASE_URL'].'/'.$name);die();
}

function setFlashMessage(array | string $data, string $type){
  $_SESSION['message']=$data;
  $_SESSION['type']=$type;
}

function getFlashMessage(){
  $message = [];
  $type = '';

  if (isset($_SESSION['message'])){
    $message = $_SESSION['message'];
    $type = $_SESSION['type'];

    unset($_SESSION['message']);
    unset($_SESSION['type']);
  }
  if (is_array($message)){
    $div = '<div class="alert alert-'.$type.'"><ul>';
    foreach ($message as $key=>$value){
      $div.= '<li>'.$value[0].'</li>';
    }
    echo $div.='</ul></div>';
  }
  if(is_string($message)){
    $div = '<div class="alert alert-'.$type.'">'.$message.'</div>';
    echo $div;
  }
}