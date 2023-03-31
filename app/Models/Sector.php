<?php

namespace App\Models;

use App\Database\QueryBuilder;

class Sector {
  public function sectorAll():object | array{
    $sector = new QueryBuilder();
    return $sectors = $sector->select()->table('sectors')->get();
  }
}