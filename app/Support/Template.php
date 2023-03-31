<?php
declare (strict_types=1);
namespace App\Support;

use League\Plates\Engine;
use Psr\Http\Message\ResponseInterface as Response;

trait Template
{
  private $template;

  private function load()
  {
    $this->template = new Engine(__DIR__ . '/../../resources');
    return $this->template;
  }

  private function render($response,$name,$paraments=[]): Response
  {
    $response->getBody()->write(
      $this->fetch($name, $paraments)
    );
    return $response;
  }

  private function fetch($name, $paraments = [])
  {
    return $this->load()->render($name,$paraments);
  }

}