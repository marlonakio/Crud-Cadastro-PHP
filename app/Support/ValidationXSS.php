<?php
declare (strict_types = 1);
namespace App\Support;

trait ValidationXSS{
  public function protectedXSS(string $value):string{
    return htmlentities($value);
  }
}